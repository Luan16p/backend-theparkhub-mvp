<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Estacionamento;
use App\Models\Vagas;

class SearchController extends Controller {

    public function index(Request $request)
    {
        $id_park = $request->input('estacionamentos');

        $estacionamentos = Estacionamento::where('IDEstacionamento', $id_park)->first();
        $vagas = Vagas::where('IDEstacionamento', $id_park)->get();

        $vagas_filtro = $vagas->map(function($vaga) {
            return [
                "IDVagaSingle" => $vaga->IDVagaSingle,
                "IDEstacionamento" => $vaga->IDEstacionamento,
                "DataLog" => Carbon::parse($vaga->DataLog)->format('d/m'),
                "HorarioEntrada" => Carbon::parse($vaga->HorarioEntrada)->format('H:i'),
                "HorarioSaida" => Carbon::parse($vaga->HorarioSaida)->format('H:i'),
            ];
        });

        if (!$id_park) {
            return redirect()->back()->with('error', 'ID do estacionamento não fornecido.');
        }

        if (!$estacionamentos) {
            return redirect()->back()->with('error', 'Estacionamento não encontrado.');
        }

        if(!$vagas) {
            return redirect()->back()->with('error', 'Nenhuma vaga foi encontrada!');
        }
        

        return redirect()->back()->with('success', ["park" => $estacionamentos, "place" => $vagas_filtro]);
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
