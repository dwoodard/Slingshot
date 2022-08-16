<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schema;
use Illuminate\Http\Request;

class SchemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        // create the schema
        $schema = Schema::create($request->validated());
        return redirect()->back()->with('success', 'Schema created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function show(Schema $schema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function edit(Schema $schema)
    {
        //
    }


    public function update(Request $request, Schema $schema)
    {
        $data = $request->validate([
            'id' => 'required|integer',
            'name' => 'string',
            'model' => 'array',
            'options' => 'array',
            'schema' => 'array',
        ]);

        $schema->update($data);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schema $schema)
    {
        //
    }
}
