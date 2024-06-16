<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * Class ImageController
 * Handles the retrieval of the private images.
 */
class ImageController extends Controller
{
    /**
     * Returns the image if the user has the permission to view the image.
     * If the user is not the owner of the image or an admin, a 404 error is returned.
     * Parameters are passed from the route. /private/images/{user}/{file}
     * Example: /private/images/1_user/1_image.jpg
     * 
     * @param $user
     * @param $file
     * @return mixed
     */
    public function getImage($user, $file)
    {
        // Extract the user id from the user name
        $id = Str::before($user, '_');
        // Check if the user is the owner of the image or an admin
        if ($id == auth()->id() || auth()->user()->hasRole('admin')) {
            $file = Storage::disk('local')->get('private/images/' . $user . '/' . $file);
            $type = Storage::mimeType($file);

            $response = Response::make($file, 200);
            $response->header('Content-Type', $type);

            return $response;
        } else {
            abort(403, 'Unauthorized action.');
        }
    }

    public function privateImage($type, $idWithUser, $image)
    {
        $id = Str::before($idWithUser, '_');
        $user = User::find($id);
        if (Auth::user()->id == $user->id || Auth::user()->hasRole('admin')) {
            return Storage::disk('local')->download("private/" . $type . "/" . $idWithUser . "/" . $image);
        } else {
            return response()->json(['message' => 'Unauthorized'], 403);
        }
    }
}
