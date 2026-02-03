<!DOCTYPE html>
<html lang="pt_br" @yield('html_attribute')>

<head>
    @include('layouts.partials/title-meta')

    @include('layouts.partials/head-css')
    @livewireStyles
</head>

<body>
    <div div class="wrapper">

        @include('layouts.partials/sidenav')

        <div class="page-content">

            @include('layouts.partials/topbar')

            <main>

                @yield('content')

            </main>

            @include('layouts.partials/footer')
            
        </div>

    </div>

    @include('layouts.partials/customizer')
    @livewireScripts
    @include('sweetalert2::index')

</body>

</html>
