@extends('layouts.vertical', ['title' => 'Hover Active Sidenav'])

@section('html_attribute')
data-sidenav-size="hover-active"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Hover Active Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
