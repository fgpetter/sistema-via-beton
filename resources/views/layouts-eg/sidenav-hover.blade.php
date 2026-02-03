@extends('layouts.vertical', ['title' => 'Hover View Sidenav'])

@section('html_attribute')
data-sidenav-size="hover"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Hover View Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
