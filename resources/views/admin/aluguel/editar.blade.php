@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ isset($aluguel) ? 'Editar Aluguel' : 'Cadastrar Aluguel' }}</div>
                <div class="card-body">
                    <form action="{{ $edicao ? route('saveEditAluguel') : route('saveCreateAluguel')}}" method="post" class="form-control form p-3">
                        @csrf
                        @if($aluguel != null)
                            <input type="hidden" id="id" name="id" value="{{ optional($aluguel)->id }}" readonly>
                        @endif

                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-6 px-2">
                                <label for="cliente_id" class="form-label mb-0">Cliente</label>
                                {!! Form::select('cliente_id', ['' => 'Selecionar Cliente'] + \App\Models\Cliente::getClientes(), optional($aluguel)->cliente_id, ['id' => 'cliente_id', 'class' => 'form-select gui-input', 'required', (optional($aluguel)->entregue) ? 'disabled' : '']) !!}

{{--                                <input type="text" class="form-control form-text mt-1" maxlength="7" placeholder="Placa" id="placa" name="placa" value="{{ optional($aluguel)->placa }}" required>--}}
                            </div>
                            <div class="form-group col-md-6 px-2">
                                <label for="email" class="form-label mb-0">Veículo </label>
                                @if(optional($aluguel)->veiculo_id)
                                    <input type="hidden" id="veiculo_id" name="veiculo_id" value="{{optional($aluguel)->veiculo_id}}">
                                    {!! Form::select('', ['' => 'Selecionar Veículo'] + \App\Models\Veiculo::getVeiculos(), optional($aluguel)->veiculo_id, ['id' => 'veiculo_id', 'class' => 'form-select gui-input', 'required', 'disabled' ]) !!}
                                @else
                                    {!! Form::select('veiculo_id', ['' => 'Selecionar Veículo'] + \App\Models\Veiculo::getVeiculosDisponiveis(), optional($aluguel)->veiculo_id, ['id' => 'veiculo_id', 'class' => 'form-select gui-input', 'required']) !!}
                                @endif

                            </div>
                            <input type="hidden" id="funcionario_id" name="funcionario_id" value="{{Auth::id()}}">



                        </div>
                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-6 px-2">
                                <label for="data_emprestimo" class="form-label mb-0">Data do Empréstimo</label>
                                <input type="date" class="form-control form-text mt-1" id="data_emprestimo" placeholder="Modelo" name="data_emprestimo" value="{{ optional($aluguel)->data_emprestimo }}" required {{(optional($aluguel)->entregue) ? 'readonly' : ''}}>
                            </div>

                            <div class="form-group col-md-6 px-2">
                                <label for="prazo" class="form-label mb-0">Prazo limite de Entrega</label>
                                <input type="date" class="form-control form-text mt-1 " id="prazo"  name="prazo" value="{{ optional($aluguel)->prazo }}" required {{(optional($aluguel)->entregue) ? 'readonly' : ''}}>
                            </div>

                        </div>
                        @if($edicao)
                            <div class="d-flex col-lg-12 mb-2">
{{--                                <div class="form-group col-md-6 px-2">--}}
{{--                                    <label for="data_entrega" class="form-label mb-0">Data Entrega</label>--}}
                                    <input type="hidden" id="data_entrega" {{(optional($aluguel)->data_entrega) ? 'readonly' : ''}}  name="data_entrega" value="{{ (optional($aluguel)->data_entrega) }}"  class="data_entrega" >
{{--                                </div>--}}
                                <div class="form-group col-md-6 px-2">
                                    <div class="d-flex flex-column">
                                        <label for="valor" class="form-label form-check-label mb-0">Entregue</label>
                                        <select class="form-select gui-input" name="entregue" id="entregue" {{(optional($aluguel)->entregue) ? 'disabled' : 'required'}}>
                                            <option value="0">Não</option>
                                            <option {{(optional($aluguel)->entregue) ? 'selected' : ''}} value="1">Sim</option>
                                        </select>
{{--                                        <input type="checkbox" id="entregue" class="form-check form-check-input" name="entregue" value="1" {{(optional($aluguel)->entregue == 1) ? ' checked disabled' : ''}}>--}}
                                    </div>

{{--                                    <input type="text" class="form-control form-text mt-1" id="valor" placeholder="R$ 0,00"  name="valor" value="{{ optional($aluguel)->valor }}" required>--}}
                                </div>
                            </div>

                        @endif


                        <div class="form-group col-xs-12 px-2 py-3">
                            @if(optional($aluguel)->entregue)
                                <a class="btn btn-primary" href="{{route('listarAlugueis')}}">Voltar</a>
                            @else
                                <button id="submit" type="submit" class="btn btn-primary">Salvar</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('admin.util.userScripts')
    <script>
        $(document).ready(function (){


            const x = new Date($('#data_emprestimo').val());
            $("#prazo").blur(function () {
                const y = new Date($('#prazo').val());
                if(x >= y){
                    $('#prazo').val('');
                }
            })

            $("#data_entrega").blur(function () {

                const y = new Date($('#data_entrega').val());
                if(x >= y){
                    $('#data_entrega').val('');
                }
            })

            if($('#entregue option[value="1"]').attr("selected", "selected")) {
                let dia = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"})

                console.log($('#data_entrega').val(dia.split(' ')[0].split('/').reverse().join('-')))
            }

        });
    </script>
@endsection
