@extends('layouts.base', ['title' => 'Two Steps'])

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
                        <h4 class="mb-2 text-primary text-xl font-semibold">Verify Email</h4>
                        <p class="text-base mb-8 text-default-500">Please enter the 4 digit code sent to
                            tailwick@themesdesign.in</p>
                    </div>
                    <form action="{{ route('second', ['dashboards', 'index']) }}">
                        <div class="grid grid-cols-4 gap-2">
                            <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                            <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                            <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                            <input class="form-input text-center" maxlength="1" placeholder="•" type="text"/>
                        </div>
                        <div class="mt-10">
                            <button class="btn bg-primary text-white w-full" type="button">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
