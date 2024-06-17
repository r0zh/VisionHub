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

        $hashedToken = $request->bearerToken();
        $user = null;

        if (PersonalAccessToken::findToken($hashedToken)) {
            $user = PersonalAccessToken::findToken($hashedToken)->tokenable;
        }

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->path);
            } else {
                if ($user && ($user->id == $model->user_id || $user->role == 'admin')) {
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

        $hashedToken = $request->bearerToken();
        $user = null;
        if (!is_null(PersonalAccessToken::findToken($hashedToken))) {
            $user = PersonalAccessToken::findToken($hashedToken)->tokenable;
        }

        if (!$model) {
            return response()->json(['message' => 'Model not found'], 404);
        } else {
            if ($model->public) {
                return Storage::disk('public')->download($model->thumbnail);
            } else {
                if ($user && ($user->id == $model->user_id || $user->role == 'admin')) {
                    return Storage::disk('local')->download($model->thumbnail);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            }
        }
    }
}
