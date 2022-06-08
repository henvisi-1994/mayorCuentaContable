<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TMA_PLANCTA extends Model
{
    use HasFactory;
    protected $table = 'TMA_PLANCTA';// nombre de la tabla categories
    protected $primaryKey ='CC_SEQCTA';
    protected $fillable=[
        'CC_SEQCTA',
        'CC_NIVEL1',
        'CC_NIVEL2',
        'CC_NIVEL3',
        'CC_NIVEL4',
        'CC_NIVEL5',
        'CC_NIVEL6',
        'CC_AUXILIAR',
        'CC_CTAMOV',
        'CC_FECAPE',
        'CC_NOMBRE',
        'CC_TIPCTA',
        'CC_CLASE',
    ]; //id de la tabla categories
}
