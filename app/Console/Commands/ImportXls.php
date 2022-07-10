<?php

namespace App\Console\Commands;

use App\Imports\ContactsImport;
use Illuminate\Console\Command;
use Illuminate\Http\UploadedFile;
use Maatwebsite\Excel\Facades\Excel;
use function Symfony\Component\String\s;

class ImportXls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:xls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $filePath = public_path('contacts.xlsx');
            $file = new UploadedFile($filePath, 'contacts.xlsx');

            Excel::import(new ContactsImport, $file);
        } catch (\Throwable $exception) {
            return 1;
        }

        return 0;
    }
}
