@extends('layouts.base', ['title' => 'Logout'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url(/images/auth-bg.jpg)] dark:bg-[url('/images/auth-bg-dark.jpg')] min-h-screen flex justify-center items-center">
        <div class="relative">
            <div class="bg-card/70 rounded-lg w-2/3 mx-auto">
                <div class="grid lg:grid-cols-12 grid-cols-1 items-center gap-0">
                    <div class="lg:col-span-5">
                        <div class="text-center px-10 py-12">
                            <div class="mt-8 text-center">
                                <div class="mb-4">
                                    <i class="size-6 text-purple-500 fill-purple-100 mx-auto" data-lucide="log-out"></i>
                                </div>
                                <h4 class="mb-2 text-primary text-xl font-semibold">You are Logged Out</h4>
                                <p class="mb-8 text-base text-default-500">Thank you for using tailwick admin
                                    template
                                </p>
                            </div>
                            <a href="{{ route('second', ['auth', 'boxed-login']) }}">
                                <button class="btn bg-primary text-white w-full">Sign In</button>
                            </a>
                        </div>
                    </div>
                    <div
                        class="lg:col-span-7 bg-card/60 mx-2 my-2 shadow-[0_14px_15px_-3px_#f1f5f9,0_4px_6px_-4px_#f1f5f9] dark:shadow-none rounded-lg">
                        <div class="pt-10 px-10 h-full">
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <a href="{{ route('second', ['dashboards', 'index']) }}">
                                        <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                                        <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                                    </a>
                                </div>
                                <div>
                                    <!-- Language Dropdown Button -->
                                    <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle py-2 px-4 bg-transparent border border-default-200 text-default-600 hover:border-primary rounded-md hover:text-primary font-medium text-sm gap-2 flex items-center"
                                                type="button">
                                            <img alt="" class="size-5 rounded-full" src="/images/flags/us.jpg"/>
                                            English
                                        </button>
                                        <div aria-labelledby="dropdown-menu" aria-orientation="vertical"
                                             class="hs-dropdown-menu" role="menu">
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full" src="/images/flags/us.jpg"/>
                                                English
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full" src="/images/flags/spain.jpg"/>
                                                Spanish
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full"
                                                     src="/images/flags/germany.jpg"/>
                                                German
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full" src="/images/flags/french.jpg"/>
                                                French
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full"
                                                     src="/images/flags/japanese.svg"/>
                                                Japanese
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full" src="/images/flags/italy.jpg"/>
                                                Italian
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full" src="/images/flags/russia.jpg"/>
                                                Russian
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                               href="#">
                                                <img alt="" class="size-4 rounded-full"
                                                     src="/images/flags/arebian.svg"/>
                                                Arabic
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto">
                                <img alt="" src="/images/boxed.png"/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
