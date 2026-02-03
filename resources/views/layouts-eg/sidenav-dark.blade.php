@extends('layouts.vertical', ['title' => 'Dark Sidenav'])

@section('html_attribute')
data-sidenav-color="dark"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Dark Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
