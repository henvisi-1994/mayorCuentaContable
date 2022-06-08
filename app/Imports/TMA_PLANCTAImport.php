<?php

namespace App\Imports;

use App\Models\TMA_PLANCTA;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TMA_PLANCTAImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $originalDate =  $row['cc_fecape'];
        $timestamp = strtotime($originalDate);
        $cc_fecape = date("Y-m-d", $timestamp);

        return new TMA_PLANCTA([
            "CC_SEQCTA" => $row['cc_seqcta'],
            "CC_NIVEL1" => $row['cc_nivel1'],
            "CC_NIVEL2" => $row['cc_nivel2'],
            "CC_NIVEL3" => $row['cc_nivel3'],
            "CC_NIVEL4" => $row['cc_nivel4'],
            "CC_NIVEL5" => $row['cc_nivel5'],
            "CC_NIVEL6" => $row['cc_nivel6'],
            "CC_AUXILIAR" => $row['cc_auxiliar'],
            "CC_CTAMOV" => $row['cc_ctamov'],
            "CC_FECAPE" =>  $cc_fecape ,
            "CC_NOMBRE" => $row['cc_nombre'],
            "CC_TIPCTA" => $row['cc_tipocta'],
            "CC_CLASE" => $row['cc_clase'],
        ]);
    }
}
