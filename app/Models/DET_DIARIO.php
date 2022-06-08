<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DET_DIARIO extends Model
{
    use HasFactory;
    protected $table = 'DET_DIARIO';// nombre de la tabla categories
    protected $primaryKey ='CC_SEQMOV'; //id de la tabla categories
    protected $fillable= [
        'CC_SEQMOV',
        'CC_SEQCTA',
        'CC_NUMCOM',
        'CC_FECMOV',
        'CC_TIPOPE',
        'CC_VALOR',
        'LOGIN',
        'CC_ANIOMES',
    ];
}
