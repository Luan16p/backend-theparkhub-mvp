@extends('master')


<div>
    <form action={{route('reservar.store')}} method="POST">
        @csrf    
        <input type="hidden" name="__method" value="PUT">
        <input type="hidden" name="estacionamentos" value={{$estacionamento_ref->IDEstacionamento}}>

        <div>
            <p>Passo 2</p>
            <h3>Preencher os dados e reservar a vaga...</h3>
        </div>

        <label for="park">Estacionamento</label>
        <select name="park">
            <option value="-1">{{$estacionamento_ref->TargetName}}</option>
        </select>
        <br>

        <label for="firstName">Digite o primeiro nome do condutor</label>
        <input type="text" name="firstName" placeholder="Ex: Dummy">
        <br>

        <label for="lastName">Digite o ultimo nome do condutor</label>
        <input type="text" name="lastName" placeholder="Ex: Smith">
        <br>

        <label for="numeroVaga">Digite o identificador da vaga 1-{{$estacionamento_ref->QntVagas}}</label>
        <input type="number" name="numeroVaga" min="1" max="{{$estacionamento_ref->QntVagas}}">
        <br>

        <label for="data-entrada">Que dia você ocupará a vaga?</label>
        <input type="date" name="data-entrada">
        <br>

        <label for="horario-entrada">Que horario você entrará?</label>
        <input type="time" name="horario-entrada">
        <br>

        <label for="horario-saida">Que horario você sairá?</label>
        <input type="time" name="horario-saida">
        <br>
        <br>

        <button type="submit">Reservar</button>
    </form>
    <hr>

    <a href="{{route('index')}}">Pagina inicial</a>
</div>