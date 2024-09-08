<?php

namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface FileServiceInterface extends BaseServiceInterface
{
    public function uploadFromText(string $categoryType, string $text, string $mediaType, array $metaInputs): ?\App\Models\File;

    public function upload(int $categoryType, string $path, string $mediaType, array $metaInputs): ?\App\Models\File;

    public function delete(\App\Models\File $model): ?bool;

    public function createFromUrl(string $categoryType, string $url, string $mediaType, array $metaInputs): ?\App\Models\File;
}
