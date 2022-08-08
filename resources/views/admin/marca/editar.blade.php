@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ isset($marca) ? 'Editar Marca' : 'Cadastrar Marca' }}</div>
                <div class="card-body">
                    <form action="{{ $edicao ? route('saveEditMarca') : route('saveCreateMarca')}}" method="post" class="form-control form p-3">
                        @csrf
                        @if($marca != null)
                            <input type="hidden" id="id" name="id" value="{{ optional($marca)->id }}">
                        @endif

                        <div class="d-flex col-lg-12 mb-2">
                            <div class="form-group col-md-4 px-2">
                                <label for="name" class="form-label mb-0">Nome</label>
                                <input type="text" class="form-control form-text mt-1"  placeholder="Nome" id="name" name="name" value="{{ optional($marca)->name }}" required>
                            </div>
                            <div class="form-group col-md-4 px-2">
                                <label for="porcentagem" class="form-label mb-0">Porcentagem</label>
                                <input type="text" class="form-control form-text mt-1" id="porcentagem" max placeholder="0.00%" value="{{ optional($marca)->taxa*100 }}" required>
                                <input type="hidden" id="taxa" name="taxa" value="{{ optional($marca)->taxa }}">
                            </div>

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
    <script>
        $(document).ready(function() {
            let $porcentagem = $("#porcentagem")
            let $taxa = $("#taxa");

           $porcentagem.change(function () {
               $porcentagem.mask('00.00%');
               let conversaoTaxa = parseFloat(
                   $porcentagem.val()
                   .split('%')
                   .join('')
                   .split(',')
                   .join('')
               )/100;

               $taxa.val(conversaoTaxa);
               console.log(conversaoTaxa)

           });
        });
    </script>
@endsection
