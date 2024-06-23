<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\Estacionamento;
use App\Models\Vagas;

class InterfaceController extends Controller
{
    public function index()
    {
        $estacionamentos = Estacionamento::all();
        $vagas = Vagas::all();

        $vagasFiltro = $vagas->map(function ($dado) {
            return [
                'id_pspace_res_server' => $dado->IDVagaSingle,
                'id_fk_res_server' => $dado->IDEstacionamento,
                'log_res_server' => Carbon::parse($dado->DataLog)->format("d/m/Y"),
                'time_entrance_res_server' => Carbon::parse($dado->HorarioEntrada)->format("H:i"),
                'time_exit_res_server' => Carbon::parse($dado->HorarioSaida)->format("H:i"), 
            ];
        });

        $estacionamentosFiltro = $estacionamentos->map(function ($estacionamento) {
            return [
                'ID' => $estacionamento->IDEstacionamento,
                'name_park' => $estacionamento->TargetName,
                'qnt_vagas' => $estacionamento->QntVagas
            ];
        });
        
        return view('app', ["vagas"=> $vagasFiltro, "estacionamentos" => $estacionamentosFiltro]);
    }
}
