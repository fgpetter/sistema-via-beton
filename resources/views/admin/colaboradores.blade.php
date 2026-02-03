@extends('layouts.vertical', ['title' => 'Gestão de Colaboradores'])

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Gestão de Colaboradores'])

    <livewire:admin.colaboradores-list />
@endsection
