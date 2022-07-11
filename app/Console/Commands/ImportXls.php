<?php

namespace App\Console\Commands;

use App\Imports\ContactsImport;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class ImportXls extends Command
{
    protected $signature = "import:xls {path?}";

    public function handle()
    {
        $start = microtime(true);
        $name = $this->argument('path') ?: 'excel.xlsx';
//        $name = public_path() . $this->argument('path') ?: 'excel.xlsx';
        echo $name . PHP_EOL;

        try {
            echo Carbon::now();
            echo PHP_EOL;

            $filePath = public_path($name);
            $file = new UploadedFile($filePath, $name);

            Excel::import(new ContactsImport, $file);
            $this->info(Carbon::now());
            echo PHP_EOL;
            $this->info(microtime(true) - $start);
            echo PHP_EOL;
        } catch (Throwable $exception) {
            $this->error(microtime(true) - $start);
            echo PHP_EOL;
            $this->error($exception->getMessage());
            echo PHP_EOL;

            return 1;
        }

        return 0;
    }
}
