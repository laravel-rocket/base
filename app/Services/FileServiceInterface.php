<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface FileServiceInterface extends BaseServiceInterface
{
    /**
     * @param string $categoryType
     * @param string $text
     * @param string $mediaType
     * @param array $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function uploadFromText(string $categoryType, string $text, string $mediaType, array $metaInputs): ?\App\Models\File;

    /**
     * @param int $categoryType
     * @param string $path
     * @param string $mediaType
     * @param array $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function upload(int $categoryType, string $path, string $mediaType, array $metaInputs): ?\App\Models\File;

    /**
     * @param \App\Models\File $model
     *
     * @return bool|null
     */
    public function delete(\App\Models\File $model): ?bool;

    /**
     * @param string $categoryType
     * @param string $url
     * @param string $mediaType
     * @param array $metaInputs
     *
     * @return \App\Models\File|null
     */
    public function createFromUrl(string $categoryType, string $url, string $mediaType, array $metaInputs): ?\App\Models\File;
}
