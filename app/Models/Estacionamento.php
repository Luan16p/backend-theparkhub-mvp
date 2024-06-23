<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estacionamento extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'Estacionamentos';
    protected $primarykey = 'IDEstacionamento';

    protected $fillable = [
        'IDEstacionamento',
        'TargetName',
        'QntVagas',
        'VagasReservadas',
    ];
    
}
