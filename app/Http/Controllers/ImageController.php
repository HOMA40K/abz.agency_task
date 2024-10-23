<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use GuzzleHttp\Client;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        // Validate the request (ensure the file is an image)
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // Resize the image using PHP GD Library
            $imagePath = $this->resizeImage($image, 70, 70);

            
            $imagePath = $this->optimizeImage($imagePath);

            return response()->json(['message' => 'Image uploaded successfully', 'path' => $imagePath]);
        }

        return response()->json(['error' => 'No image uploaded'], 400);
    }

    
    private function resizeImage($image, $width, $height)
    {
        $imageName = time() . '.' . $image->extension();
        $imagePath = public_path('images/users/' . $imageName);

        Image::make($image->path())
            ->resize($width, $height)
            ->save($imagePath);

        return $imagePath;
    }
    

    private function optimizeImage($imagePath)
    {

        $client = new Client();
        $apiKey = env('TINIFY_API_KEY');

        $response = $client->post('https://api.tinify.com/shrink', [
            'auth' => ['api', $apiKey],
            'body' => fopen($imagePath, 'rb'),
        ]);

        if ($response->getStatusCode() === 201) {
            
            $optimizedUrl = $response->getHeader('Location')[0];
            $optimizedImagePath = 'images/users/optimized_' . basename($imagePath);
            file_put_contents(public_path($optimizedImagePath), file_get_contents($optimizedUrl));
            
            unlink($imagePath);
            
            return $optimizedImagePath;
        }

        return $imagePath;
    }
}
