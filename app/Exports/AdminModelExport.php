<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;

class AdminModelExport implements FromQuery
{
    use Exportable;

    /** @var string $modelName */
    protected $modelName;

    /**
     * @var \App\Services\ExportServiceInterface
     */
    protected $exportService;

    public function __construct(string $modelName)
    {
        $this->modelName     = $modelName;
        $this->exportService = app()->make(\App\Services\ExportServiceInterface::class);
    }

    /**
     * @param string $modelName
     *
     * @return \LaravelRocket\Foundation\Models\Base|null
     */
    protected function getModelInstance(string $modelName)
    {
        $modelClass = '\\App\\Models\\'.$modelName;
        if (!class_exists($modelClass)) {
            return null;
        }

        /** @var \LaravelRocket\Foundation\Models\Base $modelInstance */
        $modelInstance = new $modelClass();

        return $modelInstance;
    }

    /**
     * @param string $modelName
     *
     * @return \LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository|null
     */
    protected function getRepository(string $modelName)
    {
        $repositoryInterfaceClass = 'App\\Repositories\\'.$modelName.'RepositoryInterface';

        if (!interface_exists($repositoryInterfaceClass)) {
            return null;
        }

        /** @var \LaravelRocket\Foundation\Repositories\Eloquent\SingleKeyModelRepository $repository */
        $repository = app()->make($repositoryInterfaceClass);

        return $repository;
    }

    public function query()
    {
        $modelInstance = $this->getModelInstance($this->modelName);
        if (empty($modelInstance)) {
            return null;
        }
        $repository = $this->getRepository($this->modelName);
        if (empty($repository)) {
            return null;
        }

        return $repository->allByFilterQuery([], 'id', 'asc');
    }
}
