<?php

namespace App\Repository;

use Illuminate\Support\Facades\Storage;

class FileRepository
{
    public static function uploadFile($image, string $path = 'public'): string
    {
        $filename = time() . '.png';
        Storage::disk($path)
            ->put('user/avatar' . $filename, base64_decode($image));
        return '/storage/avatars/' . $filename;
    }
}
