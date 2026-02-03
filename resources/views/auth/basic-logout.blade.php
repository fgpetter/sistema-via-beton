@extends('layouts.base', ['title' => 'Logout'])

@section('css')

@endsection

@section('content')
    <div class="relative min-h-screen w-full flex justify-center items-center py-16 md:py-10">
        <div class="card md:w-lg w-screen z-10">
            <div class="text-center px-10 py-12">
                <!-- Logo -->
                <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                    <img alt="logo dark" class="h-6 flex dark:hidden" src="/images/logo-dark.png"/>
                    <img alt="" class="h-6 hidden dark:flex" src="/images/logo-light.png"/>
                </a>
                <div class="mt-8 text-center">
                    <div class="mb-4">
                        <i class="size-6 text-purple-500 fill-purple-100 mx-auto" data-lucide="log-out"></i>
                    </div>
                    <h4 class="mb-2 text-primary text-xl font-semibold">You are Logged Out</h4>
                    <p class="mb-8 text-base text-default-500">Thank you for using tailwick admin template
                    </p>
                </div>
                <a href="{{ route('second', ['dashboards', 'index']) }}">
                    <button class="btn bg-primary text-white w-full">Sign In</button>
                </a>
            </div>
        </div>
        <div class="absolute inset-0 overflow-hidden">
            <svg aria-hidden="true"
                 class="absolute inset-0 size-full fill-black/2 stroke-black/5 dark:fill-white/2.5 dark:stroke-white/2.5">
                <defs>
                    <pattern height="56" id="authPattern" patternunits="userSpaceOnUse" width="56" x="50%" y="16">
                        <path d="M.5 56V.5H72" fill="none"></path>
                    </pattern>
                </defs>
                <rect fill="url(#authPattern)" height="100%" stroke-width="0" width="100%"></rect>
            </svg>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
