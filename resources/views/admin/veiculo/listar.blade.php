@extends('layouts.app')
@if(\App\Models\TipoFuncionario::ehGerente())
    <div class="modal-fullscreen d-none">
        <div class="modal-wrapper">
            <div class="modal-header justify-content-center mt-3"><h3>Apagar Veículo</h3></div>
            <div class="modal-body text-center mt-3">Deseja mesmo apagar este veículo?</div>
            <div class="modal-footer mt-3 justify-content-evenly">
                <div class="btn btn-dark" id="close-modal">Não</div>
                <a id="modalId" href="#"><div class="btn btn-danger">Sim</div></a>
            </div>
        </div>
    </div>
@endif
@section('content')
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarVeiculo')}}"><button class="btn btn-primary">Adicionar Veículo</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Veículos</div>

                <div class="card-body">
                    <div class="d-flex my-2">
                        <form id="form-search" name="form-search" style="width: 100%;">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="meuTypeahead" name="placa" placeholder="Buscar" autocomplete="off">
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
                        @if(count($veiculos) > 0)
                            @foreach($veiculos as $v)
                                <div class="card d-flex my-2 flex-row justify-content-between pe-1">
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-9">
                                        <div class="d-flex">
                                            <p class=" mb-1 mx-2">Placa: {{$v->placa }}</p>
                                            <p class=" mb-1 mx-2">Marca: {{$v->marca->name }}</p>
                                            <p class=" mb-1 mx-2">Modelo: {{$v->modelo }}</p>

                                        </div>
                                        <p class=" mb-1 mx-2">Cor: {{$v->cor }}</p>
                                        <p class=" mb-1 mx-2">Ano: {{$v->ano }}</p>
                                        <p class=" mb-1 mx-2">Valor: {{$v->valor }}</p>
                                        <p class=" mb-1 mx-2">Disponível: {{ $v->disponivel ? 'Sim' : 'Não' }}</p>
                                    </div>

                                    <div class="d-flex justify-content-end align-items-center col-lg-3 position-relative">
                                        @if(\App\Models\TipoFuncionario::ehGerente())
                                            <a href={{ route('editarVeiculo') . '/' . $v->id }}><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>
                                            <div class="btn btn-outline-danger botao-excluir m-1" usuario="{{$v->id}}" ><i class="fa-solid fa-trash"></i></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @else
                        <div class="card d-flex  my-2">
                            <div class="list-group-item-primary rounded-0  p-2">Não foram encontrados veículos cadastrados.</div>
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
            $(".modal-fullscreen").toggleClass('d-none');
            let url = "{{ url('/deletar-veiculo') . '/'  }}";
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
                    @foreach($veiculos as $v)
                        "{!! $v->placa!!}",
                    @endforeach
                ]
            },
            callback: {
                onClick: function (node, a, item, event) {
                    $.ajax({
                        url: '{{route('buscarVeiculo')}}',
                        data: {'placa': item.display, _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            console.log(response.placa)

                            window.location.href = "{{ route('editarVeiculo') }}" + '/' + response.id;

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
                        url: '{{route('buscarVeiculoLike')}}',
                        data: {'placa': $(".meuTypeahead").val(), _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            $("#itensLista").html('')
                            for(let r of response){
                                let novoHtml = '<div class="card d-flex my-2 flex-row justify-content-between pe-1">\
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-9">\
                                    <div class="d-flex">\
                                    <p class=" mb-1 mx-2">Marca: '+r.marca.name+' </p>\
                                <p class=" mb-1 mx-2">Modelo: '+r.modelo+' </p>\
                                <p class=" mb-1 mx-2">Cor: '+r.cor+'</p>\
                            </div>\
                                <p class=" mb-1 mx-2">Ano: '+r.ano+'</p>\
                                <p class=" mb-1 mx-2">Valor: '+r.valor+'</p>\
                                <p class=" mb-1 mx-2">Disponível ? '+r.disponivel+'</p>\
                            </div>\
                            <div class="d-flex justify-content-end align-items-center col-lg-3 position-relative">\
                                    @if(\App\Models\TipoFuncionario::ehGerente())
                                    <a href={{ route('editarVeiculo') . '/' }}'+r.id+'><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>\
                                <div class="btn btn-outline-danger botao-excluir m-1" usuario="'+r.id+'" ><i class="fa-solid fa-trash"></i></div>\
                                @endif
                            </div>\
                            </div>';
                                $("#itensLista").append(novoHtml)
                            }
                            //console.log(response)



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
