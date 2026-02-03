@extends('layouts.base', ['title' => 'Logout'])

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
                    <div class="mt-8 text-center">
                        <div class="mb-4">
                            <i class="size-6 text-purple-500 mx-auto fill-purple-100" data-lucide="log-out"></i>
                        </div>
                        <h4 class="mb-2 text-primary text-xl font-semibold">You are Logged Out</h4>
                        <p class="mb-8 text-base text-default-500">Thank you for using tailwick admin template </p>
                    </div>
                    <a href="{{ route('second', ['dashboards', 'index']) }}">
                        <button class="btn bg-primary text-white w-full">Sign In</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
