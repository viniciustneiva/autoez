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

                                {!! Form::select('cliente_id', ['' => 'Selecionar Cliente'] + \App\Models\Cliente::getClientes(), optional($aluguel)->cliente_id, ['id' => 'cliente_id', 'class' => 'form-select gui-input', 'required', ($edicao) ? 'disabled' : '']) !!}
                                @if($edicao)
                                    <input type="hidden" name="cliente_id" value="{{optional($aluguel)->cliente_id}}">
                                @endif
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
                                <input type="date" class="form-control form-text mt-1" id="data_emprestimo" placeholder="Modelo" name="data_emprestimo" value="{{ optional($aluguel)->data_emprestimo }}" required {{($edicao ? 'readonly' : '')}}>
                            </div>

                            <div class="form-group col-md-6 px-2">
                                <label for="prazo" class="form-label mb-0">Prazo limite de Entrega</label>
                                <input type="date" class="form-control form-text mt-1 " id="prazo"  name="prazo" value="{{ optional($aluguel)->prazo }}" required {{(optional($aluguel)->entregue ? 'readonly' : '')}}>
                            </div>

                        </div>
                        @if($edicao)
                            <div class="d-flex col-lg-12 mb-2">

                                <input type="hidden" id="data_entrega" name="data_entrega" value="{{ (optional($aluguel)->data_entrega!=null ? optional($aluguel)->data_entrega : '' ) }}"  class="data_entrega" >
{{--                                </div>--}}
                                <div class="form-group col-md-6 px-2">
                                    <div class="d-flex flex-column">
                                        <label for="valor" class="form-label form-check-label mb-0">Entregue</label>
                                        <select class="form-select gui-input" name="entregue" id="entregue" {{(optional($aluguel)->entregue  && optional($aluguel)->entregue== 1) ? 'disabled' : 'required'}}>
                                            <option value="0">Não</option>
                                            <option {{(optional($aluguel)->entregue == 1 ? 'selected' : '')}} value="1">Sim</option>
                                        </select>
{{----}}
                                    </div>

{{----}}
                                </div>
                            </div>
                        @else

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

            @if(!$edicao)
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
            @else
                $("#entregue").change(function () {
                    let v_OptionSelected = $(this).find("option:selected");
                    if(v_OptionSelected.val() == 1) {

                        let dia = new Date().toLocaleString("pt-BR", {timeZone: "America/Sao_Paulo"})

                        $('#data_entrega').val(dia.split(' ')[0].split('/').reverse().join('-'))
                    }
                });

            @endif



        });
    </script>
@endsection
