<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function show($filename)
    {
        $path = 'public/images/' . $filename;

        // Check if the file exists in storage
        if (!Storage::disk('local')->exists($path)) {
            abort(404, 'Image not found');
        }

        // Get the file contents and determine the MIME type
        $file = Storage::disk('local')->get($path);
        $type = Storage::disk('local')->mimeType($path);

        // Return the file as a response with appropriate headers
        return (new Response($file, 200))
            ->header('Content-Type', $type);
    }
}
