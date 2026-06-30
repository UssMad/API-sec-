<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlueprintRequest;
use App\Http\Resources\BlueprintResource;
use App\Models\Blueprint;
use Illuminate\Http\Request;

class BlueprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blueprints = auth()->user()->blueprints()->latest()->get();

        return BlueprintResource::collection(auth()->user()->blueprints()->latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBlueprintRequest $request)
    {
        $blueprint = auth()->user()->blueprints()->create($request->validated());

        return (new BlueprintResource($blueprint))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Blueprint $blueprint)
    {
        $blueprint = auth()->user()->blueprints()->findOrFail($blueprint->id);

        return new BlueprintResource($blueprint);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
