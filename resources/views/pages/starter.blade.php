@extends('layouts.vertical', ['title' => 'Starter Page'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Starter Page'] )

    <div class="card h-40">
    </div>
@endsection

@section('scripts')

@endsection
