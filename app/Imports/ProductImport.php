<?php

namespace App\Imports;

use App\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;

class ProductImport implements ToModel, WithBatchInserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'id' => $row[0], 
            'name' => $row[1], 
            'price' => $row[2], 
            'stock' => $row[3], 
            'description' => $row[4], 
            'location' => $row[5],
        ]);
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
