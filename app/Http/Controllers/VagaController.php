<?php

namespace App\Http\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Models\Vagas;
use App\Models\Estacionamento;

class VagaController extends Controller
{
    public function index() {
        $estacionamentos = Estacionamento::all();

        $estacionamentosFiltro = $estacionamentos->map(function ($estacionamento) {
            return [
                'ID' => $estacionamento->IDEstacionamento,
                'name_park' => $estacionamento->TargetName,
                'qnt_vagas' => $estacionamento->QntVagas
            ];
        });

        return view('estacionamento_reservar', ["estacionamentos" => $estacionamentosFiltro]);
    }

    public function create(Request $request) {
  
    }

    public function store(Request $request) {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'numeroVaga' => 'required',
            'data-entrada' => 'required|date_format:Y-m-d',
            'horario-entrada' => 'required|date_format:H:i',
            'horario-saida' => 'required|date_format:H:i',
        ]);
    
        $firstName = $request->input('firstName');
        $lastName = $request->input('lastName');

        $park = $request->input('estacionamentos');

        $identify = $request->input('numeroVaga');

        $date = Carbon::createFromFormat('Y-m-d', $request->input('data-entrada'));

        $entrance = $date->copy()->setTimeFromTimeString($request->input('horario-entrada'));
        $exit = $date->copy()->setTimeFromTimeString($request->input('horario-saida'));

        if ($entrance->greaterThanOrEqualTo($exit)) {
            return redirect()->route('reservar.index')->with('error', 'Horário de entrada não pode ser superior ao de saída!');
        } 

        if($date->lt(Carbon::today()->startOfDay())) {
            return redirect()->route('reservar.index')->with('error', 'Data escolhida é menor que a data atual, não reservamos para o passado a menos que tenha um delorean!');
        }

        if ($entrance->month != Carbon::now()->month) {
            return redirect()->route('reservar.index')->with('error', 'Data da reserva não pode ser feita para outros meses');
        }

        if ($entrance->year != Carbon::now()->year) {
            return redirect()->route('reservar.index')->with('error', 'Não é permitido reservar vagas para outros anos');
        }

        $validationDateForPark = Vagas::where('IDVagaSingle', $identify)
        ->where('DataLog', $date->toDateString())
        ->where(function ($query) use ($entrance, $exit) {
            $query->where(function ($q) use ($entrance, $exit) {
                $q->where('HorarioSaida', '>', $entrance)
                    ->where('HorarioEntrada', '<', $exit);
            })->orWhere(function ($q) use ($entrance, $exit) {
                $q->where('HorarioSaida', '>=', $entrance)
                    ->where('HorarioEntrada', '<=', $exit);
            });
        })
        ->exists();
        
        if($validationDateForPark) {
            return redirect()->route('reservar.index')->with('error', 'Esse horário já foi reservado, procure outro horário!');
        }

        $queryInsert = Vagas::create([
            'IDVagaSingle' => $identify,
            'IDEstacionamento' => $park,
            'FirstName' => $firstName,
            'LastName' => $lastName,
            'HorarioEntrada' => $entrance,
            'HorarioSaida' => $exit,
            'DataLog' => $date
        ]);

        if($queryInsert instanceof Vagas) {
            return redirect()->route('reservar.index')->with('success', 'Reserva realizada com sucesso!');
        }
    }

    public function show() {
        //
    }
    public function edit($id) {
        //
    }

    public function update(Request $request) {
        $estacionamento = $request->input('estacionamentos');
        if($estacionamento != '-1') {
            $estacionamento_por_id = Estacionamento::where('IDEstacionamento', $estacionamento)->first();

            return view('reservar', ["estacionamento_ref" => $estacionamento_por_id]);
        }
        return redirect()->back()->with('error', 'Especifique um Estacionamento!');
        
    }

    public function destroy($id) {
        //
    }
}
