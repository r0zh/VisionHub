<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all images which are public
        $images = Image::where('public', 1)->get();
        return response()->json($images);
    }

    /**
     * Get the images uploaded by the user.
     */
    public function userImages()
    {
        $user = auth()->user();
        $images = Image::where('user_id', $user->id)->get();
        return response()->json($images);
    }

    /**
     * Get all images.
     */
    public function allImages()
    {
        $images = Image::all();
        return response()->json($images);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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
