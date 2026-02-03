@extends('layouts.base', ['title' => 'Verify Email'])

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
                        <h4 class="mb-3 text-xl font-semibold text-primary">Verify Email</h4>
                        <p class="text-base text-default-500 mb-4">Did you not receive an email? Please <a
                                class="text-primary" href="#"> try again</a></p>
                        <button class="btn btn-sm bg-primary text-white" type="button">
                            Skip Now
                        </button>
                        <div class="pt-10 text-center">
                            <img alt="" class="block w-2/3 mx-auto" src="/images/auth-email.png"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
