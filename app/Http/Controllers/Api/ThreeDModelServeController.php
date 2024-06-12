<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\ThreeDModel;

class ThreeDModelServeController extends Controller
{
    public function serveThreeDModel(Request $request, string $id)
    {
        $model = ThreeDModel::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->path);
            } else {
                if (Auth::user()->id == $model->user_id || Auth::user()->role == 'admin') {
                    return Storage::disk('local')->download($model->path);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            }
        }
    }

    public function serveThreeDModelThumbnail(Request $request, string $id)
    {
        $model = ThreeDModel::find($id);

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->thumbnail);
            } else {
                if (Auth::user()->id == $model->user_id || Auth::user()->role == 'admin') {
                    return Storage::disk('local')->download($model->thumbnail);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            }
        }
    }
}
