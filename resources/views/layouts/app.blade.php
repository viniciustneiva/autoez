<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body>
@include('layouts.baseCSS')
    <div id="app">
        @include('messages.flash-message')
        @if(\App\Models\TipoFuncionario::ehGerente())
            <style>
                .oculto {
                    display: none;
                }
            </style>
            <div class="modal-fullscreen oculto">
                <div class="modal-wrapper">
                    <div class="modal-header justify-content-center mt-3"><h3>Apagar item</h3></div>
                    <div class="modal-body text-center mt-3">Deseja mesmo apagar este item?</div>
                    <div class="modal-footer mt-3 justify-content-evenly">
                        <div class="btn btn-dark" id="close-modal">Não</div>
                        <a id="modalId" href="#"><div class="btn btn-danger">Sim</div></a>
                    </div>
                </div>
            </div>
        @endif
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'AutoEz') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                @include('layouts.sidebar')

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    @include('layouts.baseScripts')
    @yield('scripts')

</body>
</html>
