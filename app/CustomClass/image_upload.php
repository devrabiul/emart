<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadCustom
{

    public static function upload( string $directory, string $namewithformat, $files = null)
    {
        if ($files != null) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }
            Storage::disk('public')->put(($directory ."/". $namewithformat), file_get_contents($files));
            $locationName = 'success';
        } else {
            $locationName = null;
        }
        return $locationName;
    }

}
