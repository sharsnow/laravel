<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 

class PictureController extends Controller
{
    public function getImage($filename)
    {
        $path = 'image/' . $filename;
        Log::info($path);
        if (Storage::exists($path)) {
            return response()->file(storage_path('app/' . $path));
        } else {
            return response()->json(['message' => 'Image not found.'], 404);
        }
    }
    public function QRcodeGenerate(Request $request) {
        $formData = $request->all();
        Log::info("123");
        Log::info($formData);
        $ger = $formData['place'];
        QrCode::format('png')->size('250')->encoding('UTF-8')->generate($ger, public_path('image/QRcode' . str_replace('"', '', $ger) . '.png'));
    }
    public function imageSave(Request $request) {
        Log::info("123");
        Log::info($request);
        return response()->json(['message' => '新增成功']);
    }
    public function download(Request $request)
    {   
        // Log::info("下載圖片");
        // $picture =urldecode($request->getContent());
        // $path = 'image/QRcode/' . str_replace('"', '', $picture) . '.png';
        // Log::info($path);
        // $test = 'image/editing.png';
        // try {
        //     $file = Storage::get($test);
        //     $type = Storage::mimeType($test);

        //     Log::info("成功");
            
        //     return Storage::download($test);
        // } catch (\Throwable $th) {
        //     Log::info($th);
        // }
        try {
            $filePath = Storage::path('image\AR.jpg');
            $fileName = 'test.png';
            $mimeType = Storage::mimeType($filePath);
            $headers = [['Content-Type' => $mimeType]];
            return response()->download($filePath, $fileName, $headers);
        }
        catch(\Throwable $th) {
            Log::info($th);
        }
        // if (Storage::exists($test)) {
        //     $file = Storage::get($test);
        //     $type = Storage::mimeType($test);

        //     Log::info("成功");
            
        //     return Storage::download($test);
        // } else {
        //     return response()->json(['message' => 'Image not found.'], 404);
        // }
    }
}
