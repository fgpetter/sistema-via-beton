@extends('layouts.vertical', ['title' => 'Dark Mode'])

@section('html_attribute')
data-theme="dark"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'Dark Mode'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
