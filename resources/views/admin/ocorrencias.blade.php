@extends('layouts.vertical', ['title' => 'Gestão de Ocorrências'])

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Gestão de Ocorrências'])

    <livewire:admin.ocorrencias-list />
@endsection
