<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\UserInput;
use Illuminate\Http\Request;
use App\Models\PersonAttribute;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreUserInputRequest;
use App\Http\Requests\UpdateUserInputRequest;

class UserInputController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userinputs = UserInput::latest()->paginate(10);

        return view('admin.userinput', compact('userinputs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'gender' => 'required|string',
            'age' => 'required|integer|max:120',
            'height' => 'required|integer|max:300',
            'weight' => 'required|integer|max:999',
            'family_history_with_overweight' => 'required|string',
            'favc' => 'required|string',
            'fcvc' => 'required|integer',
            'ncp' => 'required|integer',
            'caec' => 'required|string',
            'smoke' => 'required|string',
            'ch2o' => 'required|integer',
            'scc' => 'required|string',
            'faf' => 'required|integer',
            'tue' => 'required|integer',
            'calc' => 'required|string',
            'mtrans' => 'required|string',
        ]);

        $validatedData['height'] = $validatedData['height'] / 100;

        // Send the validated data to the Flask API
        $client = new Client();

        try {
            $response = $client->post('http://127.0.0.1:5000/predict', [
                'json' => $validatedData
            ]);

            $data = json_decode($response->getBody(), true);
            $prediction = $data['prediction'];
            $method = $data['method'];
            $accuracy_before = $data['accuracy_before'];
            $accuracy_after = $data['accuracy_after'];

            // Calculate BMI
            $bmi = $validatedData['weight'] / ($validatedData['height'] * $validatedData['height']);

            // Store the prediction in the database
            $validatedData['nobeyesdad'] = $prediction;
            UserInput::create($validatedData);

            return response()->json([
                'prediction' => $prediction,
                'method' => $method,
                'accuracy_before' => $accuracy_before,
                'accuracy_after' => $accuracy_after,
                'bmi' => $bmi,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process the request: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInput $userInput)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInput $userInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserInputRequest $request, UserInput $userInput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInput $userInput)
    {
        //
    }

    public function deleteAll()
    {
        UserInput::truncate(); // Menghapus semua data di tabel UserInput
        return redirect()->back()->with('success', 'Semua data berhasil dihapus.');
    }


    public function moveToPersonAttributeAll()
    {
        $userInputs = UserInput::all();

        if ($userInputs->isEmpty()) {
            // Jika tidak ada data
            return redirect()->back()->with('warning', 'Tidak ada data yang bisa dikirimkan ke tabel Train.');
        }

        foreach ($userInputs as $userInput) {
            PersonAttribute::create([
                'gender' => $userInput->gender,
                'age' => $userInput->age,
                'height' => $userInput->height,
                'weight' => $userInput->weight,
                'family_history_with_overweight' => $userInput->family_history_with_overweight,
                'favc' => $userInput->favc,
                'fcvc' => $userInput->fcvc,
                'ncp' => $userInput->ncp,
                'caec' => $userInput->caec,
                'smoke' => $userInput->smoke,
                'ch2o' => $userInput->ch2o,
                'scc' => $userInput->scc,
                'faf' => $userInput->faf,
                'tue' => $userInput->tue,
                'calc' => $userInput->calc,
                'mtrans' => $userInput->mtrans,
                'nobeyesdad' => $userInput->nobeyesdad,
            ]);

            $userInput->delete();
        }
        // Jika sukses
        return redirect()->back()->with('success', 'Semua data berhasil dipindahkan ke tabel sebelah.');
    }

    public function someErrorAction()
    {
        return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses data.');
    }
}
