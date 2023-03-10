<?php
namespace App\Helpers;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    static function getLoadedImagePath(
        $uploaded_image,
        $previous_image_path = null,
        $directory = 'images',
        $disk = 'cloudinary'
    )

    {
        $uploaded_image_path = Storage::disk($disk)->put($directory,$uploaded_image);
        if ($previous_image_path && Storage::disk($disk)->exists($previous_image_path))
        {
            Storage::disk($disk)->delete($previous_image_path);
        }
        return $uploaded_image_path;
    }

    static function getDiskImageUrl(string $path, string $disk = 'cloudinary')
    {
        return Str::startsWith($path, 'https://')
            ? $path
            : Storage::disk($disk)->url($path);
    }
}


