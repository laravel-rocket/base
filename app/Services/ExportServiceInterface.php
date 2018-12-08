<?php
namespace App\Services;

use LaravelRocket\Foundation\Services\BaseServiceInterface;

interface ExportServiceInterface extends BaseServiceInterface
{
    /**
     * @param string $modelName
     *
     * @return \LaravelRocket\Foundation\Models\Base|null
     */
    public function getModel(string $modelName);

    /**
     * @param string $modelName
     *
     * @return \LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository|null
     */
    public function getRepository(string $modelName);

    /**
     * @param \LaravelRocket\Foundation\Models\Base $model
     *
     * @return array
     */
    public function selectColumns($model);

    /**
     * @param string $modelName
     *
     * @return bool
     */
    public function checkModelExportable(string $modelName);
}
