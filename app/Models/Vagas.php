<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vagas extends Model
{
    use HasFactory;
    
    public $timestamps = false;

    protected $table = "Vagas";
    protected $primarykey = 'IDVagaGeneral';

    protected $fillable = [
        'IDVagaSingle',
        'IDEstacionamento',
        'FirstName',
        'LastName',
        'HorarioEntrada',
        'HorarioSaida',
        'DataLog',
    ];
    

    
}
