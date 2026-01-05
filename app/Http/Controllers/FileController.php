<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function upload(StoreFileRequest $request)
    {
        $file = $request->file('file');
        // Handle the file upload logic here

        Storage::disk('ftp')->putFile('', $file);

        

        return response()->json(['message' => 'File uploaded successfully']);
    }
}
