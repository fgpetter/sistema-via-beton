@extends('layouts.vertical', ['title' => 'Offcavas Sidenav'])

@section('html_attribute')
data-sidenav-size="offcanvas"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Offcavas Sidenav (Mobile View)'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
