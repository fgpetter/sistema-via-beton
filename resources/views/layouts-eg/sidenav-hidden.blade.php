@extends('layouts.vertical', ['title' => 'Hidden Sidenav'])

@section('html_attribute')
data-sidenav-size="hidden"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Hidden Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
