<?php

namespace App\Console\Commands;

use App\Exports\ContactsExport;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Excel as ExcelConfig;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ExportXls extends Command
{
    protected $signature = "export:xls {path?}";

    public function handle()
    {
        $start = microtime(true);
        $name = $this->argument('path') ?: "export.xlsx";
        echo $name . PHP_EOL;

        try {
            echo Carbon::now();
            echo PHP_EOL;

            Excel::store(new ContactsExport(), $name, 'public', ExcelConfig::XLSX);

            echo Carbon::now();
            echo PHP_EOL;
            echo microtime(true) - $start;
            echo PHP_EOL;
        } catch (Throwable $exception) {
            echo microtime(true) - $start;
            echo PHP_EOL;
            echo $exception->getMessage();
            echo PHP_EOL;

            return 1;
        }

        return 0;
    }
}
