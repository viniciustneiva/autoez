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
                <th scope="col">Telefone</th>
                <th scope="col">Veículo</th>
                <th scope="col">Ano</th>
                <th scope="col">Placa</th>
                <th scope="col">Diaria</th>
                <th scope="col">Dias Utilizados</th>
                <th scope="col">Entregue</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>
            <script>
                let total = 0;
            </script>
            @foreach($clientes as $al)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$al->name}}</td>
                    <td>{{$al->email}}</td>
                    <td>{{$al->telefone}}</td>
                    <td>{{$al->marca_carro . ' ' . $al->modelo}}</td>
                    <td>{{$al->ano}}</td>
                    <td>{{$al->placa}}</td>
                    <td>R${{ceil($al->diaria/10)}}</td>
                    <td>{{$al->dias_utilizados}}</td>
                    <td>{{($al->entregue) ? 'Sim' : "Não"}}</td>
                    <td style="text-align: center">{{ ($al->dias_utilizados * ceil($al->diaria/10))!=0 ? 'R$ ' . ($al->dias_utilizados * ceil($al->diaria/10)) .',00' : '-' }}</td>
                </tr>
                <script>
                    total += {{($al->dias_utilizados * ceil($al->diaria/10))}};
                </script>
            @endforeach
            <tr>
                <th scope="row"></th>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>Total: </td>
                <td id="somatoria"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <script>
        document.getElementById('somatoria').innerText = "R$ " + total +',00'
        console.log(total)
    </script>
@endsection

@section('scripts')
@endsection
