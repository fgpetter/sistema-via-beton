@extends('layouts.vertical', ['title' => 'Dashboard'])
@section('html_attribute')
data-sidenav-color="dark"
@endsection
@section('css')

@endsection

@section('content')
    {{-- @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Dashboard'] ) --}}
    @include('layouts.partials/page-title', ['title' => 'Dashboard'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection