@extends('layouts.app')

@section('content')
{{--    {{ dd($alugueis)}}--}}
    <div class="container">
        <div class="row py-3">
            <div class="d-flex justify-content-end align-items-center">
                <a href="{{route('editarAluguel')}}"><button class="btn btn-primary">Adicionar Aluguel</button></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">Lista de Aluguéis</div>

                <div class="card-body">
                    <div class="d-flex my-2">
                        <form id="form-search" name="form-search" style="width: 100%;">
                            <div class="typeahead__container">
                                <div class="typeahead__field">
                                    <div class="typeahead__query">
                                        <input class="meuTypeahead" name="alugueis" placeholder="Buscar" autocomplete="off">
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
                        @if(count($alugueis) > 0)
                            @foreach($alugueis as $a)
                                <div class="card d-flex my-2 flex-row justify-content-between pe-1">
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-12">
                                        <div class="d-flex card p-2" style="background: #f2f2f2">
                                            <div class="d-flex flex-row col-lg-12">
                                                <div class="d-flex ps-0 ms-0 p-2 m-2 flex-row col-lg-9">
                                                    <div class="d-flex card m-2 p-2 flex-column col-lg-6" style="background: #f3d3d3">
                                                        <h4 class=" mb-1 mx-2">Aluguel</h4>
                                                        <p class=" mb-1 mx-2">Data do empréstimo: {{date('d/m/Y', strtotime($a->data_emprestimo)) }}</p>
                                                        <p class=" mb-1 mx-2">Prazo máximo: {{date('d/m/Y', strtotime($a->prazo)) }}</p>
                                                        <p class=" mb-1 mx-2">Entregue: {{$a->entregue ? 'Sim' : 'Não' }}</p>
                                                        @if($a->entregue)
                                                            <p class="mb-1 mx-2">Data da Entrega: {{date('d/m/Y', strtotime($a->data_entrega)) }}</p>
                                                        @endif
                                                    </div>
                                                    <div class="d-flex card m-2 p-2 col-lg-6" style="background: #ffffc4">
                                                        <h5 class=" mb-1 mx-2">Balanço</h5>
                                                        <p class="mb-1 mx-2">Dias utilizados: {{ $a->dias_utilizados ? $a->dias_utilizados : round(abs(strtotime('now') - strtotime($a->data_emprestimo))/ (60 * 60 * 24)) }}</p>
                                                        <p class="mb-1 mx-2">Valor da diária: R$ {{ ceil($a->diaria/10) }}</p>
                                                        <p class="mb-1 mx-2">Total: R$ {{ ceil($a->diaria/10) * ($a->dias_utilizados != 0 ? $a->dias_utilizados : '1') }}</p>
                                                    </div>

                                                </div>
                                                <div class="d-flex m-2 p-2 flex-column justify-content-center" style="width: 100%;">
                                                    <h3 class="text-center">Ações</h3>
                                                    <div class="d-flex justify-content-center align-items-center  position-relative">
                                                        <a href={{ route('editarAluguel') . '/' . $a->id }}><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>
                                                        @if(\App\Models\TipoFuncionario::ehGerente())
                                                            <div class="btn btn-outline-danger botao-excluir m-1" usuario="{{$a->id}}" ><i class="fa-solid fa-trash"></i></div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex  flex-row justify-content-between">
                                                <div class="d-flex card p-2 m-2 " style="width: 33%;background: #c7e5ff;">
                                                    <h5 class=" mb-1 mx-2" >Cliente</h5>
                                                    <p class=" mb-1 mx-2">Nome: {{$a->cliente->name }}</p>
                                                    <p class=" mb-1 mx-2">Email: {{$a->cliente->email }}</p>
                                                    <p class=" mb-1 mx-2">Telefone: {{$a->cliente->telefone }}</p>
                                                    <p class="mb-1 mx-2">Endereço: {{ $a->cliente->rua . ", " . $a->cliente->numero . ", " . $a->cliente->bairro  }} <br> {{ $a->cliente->cidade . "-" . $a->cliente->estado . ", " . $a->cliente->cep}}</p>
                                                </div>
                                                <div class="d-flex card p-2 m-2" style="width: 33%; background: #cdffcd;">
                                                    <h5 class=" mb-1 mx-2">Veículo</h5>
                                                    <p class=" mb-1 mx-2">Veículo: {{$a->veiculo->marca->name . ' ' . $a->veiculo->modelo }}</p>
                                                    <p class=" mb-1 mx-2">Placa: {{$a->veiculo->placa }}</p>
                                                    <p class=" mb-1 mx-2">Ano: {{$a->veiculo->ano }}</p>
                                                    <p class=" mb-1 mx-2">Cor: {{$a->veiculo->cor }}</p>
                                                </div>
                                                <div class="d-flex card p-2 my-2" style="width: 33%; background: #c3c9cf;">
                                                    <h5 class=" mb-1 mx-2">Funcionário</h5>
                                                    <p class=" mb-1 mx-2">Nome: {{$a->funcionario->name }}</p>
                                                    <p class=" mb-1 mx-2">Email: {{$a->funcionario->email }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                    </div>
                    @else
                        <div class="card d-flex  my-2">
                            <div class="list-group-item-primary rounded-0  p-2">Não foram encontrados aluguéis cadastrados.</div>
                        </div>
                </div>
                @endif
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        $(".botao-excluir").click(function () {

            let id = this.getAttribute('usuario');
            console.log(id)
            $(".modal-fullscreen").toggleClass('oculto');
            let url = "{{ url('/deletar-aluguel') . '/'  }}";
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
                    @foreach($alugueis as $a)
                        "{!! $a->cliente->name!!}",
                    @endforeach
                ]
            },
            callback: {
                onClick: function (node, a, item) {
                    $.ajax({
                        url: '{{route('buscarAluguel')}}',
                        data: {'name': item.display, _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            console.log(response.tipo)

                            window.location.href = "{{ route('editarAluguel') }}" + '/' + response.id;

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
                        url: '{{route('buscarAluguelLike')}}',
                        data: {'name': $(".meuTypeahead").val(), _token: '{{ csrf_token() }}'},
                        type: 'POST',
                        datatype: 'JSON',
                        success: function (response) {
                            $("#itensLista").html('')
                            for(let r of response){

                                r.entregue = r.entregue ? 'Sim' : 'Não';
                                r.data_entrega = r.data_entrega ? r.data_entrega.split('-').reverse().join('/') : ' ';
                                r.dias_utilizados = r.dias_utilizados ? r.dias_utilizados : '0';
                                let htmlDeletar = '';
                                @if(\App\Models\TipoFuncionario::ehGerente())
                                    htmlDeletar = '<div class="btn btn-outline-danger botao-excluir m-1" usuario="'+r.id+'" ><i class="fa-solid fa-trash"></i></div>';

                                @endif


                                let novoHtml = '<div class="card d-flex my-2 flex-row justify-content-between pe-1">\
                                    <div class="rounded-0  p-2  d-flex justify-content-start flex-column col-lg-12">\
                                    <div class="d-flex card p-2" style="background: #f2f2f2">\
                                    <div class="d-flex flex-row col-lg-12">\
                                    <div class="d-flex ps-0 ms-0 p-2 m-2 flex-row col-lg-9">\
                                    <div class="d-flex card m-2 p-2 flex-column col-lg-6"  style="background: #f3d3d3">\
                                    <h4 class=" mb-1 mx-2">Aluguel</h4>\
                                <p class=" mb-1 mx-2">Data do empréstimo: '+r.data_emprestimo.split('-').reverse().join('/')+'</p>\
                                <p class=" mb-1 mx-2">Prazo máximo: '+r.prazo.split('-').reverse().join('/')+'</p>\
                                <p class=" mb-1 mx-2">Entregue: '+r.entregue +'</p>\
                                <p class="mb-1 mx-2">Data da Entrega: '+r.data_entrega+'</p>\
                            </div>\
                                <div class="d-flex card m-2 p-2 col-lg-6" style="background: #ffffc4">\
                                    <h5 class=" mb-1 mx-2">Balanço</h5>\
                                    <p class="mb-1 mx-2">Dias utilizados: '+r.dias_utilizados+'</p>\
                                    <p class="mb-1 mx-2">Valor da diária: R$ '+Math.ceil(r.diaria/10)+'</p>\
                                    <p class="mb-1 mx-2">Total: R$ '+r.diaria * r.dias_utilizados +' </p>\
                                </div>\
                            </div>\
                                <div class="d-flex m-2 p-2 flex-column justify-content-center" style="width: 100%;">\
                                <h4 style="text-align: center" " >Ações<h4>\
                                    <div class="d-flex justify-content-center align-items-center position-relative">\
                                        <a href="/aluguel/editar/'+ r.id +'"><div class="btn btn-outline-info botao-editar m-1"><i class="fa-solid fa-pen-to-square"></i></div></a>\
                                        +htmlDeletar+\
                                    </div>\
                                </div>\
                            </div>\
                                <div class="d-flex  flex-row justify-content-between">\
                                    <div class="d-flex card p-2 m-2 " style="width: 33%;background: #c7e5ff">\
                                        <h5 class=" mb-1 mx-2">Cliente</h5>\
                                        <p class=" mb-1 mx-2">Nome: '+r.cliente.name+'</p>\
                                        <p class=" mb-1 mx-2">Email: '+ r.cliente.email +'</p>\
                                        <p class=" mb-1 mx-2">Telefone: '+r.cliente.telefone +'</p>\
                                        <p class="mb-1 mx-2">Endereço: '+ r.cliente.rua + ", " + r.cliente.numero +", " + r.cliente.bairro  +' <br> '+ r.cliente.cidade + "-" + r.cliente.estado + ", " + r.cliente.cep +' </p>\
                                    </div>\
                                    <div class="d-flex card p-2 m-2" style="width: 33%; background: #cdffcd">\
                                        <h5 class=" mb-1 mx-2">Veículo</h5>\
                                        <p class=" mb-1 mx-2">Veículo: '+ r.marca_carro + ' ' + r.veiculo.modelo +'</p>\
                                        <p class=" mb-1 mx-2">Placa: '+ r.veiculo.placa +'</p>\
                                        <p class=" mb-1 mx-2">Ano: '+ r.veiculo.ano +'</p>\
                                        <p class=" mb-1 mx-2">Cor: '+ r.veiculo.cor +'</p>\
                                    </div>\
                                    <div class="d-flex card p-2 my-2" style="width: 33%; background: #c3c9cf">\
                                        <h5 class=" mb-1 mx-2">Funcionário</h5>\
                                        <p class=" mb-1 mx-2">Nome: '+ r.funcionario.name +'</p>\
                                        <p class=" mb-1 mx-2">Email: '+ r.funcionario.email +'</p>\
                                    </div>\
                                </div>\
                            </div>\
                            </div>\
                            </div>';
                                console.log(novoHtml)
                                $("#itensLista").append(novoHtml)
                            }
                            //console.log(response)

                            {{--window.location.href = "{{ route('editarAluguel') }}" + '/' + response.id;--}}

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
