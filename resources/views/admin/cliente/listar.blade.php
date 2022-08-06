@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarCliente')}}"><button class="btn btn-primary">Adicionar Cliente</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Clientes</div>

                <div class="card-body">
                    <div class="d-flex my-2">
                        <form id="form-search" name="form-search" style="width: 100%;">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="meuTypeahead" name="clientes" placeholder="Buscar" autocomplete="off">
                                    </div>
                                    <div class="typeahead__button">
                                        <button type="submit">
                                            <i class="typeahead__search-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{--                        <input type="text" id="typeahead" class="typeahead__ typeahead meuTypeAhead">--}}
                    </div>
                    <div id="itensLista">
                        @if(count($clientes) > 0)
                            @foreach($clientes as $c)
                                <div class="card d-flex  my-2">
                                    <div id="funcionario_{{$c->id}}" class="rounded-0  p-2  d-flex justify-content-start flex-column">
                                        <div class="d-flex">
                                            <p class=" mb-1 mx-2">Nome: {{$c->name }}</p>
                                            <p class=" mb-1 mx-2">Email: {{$c->email }}</p>
                                        </div>

                                        <p class=" mb-1 mx-2">Telefone: {{$c->telefone }}</p>
                                        <p class="mb-1 mx-2">{{ $c->rua . ", " . $c->numero . ", " . $c->bairro . ", " . $c->cidade . "-" . $c->estado . ", " . $c->cep }}</p>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @else
                        <div class="card d-flex  my-2">
                            <div class="list-group-item-primary rounded-0  p-2">Não foram encontrados clientes cadastrados.</div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    <script>
        $.typeahead({
            input: '.meuTypeahead',
            order: "asc",
            minLength: 2,
            offset: true,
            source: {
                data: [
                    @foreach($clientes as $c)
                        "{!! $c->name!!}",
                    @endforeach
                ]
            },
            callback: {
                onClick: function (node, a, item, event) {
                    $.ajax({
                        url: '{{route('buscarCliente')}}',
                        data: {'name': item.display, _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            console.log(response.tipo)

                            window.location.href = "{{ route('editarCliente') }}" + '/' + response.id;

                        },
                        error: function (response) {
                            console.log(response)
                        }
                    });
                    // console.log('onClick function triggered');
                },
                onSubmit: function (node, form, item, event) {
                    event.preventDefault()

                    $.ajax({
                        url: '{{route('buscarClienteLike')}}',
                        data: {'name': $(".meuTypeahead").val(), _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            $("#itensLista").html('')
                            for(let r of response){
                                let novoHtml = '<div class="card d-flex my-2">\
                                                    <div id="funcionario_'+r.id+'" class="rounded-0 p-2 d-flex justify-content-start flex-column">\
                                                        <div class="d-flex">\
                                                            <p class=" mb-1 mx-2">Nome: '+r.name+'</p>\
                                                            <p class=" mb-1 mx-2">Email: '+r.email+'</p>\
                                                        </div>\
                                                        <p class=" mb-1 mx-2">Telefone: '+r.telefone+'</p>\
                                                        <p class="mb-1 mx-2">'+r.rua+', '+r.numero+', '+r.bairro+', '+r.cidade+', '+r.cidade+'-'+r.estado+', '+r.cep+'</p>\
                                                    </div>\
                                                </div>';
                                $("#itensLista").append(novoHtml)
                            }
                            //console.log(response)

                            window.location.href = "{{ route('editarCliente') }}" + '/' + response.id;

                        },
                        error: function (response) {
                            console.log(response)
                        }
                    });
                }

            }
        });
    </script>
@endsection
