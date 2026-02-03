@extends('layouts.base', ['title' => 'Verify Email'])

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
                    <h4 class="mb-3 text-xl font-semibold text-primary">Verify Email</h4>
                    <p class="text-base text-default-500 mb-4">Did you not receive an email? Please <a
                            class="text-primary" href="#"> try again</a></p>
                    <button class="btn btn-sm bg-primary text-white" type="button">Skip Now</button>
                    <div class="mt-10 text-center">
                        <img alt="" class="block w-1/2 mx-auto" src="/images/auth-email.png"/>
                    </div>
                </div>
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
