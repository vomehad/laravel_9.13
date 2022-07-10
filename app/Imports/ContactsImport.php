<?php

namespace App\Imports;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ContactsImport implements ToModel, WithBatchInserts
{
    /**
     * @param array $row
     *
     * @return Contact
     */
    public function model(array $row): Contact
    {
        return new Contact([
            'username' => $row[1],
            'name' => $row[2] ?: 'name',
            'email' => $row[3],
            'subject' => $row[4],
            'message' => $row[5],
        ]);
    }

    public function batchSize(): int
    {
        return 100;
    }
}
