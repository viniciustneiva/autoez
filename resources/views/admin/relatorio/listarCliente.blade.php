@extends('layouts.app')

@section('content')

    <style>
        td, tr, th, #somatoria {
            text-align: center !important;
        }
    </style>
    <div class="container">
        <tr>
            <th scope="col"><h1 style="text-align: center;">Relatorio de Clientes</h1></th>
        </tr>
        <table class="table table-secondary table-hover">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nome</th>
                <th scope="col">Email</th>
                <th scope="col">Data Nascimento</th>
                <th scope="col">Telefone</th>
                <th scope="col">CPF</th>
                <th scope="col">Endereço</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clientes as $al)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$al->name}}</td>
                    <td>{{$al->email}}</td>
                    <td>{{$al->data_nascimento}}</td>
                    <td>{{$al->telefone}}</td>
                    <td>{{$al->cpf}}</td>
                    <td>{{$al->endereco}}</td>

                </tr>
            @endforeach
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
        </table>
    </div>

@endsection

@section('scripts')
@endsection
