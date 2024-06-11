<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreeDModel;

class ThreeDModelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all images which are public
        $models = ThreeDModel::where('public', 1)->get();
        return response()->json($models);
    }

    /**
     * Get the images uploaded by the user.
     */
    public function userImages()
    {
        $user = auth()->user();
        $models = ThreeDModel::where('user_id', $user->id)->get();
        return response()->json($models);
    }

    /**
     * Get all images.
     */
    public function allImages()
    {
        $images = ThreeDModel::all();
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $model = new ThreeDModel();
        $model->user_id = $user->id;
        $model->name = $request->name;
        $model->description = $request->description;
        $model->path = $request->file;
        $model->prompt = $request->prompt;
        $model->public = $request->public;
        return response()->json($model);
        $model->save();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    }
}
