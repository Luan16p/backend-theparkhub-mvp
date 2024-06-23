@extends('master')


@if(session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
        <hr>
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
        <hr>
    </div>
@endif

<div>
    <div>
        <p>Passo 1</p>
        <h3>Selecione o estacionamento que você quer estacionar...</h3>
    </div>

    <form action="{{route('reservar.update')}}" method="post">
        @csrf

        <input type="hidden" name="__method" value="PUT">
        
        <select name="estacionamentos" id="input-select-park">
            <option value="-1">Selecionar um estacionamento</option>

            @foreach ($estacionamentos as $estacionamento)
                <option value={{$estacionamento['ID']}}>{{$estacionamento['name_park']}}</option>
            @endforeach

        </select>

        <button type="submit">Proximo</button>
    </form>

    <hr>
    
    <a href="{{route('index')}}">Pagina inicial</a>
</div>  