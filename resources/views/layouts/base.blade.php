<!DOCTYPE html>
<html lang="pt_br" @yield('html_attribute')>
<head>
    @include('layouts.partials/title-meta')

    @include('layouts.partials/head-css')
    @livewireStyles
</head>
<body>
    @yield('content')

    @include('layouts.partials/customizer')
    @livewireScripts
    @include('sweetalert2::index')
</body>
</html>