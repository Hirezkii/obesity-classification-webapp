from flask import Flask, request, jsonify
from sqlalchemy import create_engine
import pandas as pd
import numpy as np
from sklearn.ensemble import RandomForestClassifier
from sklearn.tree import DecisionTreeClassifier
from sklearn.svm import SVC
from sklearn.model_selection import train_test_split
from sklearn.preprocessing import StandardScaler, LabelEncoder
from sklearn.metrics import accuracy_score
from sklearn.model_selection import GridSearchCV

# Initialize Flask app
app = Flask(__name__)

# Database connection setup
database_url = 'mysql+mysqlconnector://root:@localhost/Obesity'
engine = create_engine(database_url)

# Global variables to store model information
best_model = None
best_model_name = None
accuracy_before_tuning = {}
best_accuracy_after_tuning = {}

# Load and preprocess data
def load_and_preprocess_data():
    query = "SELECT * FROM person_attributes"
    df = pd.read_sql(query, engine)
    
    # Label Encoding
    label_encoders = {}
    categorical_columns = ['gender', 'family_history_with_overweight', 'favc', 'caec', 'smoke', 'scc', 'calc', 'mtrans', 'nobeyesdad']
    
    for column in categorical_columns:
        le = LabelEncoder()
        df[column] = le.fit_transform(df[column])
        label_encoders[column] = {'le': le, 'classes_': le.classes_}
    
    return df, label_encoders

# Function to train and tune the models
def train_and_tune_models(df):
    global best_model, best_model_name, accuracy_before_tuning, best_accuracy_after_tuning
    
    X = df.drop(['nobeyesdad', 'created_at', 'updated_at', 'id'], axis=1, errors='ignore')
    y = df['nobeyesdad']
    
    # Split dataset
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
    
    # Feature scaling
    scaler = StandardScaler()
    X_train_scaled = scaler.fit_transform(X_train)
    X_test_scaled = scaler.transform(X_test)

    # Hyperparameter tuning and model training

    # Random Forest
    param_grid_rf = {
        'n_estimators': [50, 100, 150],
        'max_depth': [None, 10, 20, 30],
        'min_samples_split': [2, 5, 10],
        'min_samples_leaf': [1, 2, 4]
    }
    rf = RandomForestClassifier()
    rf.fit(X_train_scaled, y_train)
    y_pred_rf = rf.predict(X_test_scaled)
    accuracy_before_tuning['Random Forest'] = accuracy_score(y_test, y_pred_rf)

    grid_search_rf = GridSearchCV(estimator=rf, param_grid=param_grid_rf, cv=5, n_jobs=-1)
    grid_search_rf.fit(X_train_scaled, y_train)
    best_model_rf = grid_search_rf.best_estimator_
    y_pred_rf_best = best_model_rf.predict(X_test_scaled)
    best_accuracy_after_tuning['Random Forest'] = accuracy_score(y_test, y_pred_rf_best)
    
    # Decision Tree
    param_grid_dt = {
        'max_depth': [None, 10, 20, 30],
        'min_samples_split': [2, 5, 10],
        'min_samples_leaf': [1, 2, 4]
    }
    dt = DecisionTreeClassifier()
    dt.fit(X_train_scaled, y_train)
    y_pred_dt = dt.predict(X_test_scaled)
    accuracy_before_tuning['Decision Tree'] = accuracy_score(y_test, y_pred_dt)

    grid_search_dt = GridSearchCV(estimator=dt, param_grid=param_grid_dt, cv=5, n_jobs=-1)
    grid_search_dt.fit(X_train_scaled, y_train)
    best_model_dt = grid_search_dt.best_estimator_
    y_pred_dt_best = best_model_dt.predict(X_test_scaled)
    best_accuracy_after_tuning['Decision Tree'] = accuracy_score(y_test, y_pred_dt_best)

    # Support Vector Machine
    param_grid_svm = {
        'C': [0.1, 1, 10],
        'kernel': ['linear', 'poly', 'rbf', 'sigmoid'],
        'gamma': ['scale', 'auto']
    }
    svm = SVC()
    svm.fit(X_train_scaled, y_train)
    y_pred_svm = svm.predict(X_test_scaled)
    accuracy_before_tuning['Support Vector Machine'] = accuracy_score(y_test, y_pred_svm)

    grid_search_svm = GridSearchCV(estimator=svm, param_grid=param_grid_svm, cv=5, n_jobs=-1)
    grid_search_svm.fit(X_train_scaled, y_train)
    best_model_svm = grid_search_svm.best_estimator_
    y_pred_svm_best = best_model_svm.predict(X_test_scaled)
    best_accuracy_after_tuning['Support Vector Machine'] = accuracy_score(y_test, y_pred_svm_best)

    # Evaluate models and select the best one
    models = {
        'Random Forest': best_model_rf,
        'Decision Tree': best_model_dt,
        'Support Vector Machine': best_model_svm
    }

    model_results = {
        'Random Forest': best_accuracy_after_tuning['Random Forest'],
        'Decision Tree': best_accuracy_after_tuning['Decision Tree'],
        'Support Vector Machine': best_accuracy_after_tuning['Support Vector Machine']
    }
    
    best_model_name = max(model_results, key=model_results.get)
    best_model = models[best_model_name]

    return best_model, scaler, model_results

