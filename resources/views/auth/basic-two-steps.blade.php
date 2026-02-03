@extends('layouts.base', ['title' => 'Two Steps'])

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
                <div class="mt-8">
                    <h4 class="mb-4 text-primary text-xl font-semibold">Verify Email</h4>
                    <p class="text-base/normal mb-8 text-default-500">Please enter the 4 digit code sent to
                        tailwick@themesdesign.in</p>
                </div>
                <form action="{{ route('second', ['dashboards', 'index']) }}" class="mt-">
                    <div class="grid grid-cols-4 gap-2">
                        <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                        <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                        <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                        <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                    </div>
                    <div class="mt-6">
                        <button class="btn text-white bg-primary w-full" type="submit">Confirm</button>
                    </div>
                </form>
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
