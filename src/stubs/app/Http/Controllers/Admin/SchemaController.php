<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schema;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class SchemaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Inertia\Response
   */
  public function index()
  {

    $data = [
      'schemas' => $this->getSchemas()->values()
    ];

    return Inertia::render('Admin/Forms', $data);
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

    $id = Schema::create(
      $request->validate([
        'name' => 'required|string|unique:schemas,name',
        'system' => 'boolean',
        'model' => '',
        'schema' => '',
        'options' => '',
      ])
    )->id;


    return Redirect::back()->with([
      'success' => 'Schema created successfully',
      'schema' => Schema::find($id)
    ]);
  }

  /**
   * Display the specified resource.
   *
   * @param \App\Models\Schema $schema
   * @return \Illuminate\Http\Response
   */
  public function show(Schema $schema)
  {
    return $schema;
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param \App\Models\Schema $schema
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
      'model' => 'nullable|array',
      'options' => 'array',
      'schema' => 'array',
    ]);

    $schema->update($data);
    return $data;
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param \App\Models\Schema $schema
   * @return \Illuminate\Http\Response
   */
  public function destroy(Schema $schema)
  {
    //
  }

  /**
   * Get all schemas.
   *
   * @return \Illuminate\Database\Eloquent\Collection
   */
  private function getSchemas()
  {
    // if the user is a superadmin, show all schemas
    // if the user is an admin show only the schemas that are not system
    // if the user is a normal user they cant see any schemas

    $data = Schema::orderBy('system', 'desc')->exclude(['model'])
      ->when(auth()->user()->hasRole('superadmin'), function ($schemas) {
        return $schemas;
      })
      ->when(auth()->user()->hasRole('admin'), function ($schemas) {
        return $schemas->where('system', false);
      })->get();

    return $data;
  }
}
