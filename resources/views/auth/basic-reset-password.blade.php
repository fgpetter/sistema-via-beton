@extends('layouts.base', ['title' => 'Reset Password'])

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
                    <h4 class="mb-2 text-primary text-xl font-semibold">Forgot Password?</h4>
                    <p class="text-base mb-8 text-default-500">Reset your Tailwick password</p>
                </div>
                <div class="p-3 mb-6 text-sm rounded-md font-normal text-warning bg-warning/15">
                    Provide your email address, and instructions will be sent to you
                </div>
                <form action="{{ route('second', ['dashboards', 'index']) }}">
                    <div class="text-start">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="Email">Email</label>
                        <input class="form-input" id="Email" placeholder="Enter Email" type="text"/>
                    </div>
                    <div class="mt-8">
                        <button class="btn bg-primary text-white w-full" type="submit">Send Reset Link</button>
                    </div>
                    <div class="mt-4 text-center">
                        <p class="text-base text-default-800">
                            Wait, I remember my password... <a class="text-primary underline"
                                                               href="{{ route('second', ['auth', 'basic-login']) }}">
                                Click here </a>
                        </p>
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
