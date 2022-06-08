<?php

namespace App\Http\Controllers;

use App\Imports\DET_DIARIODETImport;
use App\Models\DET_DIARIODET;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class DET_DIARIODETController extends Controller
{
    public function mayorCuentaContable(Request $request)
    {
        $fecha_inicio = $request->fecha_inicio;
        $fecha_fin = $request->fecha_fin;
        $cuenta_contable = $request->cuenta_contable;
        $codigo =  explode('.', $cuenta_contable);
        $nivel2 = $codigo[0];
        $nivel3 = $codigo[1];
        $nivel4 = $codigo[2];
        $nivel5 = ' ';
        $nivel6 = ' ';
        $auxiliar = ' ';
        switch (sizeof($codigo)) {
           case 4:
            $nivel5 = ' ';
            $nivel6 = ' ';
            $auxiliar = $codigo[3];
            break;
            case 5:
                $nivel5 = $codigo[3];
                $nivel6 = ' ';
                $auxiliar = $codigo[4];
                break;
            case 6:
                $nivel5 = $codigo[3];
                $nivel6 = $codigo[4];
                $auxiliar = $codigo[5];

                break;

            default:
                $nivel5 = ' ';
                $nivel6 = ' ';
                $auxiliar = ' ';
                break;
        }

        $anio_fiscal = Carbon::parse($request->fecha)->year;
        $consulta = "SELECT  tp.CC_NIVEL1,tp.CC_NOMBRE,dd.CC_ANIOMES , dd.CC_FECMOV , (SELECT CC_VALOR from DET_DIARIO dd2 WHERE CC_TIPOPE =1 AND  CC_SEQMOV = dd.CC_SEQMOV)as debito,
        (SELECT CC_VALOR from DET_DIARIO dd2 WHERE CC_TIPOPE =2 AND  CC_SEQMOV = dd.CC_SEQMOV)as credito, d.CC_DETALLE  from DET_DIARIODET d
        inner join DET_DIARIO dd on d.CC_SEQMOV = dd.CC_SEQMOV
        INNER  JOIN TMA_PLANCTA tp  on tp.CC_SEQCTA = dd.CC_SEQCTA
        Where  tp.CC_NIVEL2 = " .  $nivel2 . " AND tp.CC_NIVEL3 = " . $nivel3 . " AND tp.CC_NIVEL4 = '" . $nivel4 . "'AND  tp.CC_NIVEL5 = '" . $nivel5 . "' AND tp.CC_NIVEL6 = ' ".$nivel6."' AND tp.CC_AUXILIAR='" . $auxiliar . "'  AND dd.CC_FECMOV  BETWEEN '" . $fecha_inicio . " '   AND  '" . $fecha_fin . "' ORDER BY dd.CC_FECMOV  ASC ";
        $mayorContable = DB::select($consulta);
        $nombre_cuenta = $mayorContable[0]->CC_NOMBRE;
        $nivel1 = $mayorContable[0]->CC_NIVEL1;
        $saldo = $this->obtenerSaldo($fecha_inicio, $nivel1, $nivel2, $nivel3, $nivel4, $nivel5, $auxiliar,  $anio_fiscal);
        $registro = [];
        array_push($registro, array('diario' => "", 'fecha' => "", 'ref' => "SaldoAnterior", 'debito' => 0, 'credito' => 0, 'saldo' => $saldo, 'detalle' => 'SALDO ANTERIOR'));
        foreach ($mayorContable as $diario) {
            $saldo = $saldo + (floatval($diario->debito) - floatval($diario->credito));
            array_push($registro, array('diario' => $diario->CC_ANIOMES, 'fecha' => $diario->CC_FECMOV, 'ref' => 0, 'debito' => floatval($diario->debito), 'credito' =>  floatval($diario->credito), 'saldo' =>  floatval($saldo), 'detalle' => $diario->CC_DETALLE));
        }
        return response()->json([
            'nombre_cuenta' => $nombre_cuenta,
            'anio_fiscal' => $anio_fiscal,
            'data' =>  json_encode($registro)
        ]);
    }

    public function obtenerSaldo($fecha_inicio, $nivel1, $nivel2, $nivel3, $nivel4, $nivel5, $auxiliar,  $anio_fiscal)
    {
        $debito = 0;
        $credito = 0;
        $timestamp = strtotime('01/01/' . $anio_fiscal);
        $primerFecha = date("Y-m-d", $timestamp);
        if ($nivel1 == 1 || $nivel1 == 2) {
            $debito = DET_DIARIODET::join('DET_DIARIO', 'DET_DIARIODET.CC_SEQMOV', '=', 'DET_DIARIO.CC_SEQMOV')
                ->join('TMA_PLANCTA', 'TMA_PLANCTA.CC_SEQCTA', '=', 'DET_DIARIO.CC_SEQCTA')
                ->where('TMA_PLANCTA.CC_NIVEL2', $nivel2)
                ->where('TMA_PLANCTA.CC_NIVEL3', $nivel3)
                ->where('TMA_PLANCTA.CC_NIVEL4', $nivel4)
                ->where('TMA_PLANCTA.CC_NIVEL5', $nivel5)
                ->where('TMA_PLANCTA.CC_NIVEL6', '')
                ->where('TMA_PLANCTA.CC_AUXILIAR', $auxiliar)
                ->where('CC_TIPOPE', 1)
                ->where('CC_FECMOV', '<', $fecha_inicio)->get()->sum('CC_VALOR');
            $debito = floatval($debito);
            $credito = DET_DIARIODET::join('DET_DIARIO', 'DET_DIARIODET.CC_SEQMOV', '=', 'DET_DIARIO.CC_SEQMOV')
                ->join('TMA_PLANCTA', 'TMA_PLANCTA.CC_SEQCTA', '=', 'DET_DIARIO.CC_SEQCTA')
                ->where('TMA_PLANCTA.CC_NIVEL2', $nivel2)
                ->where('TMA_PLANCTA.CC_NIVEL3', $nivel3)
                ->where('TMA_PLANCTA.CC_NIVEL4', $nivel4)
                ->where('TMA_PLANCTA.CC_NIVEL5', $nivel5)
                ->where('TMA_PLANCTA.CC_NIVEL6', '')
                ->where('TMA_PLANCTA.CC_AUXILIAR', $auxiliar)
                ->where('CC_TIPOPE', 2)
                ->where('CC_FECMOV', '<', $fecha_inicio)->get()->sum('CC_VALOR');
            $credito = floatval($credito);
        } elseif ($nivel1 == 3) {
            $debito = DET_DIARIODET::join('DET_DIARIO', 'DET_DIARIODET.CC_SEQMOV', '=', 'DET_DIARIO.CC_SEQMOV')
                ->join('TMA_PLANCTA', 'TMA_PLANCTA.CC_SEQCTA', '=', 'DET_DIARIO.CC_SEQCTA')
                ->where('TMA_PLANCTA.CC_NIVEL2', $nivel2)
                ->where('TMA_PLANCTA.CC_NIVEL3', $nivel3)
                ->where('TMA_PLANCTA.CC_NIVEL4', $nivel4)
                ->where('TMA_PLANCTA.CC_NIVEL5', $nivel5)
                ->where('TMA_PLANCTA.CC_NIVEL6', '')
                ->where('TMA_PLANCTA.CC_AUXILIAR', $auxiliar)
                ->where('CC_TIPOPE', 1)
                ->whereBetween('CC_FECMOV', [$primerFecha, $fecha_inicio])->get()->sum('CC_VALOR');
            $debito = floatval($debito);
            $credito = DET_DIARIODET::join('DET_DIARIO', 'DET_DIARIODET.CC_SEQMOV', '=', 'DET_DIARIO.CC_SEQMOV')
                ->join('TMA_PLANCTA', 'TMA_PLANCTA.CC_SEQCTA', '=', 'DET_DIARIO.CC_SEQCTA')
                ->where('TMA_PLANCTA.CC_NIVEL2', $nivel2)
                ->where('TMA_PLANCTA.CC_NIVEL3', $nivel3)
                ->where('TMA_PLANCTA.CC_NIVEL4', $nivel4)
                ->where('TMA_PLANCTA.CC_NIVEL5', $nivel5)
                ->where('TMA_PLANCTA.CC_NIVEL6', '')
                ->where('TMA_PLANCTA.CC_AUXILIAR', $auxiliar)
                ->where('CC_TIPOPE', 2)
                ->whereBetween('CC_FECMOV', [$primerFecha, $fecha_inicio])->get()->sum('CC_VALOR');
            $credito = floatval($credito);
        }

        $saldo = $debito - $credito;
        return $saldo;
    }
    public function importarDetalle_diario(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if ($request->hasFile('file')) {
            Excel::import(new DET_DIARIODETImport, $request->file);
            return  response()->json(['success' => 'Diario inportado correctamente.']);
        } else {
            return response()->json(['error' => 'File not found'], 400);
        }
    }
}
