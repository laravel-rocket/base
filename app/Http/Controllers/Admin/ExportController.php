<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Request;
use LaravelRocket\Foundation\Exports\AdminModelExport;
use LaravelRocket\Foundation\Services\ExportServiceInterface;
use function ICanBoogie\singularize;

class ExportController extends Controller
{
    /** @var \LaravelRocket\Foundation\Services\ExportServiceInterface $exportService */
    protected $exportService;

    public function __construct(ExportServiceInterface $exportService)
    {
        $this->exportService = $exportService;
    }

    public function export($model, Request $request)
    {
        $format    = $request->get('format', 'csv');
        $modelName = singularize(ucfirst(camel_case($model)));

        if (!$this->exportService->checkModelExportable($modelName)) {
            abort(404);
        }

        $extension      = 'csv';
        $formatConstant = \Maatwebsite\Excel\Excel::CSV;
        switch (strtolower($format)) {
            case 'excel':
            case 'xlsx':
                $extension      = 'xlsx';
                $formatConstant = \Maatwebsite\Excel\Excel::XLSX;
                break;
            case 'csv':
                $extension      = 'csv';
                $formatConstant = \Maatwebsite\Excel\Excel::CSV;
                break;
            case 'tsv':
                $extension      = 'tsv';
                $formatConstant = \Maatwebsite\Excel\Excel::TSV;
                break;
            case 'html':
                $extension      = 'html';
                $formatConstant = \Maatwebsite\Excel\Excel::HTML;
                break;
            case 'pdf':
                $extension      = 'pdf';
                $formatConstant = \Maatwebsite\Excel\Excel::MPDF;
                break;
        }

        return \Excel::download(new AdminModelExport($modelName), $modelName.'.'.$extension, $formatConstant);
    }
}
