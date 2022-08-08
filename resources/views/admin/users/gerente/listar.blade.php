@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarGerente')}}"><button class="btn btn-primary">Adicionar Gerente</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Gerentes</div>

                <div class="card-body">
                    <div class="d-flex my-2">
                        <form id="form-search" name="form-search" style="width: 100%;">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="meuTypeahead" name="funcionarios" placeholder="Buscar" autocomplete="off">
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
                        @if(count($gerentes) > 0)
                            @foreach($gerentes as $g)
                                <div class="card d-flex my-2 flex-row justify-content-between pe-1">
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-9">
                                        <div class="d-flex">
                                            <p class=" mb-1 mx-2">Nome: {{$g->name }}</p>
                                            <p class=" mb-1 mx-2">Email: {{$g->email }}</p>
                                        </div>

                                        <p class=" mb-1 mx-2">Telefone: {{$g->telefone }}</p>
                                        <p class="mb-1 mx-2">{{ $g->rua . ", " . $g->numero . ", " . $g->bairro . ", " . $g->cidade . "-" . $g->estado . ", " . $g->cep }}</p>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center align-items-center position-relative" style="width: 100%;">
                                        <h4 class="text-center">Ações</h4>
                                        <div class="d-flex flex-row justify-content-center align-items-center" style="width: 100%;">
                                            <a href={{ route('editarGerente') . '/' . $g->id }}><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>
                                            @if(\App\Models\TipoFuncionario::ehGerente() && Auth::id() != $g->id)
                                                <div class="btn btn-outline-danger botao-excluir m-1" usuario="{{$g->id}}" ><i class="fa-solid fa-trash"></i></div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @else
                        <div class="card d-flex  my-2">
                            <div class="list-group-item-primary rounded-0  p-2">Não foram encontrados gerentes cadastrados.</div>
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
        $(".botao-excluir").click(function (e) {

            let id = this.getAttribute('usuario');
            console.log(id)
            $(".modal-fullscreen").toggleClass('oculto');
            let url = "{{ url('/deletar-gerente') . '/'  }}";
            document.getElementById('modalId').setAttribute('href', url + id);
            //$("#modalId").attr('href').val();
        });
    </script>

    <script>
        $.typeahead({
            input: '.meuTypeahead',
            order: "asc",
            minLength: 2,
            offset: true,
            source: {
                data: [
                @foreach($gerentes as $g)
                    "{!! $g->name!!}",
                @endforeach
                ]
            },
        callback: {
        onClick: function (node, a, item, event) {
        $.ajax({
        url: '{{route('buscarFuncionario')}}',
        data: {'name': item.display, _token: '{{ csrf_token() }}'},
        type: 'POST',
        datatype: 'JSON',
        success: function (response) {
        console.log(response.tipo)

        window.location.href = "{{ route('editarGerente') }}" + '/' + response.id;

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
        url: '{{route('buscarFuncionarioLike')}}',
        data: {'name': $(".meuTypeahead").val(), _token: '{{ csrf_token() }}'},
        type: 'POST',
        datatype: 'JSON',
        success: function (response) {
        $("#itensLista").html('')
        for(let r of response){
        let novoHtml = '<div class="card d-flex my-2 flex-row justify-content-between pe-1">\
            <div id="funcionario_'+r.id+'" class="rounded-0 p-2 d-flex justify-content-start flex-column col-lg-9">\
                <div class="d-flex">\
                    <p class=" mb-1 mx-2">Nome: '+r.name+'</p>\
                    <p class=" mb-1 mx-2">Email: '+r.email+'</p>\
                </div>\
                <p class=" mb-1 mx-2">Telefone: '+r.telefone+'</p>\
                <p class="mb-1 mx-2">'+r.rua+', '+r.numero+', '+r.bairro+', '+r.cidade+', '+r.cidade+'-'+r.estado+', '+r.cep+'</p>\
            </div>\
            <div class="d-flex justify-content-end align-items-center col-lg-3">\
                <a href={{ route('editarFuncionario') . '/' }}'+r.id+'><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>\
                <div class="btn botao-excluir btn-info m-1"><i class="fa-solid fa-trash"></i></div>\
            </div>\
        </div>';
        $("#itensLista").append(novoHtml)
        }
        //console.log(response)
        if(response.tipo == 1) {
        window.location.href = "{{ route('editarGerente') }}" + '/' + response.id;
        } else if(response.tipo == 2) {
        window.location.href = "{{ route('editarFuncionario') }}" + '/' + response.id;
        }
        },
        error: function (response) {
        console.log(response)
        }
        });
        // console.log(node)
        // console.log(form)
        // console.log(item)
        // console.log(event)
        //
        // console.log('onSubmit override function triggered');

        }

        }
        });
</script>
@endsection
