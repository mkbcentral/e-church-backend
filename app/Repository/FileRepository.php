<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class FileRepository
{
    public static function uploadFile($image, string $path = 'public', $directory): string
    {
        $filename = time() . '.png';
        Storage::disk($path)
            ->put($directory . $filename, base64_decode($image));
        return '/storage/' . $directory . '' . $filename;
    }
}