# Load data and train models on server start
df, label_encoders = load_and_preprocess_data()
best_model, scaler, model_results = train_and_tune_models(df)

@app.route('/predict', methods=['POST'])
def predict():
    global best_model_name, accuracy_before_tuning, best_accuracy_after_tuning
    
    new_data = request.json
    
    # Convert input data to DataFrame
    new_data_df = pd.DataFrame([new_data])
    
    # Ensure weight and height are numeric
    new_data_df['weight'] = pd.to_numeric(new_data_df['weight'], errors='coerce')
    new_data_df['height'] = pd.to_numeric(new_data_df['height'], errors='coerce')

    # Check for NaN values
    if new_data_df['weight'].isnull().any() or new_data_df['height'].isnull().any():
        return jsonify({
            'error': 'Invalid input for weight or height. Please ensure they are numeric values.'
        }), 400

    # Calculate BMI
    bmi = new_data_df['weight'].iloc[0] / ((new_data_df['height'].iloc[0] / 100) ** 2)

    # Preprocess the input data
    for column in label_encoders:
        if column in new_data_df.columns:
            le = label_encoders[column]['le']
            new_data_df[column] = new_data_df[column].apply(lambda x: x if x in le.classes_ else 'unknown')
            if 'unknown' not in le.classes_:
                le.classes_ = np.append(le.classes_, 'unknown')
            new_data_df[column] = le.transform(new_data_df[column])
    
    # Scale the input data
    X_new_scaled = scaler.transform(new_data_df)
    
    # Make the prediction
    y_new_pred = best_model.predict(X_new_scaled)
    
    # Reverse the label encoding to get the original label
    predicted_label = label_encoders['nobeyesdad']['le'].inverse_transform([int(y_new_pred[0])])[0]

    # Return the prediction
    return jsonify({
        'prediction': predicted_label,
        'method': best_model_name,
        'accuracy_before': accuracy_before_tuning[best_model_name],
        'accuracy_after': best_accuracy_after_tuning[best_model_name],
        'bmi': bmi
    })
    
@app.route('/get_accuracies', methods=['GET'])
def get_accuracies():
    return jsonify({
        'RandomForest': best_accuracy_after_tuning['Random Forest'],
        'DecisionTree': best_accuracy_after_tuning['Decision Tree'],
        'SVM': best_accuracy_after_tuning['Support Vector Machine']
    })


if __name__ == '__main__':
    app.run(debug=True)
