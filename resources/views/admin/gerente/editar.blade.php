@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ isset($gerente) ? 'Editar Gerente' : 'Criar Gerente' }}</div>

                <div class="card-body">
                    <form action="#" class="form-control form">
                        <div class="form-group col-xs-12 col-sm-9 col-md-6 col-lg-3">
                            <label for="nome" class="form-label">Nome</label>
                            <input type="text" class="form-control form-text" id="nome">
                        </div>
                        <div class="form-group col-xs-12 col-sm-9 col-md-6 col-lg-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control form-text" id="email">
                        </div>
                        <div class="form-group col-xs-12 col-sm-9 col-md-6 col-lg-3">
                            <button class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
