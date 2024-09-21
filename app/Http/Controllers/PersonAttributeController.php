<?php

namespace App\Http\Controllers;

use App\Models\PersonAttribute;
use App\Http\Requests\StorePersonAttributeRequest;
use App\Http\Requests\UpdatePersonAttributeRequest;

class PersonAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personattributes = PersonAttribute::latest()->paginate(10);
        return view('admin.personattribute', compact('personattributes'));
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
    public function store(StorePersonAttributeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PersonAttribute $personAttribute)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PersonAttribute $personAttribute)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePersonAttributeRequest $request, PersonAttribute $personAttribute)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PersonAttribute $personAttribute)
    {
        //
    }
}
