<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Log;

use App\Models\ThreeDModel;
use Laravel\Sanctum\PersonalAccessToken;

class ThreeDModelServeController extends Controller
{
    public function serveThreeDModel(Request $request, string $id)
    {
        $model = ThreeDModel::find($id);

        $hashedTooken = $request->bearerToken();
        $user = PersonalAccessToken::findToken($hashedTooken)->tokenable;

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->path);
            } else {
                if ($user->id == $model->user_id || $user->role == 'admin') {
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

        $hashedTooken = $request->bearerToken();
        $user = PersonalAccessToken::findToken($hashedTooken)->tokenable;

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->thumbnail);
            } else {
                if ($user->id == $model->user_id || $user->role == 'admin' || $user->role == 'moderator') {
                    return Storage::disk('local')->download($model->thumbnail);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            }
        }
    }
}
