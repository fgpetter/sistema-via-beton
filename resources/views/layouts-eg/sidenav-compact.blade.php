@extends('layouts.vertical', ['title' => 'Compact Sidenav'])

@section('html_attribute')
data-sidenav-size="md"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Compact Sidenav'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
