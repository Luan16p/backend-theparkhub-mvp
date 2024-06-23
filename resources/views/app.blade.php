@extends('master')

@section('app')

<h1>TheParkHub - O jeito mais facil de estacionar</h1>

<hr>

<div class="options">
    <h3>Opções</h3>

    <a href={{ route('reservar.index') }}>Reservar uma vaga</a>

</div>

<hr>

<div class="selecionar_estacionamento">

    <h3>Pesquisar estacionamento</h3>

    <form action={{route('pesquisar.index')}} method="GET">
        @csrf
        
        <select name="estacionamentos" id="input-select-park">
            <option value="disable">Selecionar um estacionamento</option>
            @foreach ($estacionamentos as $estacionamento)
                <option value={{$estacionamento['ID']}}>{{$estacionamento['name_park']}}</option>
            @endforeach
        </select>
        
        <button type="submit">Pesquisar</button>
    </form>
</div>

<hr>

@if (session('success'))
    <div class="queryBySuccess">
        <h3>{{ session('success')['park']['TargetName'] }}</h3>
        <table border="1">
            <tr>
                <td>Nº Vaga</td>
                <td>Estacionamento</td>
                <td>Dia</td>
                <td>Horario de entrada</td>
                <td>Horario de saida</td>
            </tr>

            @foreach (session('success')['place'] as $place_single)
                <tr>
                    <td>{{$place_single['IDVagaSingle']}}</td>
                    <td>{{session('success')['park']['TargetName']}}</td>
                    <td>{{$place_single['DataLog']}}</td>
                    <td>{{$place_single['HorarioEntrada']}}</td>
                    <td>{{$place_single['HorarioSaida']}}</td>
                </tr>
            @endforeach
        </table>

    </div>

    @else
        <p>Nada encontrado aqui...</p>
@endif

@endsection