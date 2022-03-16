<!-- Sidebar -->
<div class="sidebar sidebar-style-2 " >
    <div class=" sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-primary">

                {{-- MOSTRA NOME USUARIO LOGADO  --}}

                <li class="nav-item">
                    <hr style="margin-top: 0px; margin-bottom: 0px; margin: 0px">
                    <a style="margin-top: 0px !important;">
                        <i class="fas fa-user"></i>
                        <p>@if (strlen(Auth::user()->name) > 19)
                            {{ substr(Auth::user()->name, 0, 16).'...'}}
                @else
                {{ Auth::user()->name }}
                @endif
                </p>
                </a>
                <hr style="margin-top: 0px; margin-bottom: 5px;">
                </li>

                {{-- Menu --}}
                <li class="nav-item {{ (request()->Is('/')) ? 'active' : '' }}" class="sr-only">
                    <a href="/">
                        <i class="fas fa-home"></i>
                        <p>Home Painel</p>
                    </a>
                </li>
                {{-- Menu 2 - cadastro e consulta--}}
                <li class="nav-item {{ (request()->routeIs('casos.cadastro')) || (request()->routeIs('casos.lista'))
                    || (request()->routeIs('casos.audit')) || (request()->routeIs('casos.menu'))  ? 'active' : '' }}">
                    <a data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne" href="#base">
                        <i class="fas fa-bars"></i>
                        <p>Menu</p>
                        <span class="caret"></span>
                    </a>
                    <div class="expandable collapse {{ (request()->routeIs('casos.cadastro')) || (request()->routeIs('casos.lista'))
                        || (request()->routeIs('casos.audit')) || (request()->routeIs('casos.menu')) ? 'show' : '' }}"
                        aria-controls="collapseOne" id="base">
                        <ul class="nav nav-collapse ">
                            <li class="{{ (request()->routeIs('casos.cadastro')) ? 'active' : '' }}">
                                <a href="{{ route('casos.cadastro') }}">
                                    <span class="sub-item">Cadastro</span>
                                </a>
                            </li>
                            <li class="{{ (request()->routeIs('casos.lista')) ? 'active' : '' }}">
                                <a href="{{ route('casos.lista') }}">
                                    <span class="sub-item">Listagem</span>
                                </a>
                            </li>
                            <li class="{{ (request()->routeIs('casos.audit')) ? 'active' : '' }}">
                                <a href="{{ route('casos.audit') }}">
                                    <span class="sub-item">Auditoria</span>
                                </a>
                            </li>
                            <li class="{{ (request()->routeIs('casos.menu')) ? 'active' : '' }}">
                                <a href="{{ route('casos.menu') }}">
                                    <span class="sub-item">Menu Principal</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{-- cadastro de usuario --}}
                {{-- <li class="nav-item {{ (request()->routeIs('user.register')) ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#sidebarLayouts">
                        <i class="fas fa-users" style="font-size:20px" actived></i>
                        <p>Usuários</p>
                        <span class="caret"></span>
                    </a>
                    <div class="expandable collapse {{ (request()->routeIs('user.register')) ? 'show' : '' }}" id="sidebarLayouts">
                        <ul class="nav nav-collapse">
                            <li class="active'">
                                <a href="{{ route('user.register') }}">
                                    <span class="sub-item">Cadastro de Usuários</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                {{-- Logout --}}
                <li class="nav-item">
                    <a data-toggle="collapse" href="{{ route('logout') }}" onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <p>Sair</p>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>

<!-- End Sidebar -->
