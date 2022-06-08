<?php

namespace App\Imports;

use App\Models\DET_DIARIODET;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DET_DIARIODETImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new DET_DIARIODET([
           "CC_SEQMOV" =>$row[ 'cc_seqmov'],
           "CC_DETALLE" =>$row[ 'cc_detalle'],
        ]);
    }
}
