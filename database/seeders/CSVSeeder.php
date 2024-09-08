<?php
namespace Database\Seeders;

use Exception;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CSVSeeder extends Seeder
{
    protected string $table = 'table name';

    protected bool $isTest = false;

    protected bool $isDisabled = false;

    public function run(): void
    {
        if (!$this->isDisabled) {
            DB::table($this->table)->delete();
        }
        $csvFile = dirname(__FILE__).'/data/'.$this->table.'.csv';
        if ($this->isTest) {
            $csvFile = dirname(__FILE__).'/data/testing/'.$this->table.'.csv';
        } else {
            if ($this->isDisabled) {
                $csvFile = dirname(__FILE__).'/data/disabled/'.$this->table.'.csv';
            }
        }
        $data = $this->csvToArray($csvFile);
        if (count($data) < 100) {
            DB::table($this->table)->insert($data);
        } else {
            foreach ($data as $row) {
                DB::table($this->table)->insert($row);
            }
        }
        $data = null;
    }

    public function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename)) {
            return false;
        }

        $header = null;
        $data   = [];

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 1500, $delimiter)) !== false) {
                if (count($row) == 1 && trim($row[0]) == '') {
                    continue;
                }
                if (!$header) {
                    $header = $row;
                } else {
                    try {
                        $rowData = array_combine($header, $row);
                        if (!array_key_exists('created_at', $rowData)) {
                            $rowData['created_at'] = \DateTimeHelper::now();
                        }
                        if (!array_key_exists('updated_at', $rowData)) {
                            $rowData['updated_at'] = \DateTimeHelper::now();
                        }
                        $data[] = $rowData;
                    } catch (Exception $e) {
                        print_r($row);
                        echo $e->getMessage();
                        exit;
                    }
                }
            }
            fclose($handle);
        }

        return $data;
    }
}
