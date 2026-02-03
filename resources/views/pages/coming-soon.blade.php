@extends('layouts.base', ['title' => 'Coming Soon'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url('/images/auth-bg.jpg')] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-default-100/50 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <div id="countDownText">
                        <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                            <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                            <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                        </a>
                        <div class="mt-8 text-center">
                            <h4 class="mb-2 text-purple-500 text-xl font-semibold">Coming Soon ...</h4>
                            <p class="mb-6 text-base text-default-500">We'll be here in a brief moment.</p>
                        </div>
                        <div>
                            <div class="mt-8">
                                <div class="flex items-center justify-between mt-14">
                                    <div class="p-6 bg-default-150/75 rounded flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-2xl" id="days"></span>
                                            <p>Days</p>
                                        </div>
                                    </div>
                                    <div class="p-6 bg-default-150/75 rounded flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-2xl" id="hours"></span>
                                            <p>Hours</p>
                                        </div>
                                    </div>
                                    <div class="p-6 bg-default-150/75 rounded flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-2xl" id="minutes"></span>
                                            <p>Minutes</p>
                                        </div>
                                    </div>
                                    <div class="p-6 bg-default-150/75 rounded flex items-center justify-center">
                                        <div class="text-center">
                                            <span class="text-2xl" id="seconds"></span>
                                            <p>Seconds</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-10 text-center">
                                <h5 class="text-lg font-semibold text-default-800 mb-2">Be alerted when our launch
                                    happens.</h5>
                                <p class="mb-5 text-base text-default-500">Don't worry, we won't inundate your inbox
                                    😊</p>
                                <form action="#">
                                    <div class="flex w-full relative mb-6 lg:mt-0 mt-4">
                                        <input class="form-input bg-default-50" placeholder="Enter your email"
                                               type="email"/>
                                        <button class="absolute right-0 m-1 top-0 btn bg-primary text-white btn-sm"
                                                type="button">
                                            Send
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')
    @vite(['resources/js/pages/pages-coming-soon.js'])
@endsection
