<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use App\Models\Accuracies;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccuraciesRequest;
use App\Http\Requests\UpdateAccuraciesRequest;

class AccuraciesController extends Controller
{
    public function retrainModel()
    {
        // Call the retraining function and get the new accuracies
        $client = new Client();
        $response = $client->get('http://127.0.0.1:5000/retrain'); // Assuming you have an endpoint for retraining
        $accuracyData = json_decode($response->getBody(), true);

        // Save the new accuracies to the database
        foreach ($accuracyData as $model => $accuracy) {
            Accuracy::create([
                'model_name' => $model,
                'accuracy' => $accuracy,
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Models retrained successfully!');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreAccuraciesRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Accuracies $accuracies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Accuracies $accuracies)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAccuraciesRequest $request, Accuracies $accuracies)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Accuracies $accuracies)
    {
        //
    }
}
