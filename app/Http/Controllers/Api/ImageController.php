<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    // GET IMAGE
    public function getImage($path)
    {
        // Assuming images are stored in the 'public' disk
        $path = storage_path('app/public/images/' . $path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path, [
            'Content-Type' => 'image/jpeg'
        ]);
    }

    // UPLOAD IMAGE
    public function uploadBookImage($id, Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB Max
            'type' => 'required|string|in:cover,image'
        ]);

        // Process the file
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Store the file in the public disk
            $path = $file->storeAs('images', $filename, 'public');

            $book = auth()->user()->books()->find($id);

            if ($request -> type == 'cover')
                $book -> cover = $filename;
            else {
                $images = json_decode($book -> images);

                if ($images == null)
                    $images = [$filename];
                else
                    $images = array_merge($images, [$filename]);

                $book -> images = json_encode(array_values($images));
            }

            $book -> save();

            // Return response
            return response()->json(true, 200);
        }

        return response()->json(false, 400);
    }

    // DELETE IMAGE
    public function deleteBookImage($id, Request $request)
    {
        $filename = $request->filename;
        $path = storage_path('app/public/images/' . $filename);

        if (file_exists($path)) {
            // unlink($path); // TODO: ACTIVATE THIS LINES
        }

        $book = auth()->user()->books()->find($id);

        if ($book == null)
            return response()->json([
                'message' => 'Book not found'
            ]);


        if ($book -> cover == $filename)
            $book -> cover = null;
        else {
            $images = json_decode($book -> images);

            $images = array_diff($images, [$filename]);

            $book -> images = json_encode(array_values($images));
        }

        $book -> save();

        return response()->json([
            'message' => 'Image deleted: ' . $filename
        ]);
    }
}
