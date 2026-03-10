@extends('layouts.vertical', ['title' => 'Endereços'])

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Endereços'])

    <livewire:admin.enderecos-crud />
@endsection
