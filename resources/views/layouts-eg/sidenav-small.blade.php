@extends('layouts.vertical', ['title' => 'Small Sidenav'])

@section('html_attribute')
data-sidenav-size="sm"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Small Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
