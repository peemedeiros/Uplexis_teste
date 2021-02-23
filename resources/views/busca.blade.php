@extends('adminlte::page')

@section('title', 'Buscar veículos')

@section('content_header')
    <h1>Busca de veículos</h1>
@endsection

@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Digite o nome do carro que deseja adicionar</h3>
        </div>
        <form action="http://127.0.0.1:8000/home/buscar" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="busca">Nome do carro</label>
                    <input type="text" class="form-control" name="nome_veiculo" id="busca" placeholder="Ex. Audi">
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Capturar</button>
            </div>
        </form>
    </div>
@endsection
