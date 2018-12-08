<?php
namespace App\Services\Production;

use App\Services\ExportServiceInterface;
use LaravelRocket\Foundation\Services\Production\BaseService;

class ExportService extends BaseService implements ExportServiceInterface
{
    public function __construct()
    {
    }

    public function getModel(string $modelName)
    {
        $modelClass = '\\App\\Models\\'.$modelName;
        if (!class_exists($modelClass)) {
            return null;
        }

        /** @var \LaravelRocket\Foundation\Models\Base $modelInstance */
        $modelInstance = new $modelClass();

        return $modelInstance;
    }

    public function getRepository(string $modelName)
    {
        $repositoryInterfaceClass = 'App\\Repositories\\'.$modelName.'RepositoryInterface';

        if (!interface_exists($repositoryInterfaceClass)) {
            return null;
        }

        /** @var \LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository $repository */
        $repository = app()->make($repositoryInterfaceClass);

        return $repository;
    }

    public function selectColumns($model)
    {
        $columns = $model->getFillable();
        $columns = array_merge(['id'], $columns);

        return array_merge($columns, ['created_at', 'updated_at']);
    }

    public function checkModelExportable(string $modelName)
    {
        $model      = $this->getModel($modelName);
        $repository = $this->getRepository($modelName);

        return !empty($model) && !empty($repository);
    }
}
