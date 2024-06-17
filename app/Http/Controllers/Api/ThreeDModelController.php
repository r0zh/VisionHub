<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\ThreeDModel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

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
    public function userModels($user_id)
    {
        $models = ThreeDModel::where('user_id', $user_id)->get();
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
        // request->file is the file uploaded by the user
        $modelFile = $request->file('model');
        $modelThumbnail = $request->file('thumbnail');
        Log::info("modelFile:   " . $modelFile);
        Log::info("modelThum:   " . $modelThumbnail);
        $randomName = Str::random(40);

        if ($request->isPublic == 1) {
            // get name or put a random unique name
            $path = "three_d_models/" . $user->id . '_' . explode('@', $user->email)[0] . '/';
            Storage::disk('public')->putFileAs($path, $modelFile, $randomName . ".obj");
            Storage::disk('public')->putFileAs($path, $modelThumbnail, 'thumbnail_' . $randomName . '.png');
            $model->path = $path . $randomName . ".obj";
            $model->thumbnail = $path . 'thumbnail_' . $randomName . '.png';
            $model->public = 1;
        } else {
            $path = "private/three_d_models/" . $user->id . '_' . explode('@', $user->email)[0] . '/';
            Storage::disk('local')->putFileAs($path, $modelFile, $randomName . ".obj");
            Storage::disk('local')->putFileAs($path, $modelThumbnail, 'thumbnail_' . $randomName . '.png');
            $model->path = $path . $randomName . ".obj";
            $model->thumbnail = $path . 'thumbnail_' . $randomName . '.png';

            $model->public = 0;
        }

        $model->prompt = $request->prompt;
        return $model->save();
    }
}
