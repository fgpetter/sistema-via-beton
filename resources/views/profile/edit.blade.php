@extends('layouts.vertical', ['title' => 'Editar Perfil'])
@section('html_attribute')
data-sidenav-color="dark"
@endsection
@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['title' => 'Editar Perfil'])

    <div class="card w-1/2">
        <div class="card-body">
            <livewire:profile.edit-profile />
        </div>
    </div>
@endsection

@section('scripts')

@endsection
