<?php

namespace App\Http\Controllers\API\Dashboard;

use App\Http\Controllers\Controller;
use FFMpeg\FFMpeg;
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
            'duration' => $this->getDuration($path),
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

    private function getDuration($videoFile): string {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
        ]);
        $video = $ffmpeg->open(storage_path('app/' . $videoFile));
        $duration = $video->getStreams()->videos()->first()->get('duration');

        return gmdate('H:i:s', $duration);
    }

    private function getVideoQuality($videoFile): string {
        $ffmpeg = FFMpeg::create([
            'ffmpeg.binaries' => '/usr/bin/ffmpeg',
            'ffprobe.binaries' => '/usr/bin/ffprobe',
        ]);
        $video = $ffmpeg->open(storage_path('app/' . $videoFile));
        $videoStream = $video->getStreams()->videos()->first();
        $width = $videoStream->get('width');
        $height = $videoStream->get('height');

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
        } else if ($width >= 426 && $height >= 240) {
            return "240p";
        } else if ($width >= 256 && $height >= 144) {
            return "144p";
        } else {
            return "Unknown";
        }
    }
}
