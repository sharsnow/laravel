<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
class VideoController extends Controller
{
    public function getVideo($filename)
    {
        $path = 'videos/' . $filename;
        if (Storage::exists($path)) {
            return response()->file(storage_path('app/' . $path));
        } else {
            return response()->json(['message' => 'Video not found.'], 404);
        }
    }
}
