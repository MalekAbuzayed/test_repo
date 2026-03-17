<?php

namespace App\Support;

class ZipArchiveFactory
{
    public function isAvailable(): bool
    {
        return class_exists(\ZipArchive::class);
    }

    public function make(): \ZipArchive
    {
        return new \ZipArchive();
    }
}
