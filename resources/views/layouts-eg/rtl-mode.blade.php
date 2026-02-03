@extends('layouts.vertical', ['title' => 'RTL Mode'])

@section('html_attribute')
dir="rtl"
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Layouts', 'title' => 'RTL Mode'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
