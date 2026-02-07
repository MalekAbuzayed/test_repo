<?php

namespace App\Traits;

trait UploadPdfTrait
{
    /**
     * Save uploaded PDF file to the specified location.
     *
     * @param  \Illuminate\Http\UploadedFile  $uploadedFile
     * @param  string  $uploadLocation
     * @return string
     */
    public function savePdfFile($uploadedFile, $uploadLocation)
    {
        // Generate a unique file name with the current timestamp
        $fileName = 'file_'.time().'.pdf';

        $relativePath = rtrim($uploadLocation, '/\\').'/';
        $absolutePath = public_path($relativePath);

        // Ensure the directory exists
        if (! is_dir($absolutePath)) {
            mkdir($absolutePath, 0777, true);
        }

        // Store the file in the desired location
        $uploadedFile->move($absolutePath, $fileName);

        // Return a web-friendly path (relative to public)
        return $relativePath.$fileName;
    }
}
