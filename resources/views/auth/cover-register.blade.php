@extends('layouts.base', ['title' => 'Register'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url('/images/auth-bg.jpg')] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-card/70 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                        <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                        <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                    </a>
                    <div class="mt-8 text-center">
                        <h4 class="mb-2.5 text-xl font-semibold text-purple-500">Welcome Back !</h4>
                        <p class="text-base text-default-500">Sign in to continue to Tailwick.</p>
                    </div>
                    <!-- form -->
                    <form action="{{ route('second', ['dashboards', 'index']) }}" class="text-left w-full mt-10">
                        <div class="mb-4">
                            <label class="block font-medium text-default-900 text-sm mb-2" for="email">Enter
                                email</label>
                            <input class="form-input" id="email" placeholder="Enter Username or email" type="text"/>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-default-900 text-sm mb-2"
                                   for="Username">Username</label>
                            <input class="form-input" id="Username" placeholder="Enter Username" type="text"/>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-default-900 text-sm mb-2"
                                   for="Password">Password</label>
                            <input class="form-input" id="Password" placeholder="Enter Password" type="text"/>
                        </div>
                        <p class="italic text-sm font-medium text-default-500">By registering you agree to the Tailwick
                            <a class="underline" href="#">Terms of Use</a></p>
                        <div class="mt-10 text-center">
                            <button class="btn bg-primary text-white w-full" type="button">Sign
                                In
                            </button>
                        </div>
                        <div
                            class="my-9 relative text-center before:absolute before:top-2.5 before:left-0 before:border-t before:border-t-default-200 before:w-full before:h-0.5 before:right-0 before:-z-0">
                            <h4 class="relative z-1 py-0.5 px-2 inline-block font-medium bg-card rounded-md">Create
                                Account with</h4>
                        </div>
                        <div class="flex w-full justify-center items-center gap-2">
                            <a class="bg-card btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                               href="#">
                                <i class="iconify-color logos--google-icon"></i>
                                Use Google
                            </a>
                            <a class="bg-card btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                               href="#">
                                <i class="iconify logos--apple"></i>
                                Use Apple
                            </a>
                        </div>
                        <div class="mt-10 text-center">
                            <p class="text-base text-default-500">Already have an account ?
                                <a class="font-semibold underline hover:text-primary transition duration-200"
                                   href="{{ route('second', ['auth', 'cover-login']) }}"> Login</a>
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
