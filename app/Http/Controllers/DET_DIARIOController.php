<?php

namespace App\Http\Controllers;

use App\Imports\DET_DIARIOImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DET_DIARIOController extends Controller
{
    public function importarDiario(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:xls,xlsx'
        ]);
        if ($request->hasFile('file')) {
            Excel::import(new DET_DIARIOImport, $request->file);
            return  response()->json(['success' => 'Diario inportado correctamente.']);
        }else{
            return response()->json(['error' => 'File not found'], 400);
        }
    }
}
