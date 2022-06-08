<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DET_DIARIODET extends Model
{
    use HasFactory;
    protected $table = 'DET_DIARIODET';// nombre de la tabla categories
    protected $primaryKey ='CC_SEQMOV'; //id de la tabla categories
    protected $fillable=[
        'CC_SEQMOV',
        'CC_DETALLE'
    ];
}
