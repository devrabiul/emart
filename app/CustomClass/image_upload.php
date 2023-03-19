<?php

namespace App\CustomClass;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadCustom
{

    public static function upload( string $directory, string $namewithformat, $files = null, $resize = null)
    {
        if ($files != null) {
            if (!Storage::disk('public')->exists($directory)) {
                Storage::disk('public')->makeDirectory($directory);
            }

            if ($resize != null) {
                $image = Image::make($files)->fit($resize);
                Storage::disk('public')->put(($directory ."/". $namewithformat), (string) $image->encode());
            } else {
                Storage::disk('public')->put(($directory ."/". $namewithformat), file_get_contents($files));
            }
            $locationName = 'success';
        } else {
            $locationName = null;
        }
        return $locationName;
    }

    public static function delete(string $fileWithSrc)
    {
        if ($fileWithSrc != null) {
            if (Storage::disk('public')->exists($fileWithSrc)) {
                Storage::disk('public')->delete($fileWithSrc);
            }
            $status = 'success';
        } else {
            $status = null;
        }
        return $status;
    }

}
