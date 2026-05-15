<!-- Start Sidebar -->
<aside class="app-menu" id="app-menu">
    <!-- Sidenav Menu Brand Logo -->
    <a class="logo-box sticky top-0 flex min-h-topbar-height items-center justify-start px-6 backdrop-blur-xs"
        href="{{ auth()->user()->isPrestador() ? route('prestador.atendimentos') : route('painel.dashboard') }}">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img alt="Via Beton" class="logo-lg p-4" src="{{ asset('images/viabeton_logo.png') }}" />
            <img alt="Via Beton" class="logo-sm" src="{{ asset('images/viabeton_logo.png') }}" />
        </div>
        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img alt="Via Beton" class="logo-lg p-4" src="{{ asset('images/viabeton_logo.png') }}" />
            <img alt="Via Beton" class="logo-sm" src="{{ asset('images/viabeton_logo.png') }}" />
        </div>
    </a>
    <!-- Sidenav Menu Toggle Button -->
    <div class="absolute top-0 end-5 flex h-topbar items-center justify">
        <button class="" id="button-hover-toggle">
            <i class="iconify tabler--circle size-5"></i>
        </button>
    </div>
    <!-- Sidenav Menu Item Link -->
    <div class="relative min-h-0 flex-grow">
        <div class="size-full" data-simplebar="">
            <ul class="side-nav p-3 hs-accordion-group">
                @canany(['admin', 'coordenador'])
                    <li class="menu-item">
                        <a class="menu-link {{ request()->routeIs('painel.dashboard') ? 'active' : '' }}" href="{{ route('painel.dashboard') }}">
                            <span class="menu-icon"><i data-lucide="home"></i></span>
                            <div class="menu-text">Dashboard</div>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'coordenador'])
                    <li class="menu-title">
                        <span>Administração</span>
                    </li>
                    @can('admin')
                        <li class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.usuarios') ? 'active' : '' }}" href="{{ route('admin.usuarios') }}">
                                <span class="menu-icon"><i data-lucide="users"></i></span>
                                <div class="menu-text">Usuários</div>
                            </a>
                        </li>
                    @endcan
                    <li class="menu-item">
                        <a class="menu-link {{ request()->routeIs('admin.colaboradores') ? 'active' : '' }}" href="{{ route('admin.colaboradores') }}">
                            <span class="menu-icon"><i data-lucide="user-check"></i></span>
                            <div class="menu-text">Colaboradores</div>
                        </a>
                    </li>
                    @can('admin')
                        <li class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.ocorrencias') ? 'active' : '' }}" href="{{ route('admin.ocorrencias') }}">
                                <span class="menu-icon"><i data-lucide="file-warning"></i></span>
                                <div class="menu-text">Ocorrências</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.preventivas') ? 'active' : '' }}" href="{{ route('admin.preventivas') }}">
                                <span class="menu-icon"><i data-lucide="shield-check"></i></span>
                                <div class="menu-text">Preventivas</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.enderecos') ? 'active' : '' }}" href="{{ route('admin.enderecos') }}">
                                <span class="menu-icon"><i data-lucide="map-pin"></i></span>
                                <div class="menu-text">Endereços</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link {{ request()->routeIs('admin.configuracoes-sistema') ? 'active' : '' }}" href="{{ route('admin.configuracoes-sistema') }}">
                                <span class="menu-icon"><i data-lucide="settings"></i></span>
                                <div class="menu-text">Configurações do sistema</div>
                            </a>
                        </li>
                    @endcan
                @endcanany

                @can('prestador')
                    <li class="menu-title">
                        <span>Atendimentos</span>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link {{ request()->routeIs('prestador.atendimentos') || request()->routeIs('prestador.atendimento') ? 'active' : '' }}" href="{{ route('prestador.atendimentos') }}">
                            <span class="menu-icon"><i data-lucide="clipboard-list"></i></span>
                            <div class="menu-text">Meus Atendimentos</div>
                        </a>
                    </li>
                @endcan
            </ul>
        </div>
    </div>
</aside>
<!-- End Sidebar -->
