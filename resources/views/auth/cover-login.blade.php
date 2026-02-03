@extends('layouts.base', ['title' => 'Login'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url('/images/auth-bg.jpg')] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-card/70 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <!-- Logo -->
                    <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                        <img alt="logo dark" class="h-6 flex dark:hidden" src="/images/logo-dark.png"/>
                        <img alt="" class="h-6 hidden dark:flex" src="/images/logo-light.png"/>
                    </a>
                    <div class="mt-8 text-center">
                        <h4 class="mb-2.5 text-xl font-semibold text-primary">Welcome Back !</h4>
                        <p class="text-base text-default-500">Sign in to continue to Tailwick.</p>
                    </div>
                    <form action="{{ route('second', ['dashboards', 'index']) }}" class="text-left w-full mt-10">
                        <div class="mb-4">
                            <label class="block font-medium text-default-900 text-sm mb-2" for="email">Username/ Email
                                ID</label>
                            <input class="form-input" id="email" placeholder="Enter Username or email" type="text"/>
                        </div>
                        <div class="mb-4">
                            <a class="text-primary font-medium text-sm mb-2 float-end"
                               href="{{ route('second', ['auth', 'cover-reset-password']) }}">Forgot Password ?</a>
                            <label class="block font-medium text-default-900 text-sm mb-2"
                                   for="Password">Password</label>
                            <input class="form-input" id="Password" placeholder="Enter Password" type="text"/>
                        </div>
                        <div class="flex items-center gap-2 mb-4">
                            <input class="form-checkbox" id="checkbox-1" type="checkbox"/>
                            <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember Me</label>
                        </div>
                        <div class="mt-10 text-center">
                            <button class="btn bg-primary text-white w-full" type="submit">Sign In
                                <button>
                                </button>
                            </button>
                        </div>
                        <div
                            class="my-9 relative text-center before:absolute before:top-2.5 before:left-0 before:border-t before:border-t-default-200 before:w-full before:h-0.5 before:right-0 before:-z-0">
                            <h4 class="relative z-1 py-0.5 px-2 inline-block font-medium text-default-600 bg-card">Sign
                                In With</h4>
                        </div>
                        <div class="flex w-full justify-center items-center gap-2">
                            <a class="btn bg-card border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                               href="#">
                                <i class="iconify-color logos--google-icon"></i>
                                Use Google
                            </a>
                            <a class="btn bg-card border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                               href="#">
                                <i class="iconify logos--apple text-mono"></i>
                                Use Apple
                            </a>
                        </div>
                        <div class="mt-10 text-center">
                            <p class="text-base text-default-500">Don't have an Account ?
                                <a class="font-semibold underline hover:text-primary transition duration-200"
                                   href="{{ route('second', ['auth', 'cover-register']) }}">SignUp</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
