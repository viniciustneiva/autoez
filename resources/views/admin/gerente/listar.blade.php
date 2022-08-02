@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarGerente')}}"><button class="btn btn-primary">Adicionar Gerente</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Gerentes</div>

                <div class="card-body">
                    @if(count($gerentes) > 0)
                        @foreach($gerentes as $g)
                            <a href="{{'/funcionario/editar/' . $g->id}}"><div class="list-group-item-primary">{{ $g->name . ' - ' . $g->email }}</div></a>
                        @endforeach
                    @else
                        <div class="list-group-item-primary">Não foram encontrados gerentes cadastrados.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
