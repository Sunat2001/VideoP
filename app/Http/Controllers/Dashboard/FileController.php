<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    public function videoUploader(Request $request):  JsonResponse
    {
        $request->validate([
            'file' => ['required', 'mimes:mp4,mov,avi'],
        ]);

        $file = $request->file('file');
        $path = Storage::putFile('video', $file);

        return response()->json([
            'path' =>  $path,
            'format' => $file->getClientOriginalExtension(),
            'quality' => $this->getVideoQuality($path),
        ]);
    }

    public function imageUploader(Request $request): JsonResponse
    {
        $request->validate([
            'file' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $file = $request->file('file');
        $path = Storage::putFile('images', $file);

        return response()->json([
            'path' => $path
        ]);
    }

    private function getVideoQuality($videoFile): string {
        $dimensions = getimagesize(storage_path('app/' . $videoFile));
        $width = $dimensions[0];
        $height = $dimensions[1];

        if ($width >= 3840 && $height >= 2160) {
            return "4K";
        } else if ($width >= 1920 && $height >= 1080) {
            return "1080p";
        } else if ($width >= 1280 && $height >= 720) {
            return "720p";
        } else if ($width >= 854 && $height >= 480) {
            return "480p";
        } else if ($width >= 640 && $height >= 360) {
            return "360p";
        } else {
            return "Unknown";
        }
    }
}
