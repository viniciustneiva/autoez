@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ isset($veiculo) ? 'Editar Veículo' : 'Cadastrar Veículo' }}</div>
                <div class="card-body">
                    <form action="{{ $edicao ? route('saveEditVeiculo') : route('saveCreateVeiculo')}}" method="post" class="form-control form p-3">
                        @csrf
                        @if($veiculo != null)
                            <input type="hidden" id="id" name="id" value="{{ optional($veiculo)->id }}">
                        @endif

                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="placa" class="form-label mb-0">Placa</label>
                                <input type="text" class="form-control form-text mt-1" maxlength="7" placeholder="Placa" id="placa" name="placa" value="{{ optional($veiculo)->placa }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="email" class="form-label mb-0">Marca</label>
                                {!! Form::select('marca_id', ['' => 'Selecionar Marca'] + \App\Models\Marca::getMarcas(), optional($veiculo)->marca_id, ['id' => 'marca_id', 'class' => 'form-select gui-input', 'required']) !!}
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="modelo" class="form-label mb-0">Modelo</label>
                                <input type="text" class="form-control form-text mt-1" id="modelo" placeholder="Modelo" name="modelo" value="{{ optional($veiculo)->modelo }}" required>
                            </div>


                        </div>
                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-3 px-2">
                                <label for="cor" class="form-label mb-0">Cor</label>
                                <input type="text" class="form-control form-text mt-1 " id="cor"  name="cor" value="{{ optional($veiculo)->cor }}" required>
                            </div>
                            <div class="form-group col-md-3 px-2">
                                <label for="ano" class="form-label mb-0">Ano</label>
                                <input type="text" class="form-control form-text mt-1" id="ano" placeholder="Ano" maxlength="4" name="ano" value="{{ optional($veiculo)->ano }}"  class="ano">
                            </div>
                            <div class="form-group col-md-3 px-2">
                                <label for="valor" class="form-label mb-0">Valor de Compra</label>
                                <input type="text" class="form-control form-text mt-1" id="valor" placeholder="R$ 0,00"  name="valor" value="{{ optional($veiculo)->valor }}" required>
                            </div>

                            @if($edicao)
                                <div class="form-group col-md-3 px-2">
                                    <label for="valor" class="form-label mb-0">Disponível</label>
                                    <select name="disponivel" id="disponivel" class="form-select">
                                        <option value="0">Não</option>
                                        <option {{optional($veiculo)->disponivel ? 'selected' : ''}} value="1">Sim</option>
                                    </select>
                                </div>
                            @endif

                        </div>



                        <div class="form-group col-xs-12 px-2 py-3">
                            <button id="submit" type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('admin.util.userScripts')
@endsection
