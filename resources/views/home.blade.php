@extends('adminlte::page')

@section('title', 'Home')


@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome Veiculo</th>
                        <th>Ano</th>
                        <th>Combustivel</th>
                        <th>Câmbio</th>
                        <th>Quilometragem</th>
                        <th>Portas</th>
                        <th>Cor</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($artigos as $artigo)
                    <tr>
                        <td>{{$artigo->id}}</td>
                        <td>{{$artigo->nome_veiculo}}</td>
                        <td>{{$artigo->ano}}</td>
                        <td>{{$artigo->combustivel}}</td>
                        <td>{{$artigo->cambio}}</td>
                        <td>{{$artigo->quilometragem}}</td>
                        <td>{{$artigo->nome_veiculo}}</td>
                        <td>{{$artigo->cor}}</td>
                        <td>
                            <form action="home/artigos/{{$artigo->id}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-sm btn-danger">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>



    {{ $artigos->links() }}

@endsection
