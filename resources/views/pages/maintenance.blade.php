@extends('layouts.base', ['title' => 'Maintenance'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url('/images/auth-bg.jpg')] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-default-100 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                        <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                        <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                    </a>
                    <div class="mt-10">
                        <img alt="" class="h-72 mx-auto" src="/images/maintenance.png"/>
                    </div>
                    <div class="mt-8 text-center">
                        <h4 class="mb-2 text-purple-500 text-xl font-semibold dark:text-white">Currently in Maintenance
                            Mode !!!</h4>
                        <p class="mb-6 text-base text-default-500">Website is Under Construction. Please check back
                            later!</p>
                        <a href="{{ route('second', ['dashboards', 'index']) }}">
                            <button class="btn bg-primary text-white" type="button">
                                <i class="size-3.5" data-lucide="home"></i>
                                Back to Home
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
