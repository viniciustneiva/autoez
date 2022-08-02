@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarFuncionario')}}"><button class="btn btn-primary">Adicionar Funcionário</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Funcionários</div>

                <div class="card-body">
                    @if(count($funcionarios) > 0)
                        @foreach($funcionarios as $f)
                            <a href="{{'/funcionario/editar/' . $f->id}}"><div class="list-group-item-primary">{{ $f->name . ' - ' . $f->email }}</div></a>
                        @endforeach
                    @else
                        <div class="list-group-item-primary">Não foram encontrados funcionários cadastrados.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
