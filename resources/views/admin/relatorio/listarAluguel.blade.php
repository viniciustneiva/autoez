@extends('layouts.app')

@section('content')
    <style>
        td, tr, th, #somatoria {
            text-align: center !important;
        }
    </style>
    <div class="container">
        <tr>
            <th scope="col"><h1 style="text-align: center;">Relatorio de Aluguel</h1></th>
        </tr>
        <table class="table table-secondary table-hover">
            <thead>
            <tr>

                <th scope="col">#</th>
                <th scope="col">Cliente</th>
                <th scope="col">Placa Veículo</th>
                <th scope="col">Diária</th>
                <th scope="col">Funcionário</th>
                <th scope="col">Data Empréstimo</th>
                <th scope="col">Prazo</th>
                <th scope="col">Entregue</th>
                <th scope="col">Data Entrega</th>
                <th scope="col">Total</th>
            </tr>
            </thead>
            <tbody>


            <script>
                let total = 0;
            </script>
            @foreach($listaAlugueis as $al)

                <tr>
                    <th scope="row">{{$loop->iteration}}</th>
                    <td>{{$al->cliente->name}}</td>
                    <td>{{$al->veiculo->placa}}</td>
                    <td>R${{ceil($al->diaria/10)}}</td>
                    <td>{{$al->funcionario->name}}</td>
                    <td>{{date('d/m/Y', strtotime($al->data_emprestimo))}}</td>
                    <td>{{date('d/m/Y', strtotime($al->prazo))}}</td>
                    <td>{{($al->entregue) ? 'Sim' : "Não"}}</td>
                    <td>{{($al->data_entrega!=null) ? date('d/m/Y', strtotime($al->data_entrega)) : '-'}}</td>
                    <td style="text-align: center">{{ ($al->dias_utilizados * ceil($al->diaria/10))!=0 ? 'R$ ' . ($al->dias_utilizados * ceil($al->diaria/10)) .',00' : '' }}</td>
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


