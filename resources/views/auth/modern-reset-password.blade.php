@extends('layouts.base', ['title' => 'Reset Password'])

@section('css')

@endsection

@section('content')
    <div
        class="relative flex flex-row w-full overflow-hidden bg-gradient-to-r from-blue-900 h-screen to-blue-800 dark:to-blue-900 dark:from-blue-95">
        <div class="absolute inset-0 opacity-20">
            <img alt="" src="/images/modern.svg"/>
        </div>
        <div class="mx-4 m-4 w-160 py-14 px-10 bg-card flex justify-center rounded-md text-center relative z-10">
            <div class="flex flex-col h-full">
                <div class="flex justify-end">
                    <!-- Language Dropdown Button -->
                    <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                class="hs-dropdown-toggle py-2 px-4 bg-transparent border border-default-200 text-default-600 hover:border-primary rounded-md hover:text-primary font-medium text-sm gap-2 flex items-center"
                                type="button">
                            <img alt="" class="size-5 rounded-full" src="/images/flags/us.jpg"/>
                            English
                        </button>
                        <div aria-labelledby="dropdown-menu" aria-orientation="vertical" class="hs-dropdown-menu"
                             role="menu">
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
                                <img alt="" class="size-4 rounded-full" src="/images/flags/germany.jpg"/>
                                German
                            </a>
                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                <img alt="" class="size-4 rounded-full" src="/images/flags/french.jpg"/>
                                French
                            </a>
                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                <img alt="" class="size-4 rounded-full" src="/images/flags/japanese.svg"/>
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
                                <img alt="" class="size-4 rounded-full" src="/images/flags/arebian.svg"/>
                                Arabic
                            </a>
                        </div>
                    </div>
                </div>
                <div class="my-auto">
                    <div class="mt-8">
                        <h4 class="mb-2 text-primary text-xl font-semibold">Forgot Password?</h4>
                        <p class="text-base mb-8 text-default-500">Reset your Tailwick password</p>
                    </div>
                    <div class="p-3 mb-6 text-warning rounded-md bg-warning/15">
                        Provide your email address, and instructions will be sent to you
                    </div>
                    <form action="{{ route('second', ['dashboards', 'index']) }}" class="mx-auto">
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
                                    href="{{ route('second', ['auth', 'modern-login']) }}"> Click here </a></p>
                        </div>
                    </form>
                </div>
                <div class="mt-5">
<span class="text-sm text-default-500">
<i class="iconify lucide--copyright align-middle"></i>
                        2025 Tailwick. Crafted with
                        <i class="iconify tabler--heart-filled align-middle text-danger"></i>
                        by
                        <a class="text-default-800 hover:text-primary transition duration-200 underline"
                           href="https://themesdesign.in/" target="_blank">Themesdesign</a>
</span>
                </div>
            </div>
        </div>
        <div class="relative z-10 flex items-center justify-center min-h-screen px-10 py-14 grow">
            <div>
                <a class="" href="{{ route('second', ['dashboards', 'index']) }}">
                    <img alt="" class="h-7 mb-14 mx-auto block" src="/images/logo-light.png"/>
                </a>
                <img alt="" class="mx-auto rounded-xl block object-cover w-md" src="/images/auth-modern.png"/>
                <div class="mt-10 tetx-center">
                    <h3 class="mb-3 text-blue-50 text-2xl font-semibold text-center">Tools For Crafting Your
                        Business's Brand Identity
                    </h3>
                    <p class="text-blue-300 text-base w-2xl text-center">Unlock the potential of our
                        versatile branding tools, designed to empower your business in shaping a distinctive
                        and impactful brand. Elevate your business's image and leave a lasting impression
                        with our comprehensive branding solutions.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
