<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use App\Models\Image;

class ImageServeController extends Controller
{
    public function serveImage(Request $request, string $id)
    {
        $image = Image::find($id);

        if (!$image) {
            return response()->json(['message' => 'Image not found'], 404);
        } else {
            if ($image->public) {
                return Storage::disk('public')->download($image->path);
            } else {
                if (Auth::user()->id == $image->user_id || Auth::user()->role == 'admin') {
                    return Storage::disk('local')->download($image->path);
                } else {
                    return response()->json(['message' => 'Unauthorized'], 403);
                }
            }
        }
    }
}
