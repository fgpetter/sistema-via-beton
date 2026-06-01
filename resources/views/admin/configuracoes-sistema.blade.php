@extends('layouts.vertical', ['title' => 'Configurações do sistema'])

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Configurações do sistema'])

    <livewire:admin.prazos-crud />

    <livewire:admin.disciplinas-crud />
@endsection
