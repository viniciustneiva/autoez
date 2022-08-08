<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <!-- Left Side Of Navbar -->
    <ul class="navbar-nav me-auto">
        @if(\App\Models\TipoFuncionario::ehGerente())
            <li class="nav-item dropdown">
                <a id="funcionarioDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Equipe</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="funcionarioDropdown">
                    <a class="dropdown-item" href="{{route('listarFuncionarios')}}">
                        Funcionários
                    </a>
                    <a class="dropdown-item" href="{{route('listarGerentes')}}">
                        Gerentes
                    </a>

                </div>
            </li>

            <li class="nav-item dropdown">
                <a id="frotaDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Frota</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="frotaDropdown">
                    <a class="dropdown-item" href="{{route('listarMarcas')}}">
                        Marcas
                    </a>
                    <a class="dropdown-item" href="{{route('listarVeiculos')}}">
                        Veículos
                    </a>

                </div>
            </li>
            <li class="nav-item dropdown">
                <a id="relatoriosDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Relatórios</a>
                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="relatoriosDropdown">
                    <a class="dropdown-item" href="{{route('gerarRelatorioAluguel')}}">
                        Aluguel
                    </a>
                    <a class="dropdown-item" href="{{route('gerarRelatorioCliente')}}">
                        Clientes
                    </a>
                    <a class="dropdown-item" href="{{route('gerarRelatorioVeiculo')}}">
                        Veículos
                    </a>
                </div>
            </li>

{{--            <li class="nav-item">--}}
{{--                <a class="nav-link" href="{{route('listarVeiculos')}}">Veículos</a>--}}
{{--            </li>--}}
        @endif

        @if(Auth::check() && Auth::user())
            <li class="nav-item">
                <a class="nav-link" href="{{route('listarClientes')}}">Clientes</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('listarAlugueis')}}">Aluguéis</a>
            </li>
        @endif
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ms-auto">
        <!-- Authentication Links -->
        @guest
            @if (Route::has('login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Entrar</a>
                </li>
            @endif

        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}
                </a>

                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
    </ul>
</div>
</div>
</nav>
