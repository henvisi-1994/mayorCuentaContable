<?php

namespace App\Imports;

use App\Models\DET_DIARIO;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DET_DIARIOImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $originalDate =  $row['cc_fechamov'];
        $timestamp = strtotime($originalDate);
        $cc_fechamov = date("Y-m-d", $timestamp);
        return new DET_DIARIO([
            "CC_SEQMOV" =>$row[ 'cc_seqmov'],
            "CC_SEQCTA" =>$row[ 'cc_seqcta'],
            "CC_NUMCOM" =>$row[ 'cc_numcom'],
            "CC_FECMOV" => $cc_fechamov,
            "CC_TIPOPE" =>$row[ 'cc_tipope'],
            "CC_VALOR" =>$row[ 'cc_valor'],
            "LOGIN" =>$row[ 'login'],
            "CC_ANIOMES" =>$row[ 'cc_aniomes'],
        ]);
    }
}
//CC_ANIOMES
