
@extends('layouts.app')



@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarMarca')}}"><button class="btn btn-primary">Adicionar Marca</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Marcas</div>

                <div class="card-body">
                    <div class="d-flex my-2">
                        <form id="form-search" name="form-search" style="width: 100%;">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="meuTypeahead" name="marcas" placeholder="Buscar" autocomplete="off">
                                    </div>
                                    <div class="typeahead__button">
                                        <button type="submit">
                                            <i class="typeahead__search-icon"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div id="itensLista">
                        @if(count($marcas) > 0)
                            @foreach($marcas as $m)
                                <div class="card d-flex my-2 flex-row justify-content-between pe-1">
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-9">
                                        <div class="d-flex">
                                            <p class=" mb-1 mx-2">Marca: {{$m->name }}</p>

                                        </div>
                                        @if(\App\Models\TipoFuncionario::ehGerente())
                                            <p class=" mb-1 mx-2">Taxa: {{$m->taxa*100 . '%' }}</p>
                                        @endif
                                    </div>

                                    <div class="d-flex flex-column justify-content-center align-items-center position-relative" style="width: 100%;">
                                        <h4 class="text-center">Ações</h4>
                                        <div class="d-flex flex-row justify-content-center align-items-center" style="width: 100%;">
                                            <a href={{ route('editarMarca') . '/' . $m->id }}><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>
                                            @if(\App\Models\TipoFuncionario::ehGerente())
                                                <div class="btn btn-outline-danger botao-excluir m-1" usuario="{{$m->id}}" ><i class="fa-solid fa-trash"></i></div>
                                            @endif
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @else
                        <div class="card d-flex  my-2">
                            <div class="list-group-item-primary rounded-0  p-2">Não foram encontrados marcas cadastradas.</div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    @if(\App\Models\TipoFuncionario::ehGerente())
        <script>
            $(".botao-excluir").click(function (e) {

                let id = this.getAttribute('usuario');
                console.log(id)
                $(".modal-fullscreen").toggleClass('oculto');
                let url = "{{ url('/deletar-marca') . '/'  }}";
                document.getElementById('modalId').setAttribute('href', url + id);
                //$("#modalId").attr('href').val();
            });
        </script>
    @endif
    <script>
        $.typeahead({
            input: '.meuTypeahead',
            order: "asc",
            minLength: 2,
            offset: true,
            source: {
                data: [
                    @foreach($marcas as $m)
                        "{!! $m->name!!}",
                    @endforeach
                ]
            },
            callback: {
                onClick: function (node, a, item, event) {
                    $.ajax({
                        url: '{{route('buscarMarca')}}',
                        data: {'name': item.display, _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            console.log(response.tipo)

                            window.location.href = "{{ route('editarMarca') }}" + '/' + response.id;

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
                        url: '{{route('buscarMarcaLike')}}',
                        data: {'name': $(".meuTypeahead").val(), _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            $("#itensLista").html('')
                            for(let r of response){

                                @if(\App\Models\TipoFuncionario::ehGerente())
                                    r.taxa = '<p class=" mb-1 mx-2">Taxa:'+Math.ceil(r.taxa*100)+'%</p>';
                                    r.botao = '<div class="btn btn-outline-danger botao-excluir m-1" usuario="'+r.id+'" ><i class="fa-solid fa-trash"></i></div>';
                                @else
                                    r.botao = '';
                                @endif

                                let novoHtml = '<div class="card d-flex my-2 flex-row justify-content-between pe-1">\
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-9">\
                                    <p class=" mb-1 mx-2">Marca: ' +r.name+' </p>\
                                    <div class="d-flex">\
                                    '+r.taxa+'\
                                    </div>\
                                    </div>\
                                <div class="d-flex flex-column justify-content-center align-items-center position-relative" style="width: 100%;">\
                                    <h4 class="text-center">Ações</h4>\
                                    <div class="d-flex flex-row justify-content-center align-items-center" style="width: 100%;">\
                                        <a href="/marcas/editar/'+r.id+'"><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>'+r.botao+'\
                                    </div>\
                                </div>\
                            </div>';
                                $("#itensLista").append(novoHtml)
                            }
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
