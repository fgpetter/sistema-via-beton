@extends('layouts.vertical', ['title' => 'Gestão de Usuários'])

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Gestão de Usuários'])

    <livewire:admin.users-list />
@endsection
