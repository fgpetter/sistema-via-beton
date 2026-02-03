@extends('layouts.base', ['title' => 'Create Password'])

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
                    <h4 class="mb-2 text-primary text-xl font-semibold">Set a New Password</h4>
                    <p class="text-base/normal mb-8 text-default-500">Your new password should be distinct from any of
                        your prior passwords</p>
                </div>
                <form action="{{ route('second', ['dashboards', 'index']) }}">
                    <div class="text-start">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                               for="Email">Password</label>
                        <input class="form-input" id="Email" placeholder="Password" type="text"/>
                    </div>
                    <div class="text-start mt-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="Email">Confirm
                            Password</label>
                        <input class="form-input" id="Email" placeholder="Confirm Password" type="text"/>
                    </div>
                    <div class="flex items-center gap-2 mt-4">
                        <input class="form-checkbox" id="checkbox-1" type="checkbox"/>
                        <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember Me</label>
                    </div>
                    <div class="mt-8">
                        <button class="btn bg-primary text-white w-full" type="button">Reset Password</button>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-base text-default-800">Hold on, I've got my password... <a
                                class="text-primary underline" href="{{ route('second', ['auth', 'basic-login']) }}">
                                Click here </a></p>
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
