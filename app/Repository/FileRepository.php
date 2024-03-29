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

    // Delete a file from the server
    public static function deleteFile($path, string $disk = 'public'): void
    {
        Storage::disk($disk)->delete($path);
    }
}
