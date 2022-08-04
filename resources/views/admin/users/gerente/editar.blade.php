@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ isset($gerente) ? 'Editar Gerente' : 'Criar Gerente' }}</div>

                <div class="card-body">
                    <form action="{{route('salvarGerente')}}" class="form-control form p-3">
                        @csrf
                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="nome" class="form-label mb-0">Nome</label>
                                <input type="text" class="form-control form-text mt-1" id="name" name="name" value="{{ optional($gerente)->name }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="email" class="form-label mb-0">Email</label>
                                <input type="text" class="form-control form-text mt-1" id="email" name="email" value="{{ optional($gerente)->email }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="cpf" class="form-label mb-0">CPF</label>
                                <input type="text" class="form-control form-text mt-1" id="cpf" name="cpf" value="{{ optional($gerente)->cpf }}" required>
                            </div>

                        </div>
                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="cep" class="form-label mb-0">CEP</label>
                                <input type="text" class="form-control form-text mt-1" id="cep" value="{{ optional($gerente)->estado }}" name="cep" class="cep">
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="rua" class="form-label mb-0">Logradouro</label>
                                <input type="text" class="form-control form-text mt-1" id="rua" value="{{ optional($gerente)->rua }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="numero" class="form-label mb-0">Número</label>
                                <input type="text" class="form-control form-text mt-1" id="numero" value="{{ optional($gerente)->numero }}" required>
                            </div>

                        </div>
                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="complemento" class="form-label mb-0">Complemento</label>
                                <input type="text" class="form-control form-text mt-1 " id="complemento" value="{{ optional($gerente)->complemento }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="bairro" class="form-label mb-0">Bairro</label>
                                <input type="text" class="form-control form-text mt-1" id="bairro" value="{{ optional($gerente)->bairro }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="cidade" class="form-label mb-0">Cidade</label>
                                <input type="text" class="form-control form-text mt-1" id="cidade" value="{{ optional($gerente)->cidade }}" required>
                            </div>

                        </div>

                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="estado" class="form-label mb-0">Estado</label>
                                <input type="text" class="form-control form-text mt-1" id="estado" value="{{ optional($gerente)->estado }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="telefone" class="form-label mb-0">Telefone</label>
                                <input type="text" class="form-control form-text mt-1 " id="telefone" value="{{ optional($gerente)->telefone }}" required>
                            </div>
                        </div>

                        <div class="form-group col-xs-12 px-2 py-3">
                            <input id="submit" type="submit" class="btn btn-primary pull-right" value="Salvar">

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
