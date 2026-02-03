@extends('layouts.base', ['title' => 'Reset Password'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url(/images/auth-bg.jpg)] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-default-50 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                        <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                        <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                    </a>
                    <div class="mt-8">
                        <h4 class="mb-2 text-primary text-xl font-semibold">Forgot Password?</h4>
                        <p class="text-base mb-8 text-default-500">Reset your Tailwick password</p>
                    </div>
                    <div class="p-3 mb-6 text-warning rounded-md bg-warning/15">
                        Provide your email address, and instructions will be sent to you
                    </div>
                    <form action="{{ route('second', ['dashboards', 'index']) }}">
                        <div class="text-start">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="Email">Email</label>
                            <input class="form-input" id="Email" placeholder="Enter Email" type="text"/>
                        </div>
                        <div class="mt-8">
                            <button class="btn bg-primary text-white w-full" type="button">Send Reset Link</button>
                        </div>
                        <div class="mt-4 text-center">
                            <p class="text-base text-default-800">Wait, I remember my password... <a
                                    class="text-primary underline"
                                    href="{{ route('second', ['auth', 'cover-login']) }}"> Click here </a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
