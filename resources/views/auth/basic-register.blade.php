@extends('layouts.base', ['title' => 'Sign In'])

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
                    <h4 class="mb-2.5 text-xl font-semibold text-primary">Create your free account</h4>
                    <p class="text-base text-default-500">Get your free Tailwick account now</p>
                </div>
                <!-- form -->
                <form action="{{ route('second', ['dashboards', 'index']) }}" class="text-left w-full mt-10">
                    <div class="mb-4">
                        <label class="block font-medium text-default-900 text-sm mb-2" for="email">Enter email</label>
                        <input class="form-input" id="email" placeholder="Enter Username or email" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-default-900 text-sm mb-2" for="Username">Username</label>
                        <input class="form-input" id="Username" placeholder="Enter Username" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block font-medium text-default-900 text-sm mb-2" for="Password">Password</label>
                        <input class="form-input" id="Password" placeholder="Enter Password" type="text"/>
                    </div>
                    <p class="italic text-sm font-medium text-default-500">By registering you agree to the Tailwick <a
                            class="underline" href="#">Terms of Use</a></p>
                    <div class="mt-10 text-center">
                        <button class="btn bg-primary text-white w-full" type="submit">Sign Up</button>
                    </div>
                    <div
                        class="my-9 relative text-center before:absolute before:top-2.5 before:left-0 before:border-t before:border-t-default-200 before:w-full before:h-0.5 before:right-0 before:-z-0">
                        <h4 class="relative z-1 py-0.5 px-2 inline-block font-medium bg-card text-default-600">Create
                            Account with</h4>
                    </div>
                    <div class="flex w-full justify-center items-center gap-2">
                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                           href="#">
                            <i class="iconify-color logos--google-icon"></i>
                            Use Google
                        </a>
                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                           href="#">
                            <i class="iconify logos--apple text-mono"></i>
                            Use Apple
                        </a>
                    </div>
                    <div class="mt-10 text-center">
                        <p class="text-base text-default-500">Already have an account ?
                            <a class="font-semibold underline hover:text-primary transition duration-200"
                               href="{{ route('second', ['auth', 'basic-login']) }}">Login</a>
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
