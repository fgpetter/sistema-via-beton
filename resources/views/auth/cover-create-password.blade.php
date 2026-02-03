@extends('layouts.base', ['title' => 'Create Password'])

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
                        <h4 class="mb-2 text-primary text-xl font-semibold">Set a New Password</h4>
                        <p class="text-base mb-8 text-default-500">Your new password should be distinct from
                            any of your prior passwords
                        </p>
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
