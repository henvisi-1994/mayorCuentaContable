<?php

namespace App\Http\Controllers;

use App\Imports\TMA_PLANCTAImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TMA_PLANCTAController extends Controller
{
    public function importarPlanCta(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if ($request->hasFile('file')) {
            Excel::import(new TMA_PLANCTAImport, $request->file('file'));
            return  response()->json(['success' => 'Plan de Cuentas inportado correctamente.']);
        } else {
            return response()->json(['error' => 'File not found'], 400);
        }
    }
}
