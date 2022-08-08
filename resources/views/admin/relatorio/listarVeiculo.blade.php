@extends('layouts.app')

@section('content')

    <style>
        td, tr, th, #somatoria {
            text-align: center !important;
        }
    </style>
    <div class="container">
        <tr>
            <th scope="col"><h1 style="text-align: center;">Relatorio de Veículos</h1></th>
        </tr>
        <table class="table table-secondary table-hover">

            <thead>

            <tr>
                <th scope="col">#</th>
                <th scope="col">Placa</th>
                <th scope="col">Marca</th>
                <th scope="col">Modelo</th>
                <th scope="col">Cor</th>
                <th scope="col">Ano</th>
                <th scope="col">Valor</th>
                <th scope="col">Taxa</th>
                <th scope="col">Diária</th>
                <th scope="col">Entregue</th>
                <th scope="col">Cliente</th>
            </tr>
            </thead>
            <tbody>
            @foreach($veiculos as $al)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$al->placa}}</td>
                    <td>{{$al->marca_name}}</td>
                    <td>{{$al->modelo}}</td>
                    <td>{{$al->cor}}</td>
                    <td>{{$al->ano}}</td>
                    <td>{{$al->valor}}</td>
                    <td>{{$al->taxa*100}}%</td>
                    <td>R$ {{ceil($al->taxa*100 * floatval(explode('R$ ', $al->valor)[1]) )}}</td>
                    <td>{{$al->entregue ? "Sim" : "Não"}}</td>
                    <td>{{$al->cliente_nome}}</td>
                </tr>
            @endforeach
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
