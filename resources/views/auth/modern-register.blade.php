@extends('layouts.base', ['title' => 'Register'])

@section('css')

@endsection

@section('content')
    <div
        class="relative flex flex-row w-full overflow-hidden bg-gradient-to-r from-blue-900 h-screen to-blue-800 dark:to-blue-900 dark:from-blue-950">
        <div class="absolute inset-0 opacity-20">
            <img alt="" src="/images/modern.svg"/>
        </div>
        <div class="mx-4 m-4 w-160 py-14 px-10 bg-card flex justify-center rounded-md text-center relative z-10">
            <div class="flex flex-col h-full w-full">
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
                <div class="my-21">
                    <div class="mt-10">
                        <!-- Tab Nav -->
                        <div aria-label="Tabs" aria-orientation="horizontal" class="flex justify-center gap-x-3"
                             role="tablist">
                            <button aria-controls="tabsForEmail" aria-selected="true"
                                    class="hs-tab-active:bg-primary hs-tab-active:text-white text-sm py-2.5 px-12 text-default-500 rounded-md bg-default-100 font-medium gap-2 flex items-center transition-all duration-300 active"
                                    data-hs-tab="#tabsForEmail" id="tabs-with-underline-item-1" role="tab"
                                    type="button">
                                <i class="size-4" data-lucide="mail"></i>
                                Email
                            </button>
                            <button aria-controls="tabsForPhone" aria-selected="false"
                                    class="hs-tab-active:bg-primary hs-tab-active:text-white text-sm py-2.5 px-12 text-default-500 rounded-md bg-default-100 font-medium gap-2 flex items-center transition-all duration-300"
                                    data-hs-tab="#tabsForPhone" id="tabs-with-underline-item-2" role="tab"
                                    type="button">
                                <i class="size-4" data-lucide="smartphone"></i>
                                Phone
                            </button>
                        </div>
                        <!-- Tab Content -->
                        <div class="mt-10 w-100 mx-auto">
                            <!-- Email Tab -->
                            <div aria-labelledby="tabs-with-underline-item-1" id="tabsForEmail" role="tabpanel">
                                <form action="{{ route('second', ['dashboards', 'index']) }}" class="text-left w-full mt-10">
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2" for="Username">Email
                                            ID</label>
                                        <input class="form-input" id="Username" placeholder="Enter Username or email"
                                               type="email"/>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2" for="Username">Username</label>
                                        <input class="form-input" id="Username" placeholder="Enter Username"
                                               type="text"/>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2" for="Password">Password</label>
                                        <input class="form-input" id="Password" placeholder="Enter Password"
                                               type="text"/>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <input class="form-checkbox" id="checkbox-1" type="checkbox"/>
                                        <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember
                                            Me</label>
                                    </div>
                                    <div class="mt-10 text-center">
                                        <button class="btn bg-primary text-white w-full" type="button">Sign Up</button>
                                    </div>
                                    <div
                                        class="my-9 relative text-center before:absolute before:top-2.5 before:left-0 before:border-t before:border-t-default-200 before:w-full before:h-0.5 before:right-0 before:-z-0">
                                        <h4 class="relative z-1 py-0.5 px-2 inline-block font-medium bg-card text-default-500 rounded-md">
                                            Already have an account ?</h4>
                                    </div>
                                    <div class="flex w-full justify-center items-center gap-2">
                                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                                           href="#">
                                            <i class="iconify-color logos--google-icon"></i>
                                            Use Google
                                        </a>
                                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                                           href="#">
                                            <i class="iconify logos--apple text-mono"></i>
                                            Use Apple
                                        </a>
                                    </div>
                                    <div class="mt-10 text-center">
                                        <p class="text-base text-default-500">Already have an account ?
                                            <a class="font-semibold underline hover:text-primary transition duration-200"
                                               href="{{ route('second', ['auth', 'modern-login']) }}">Login</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                            <!-- Phone Tab -->
                            <div aria-labelledby="tabs-with-underline-item-2" class="hidden" id="tabsForPhone"
                                 role="tabpanel">
                                <form action="{{ route('second', ['dashboards', 'index']) }}" class="text-left w-full mt-10">
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2"
                                               for="Phone Number">Phone Number</label>
                                        <input class="form-input" id="Phone Number" placeholder="Enter Phone"
                                               type="text">
                                        </input></div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2" for="Username">Username</label>
                                        <input class="form-input" id="Username" placeholder="Enter Username"
                                               type="text"/>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block font-medium text-default-900 text-sm mb-2" for="Password">Password</label>
                                        <input class="form-input" id="Password" placeholder="Enter Password"
                                               type="text"/>
                                    </div>
                                    <div class="flex items-center gap-2 mb-4">
                                        <input class="form-checkbox" id="checkbox-1" type="checkbox"/>
                                        <label class="text-default-900 text-sm font-medium" for="checkbox-1">Remember
                                            Me</label>
                                    </div>
                                    <div class="mt-10 text-center">
                                        <button class="btn bg-primary text-white w-full" type="button">Sign Up</button>
                                    </div>
                                    <div
                                        class="my-9 relative text-center before:absolute before:top-2.5 before:left-0 before:border-t before:border-t-default-200 before:w-full before:h-0.5 before:right-0 before:-z-0">
                                        <h4 class="relative z-1 py-0.5 px-2 inline-block font-medium bg-card text-default-500 rounded-md">
                                            Already have an account ?</h4>
                                    </div>
                                    <div class="flex w-full justify-center items-center gap-2">
                                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                                           href="#">
                                            <i class="iconify-color logos--google-icon"></i>
                                            Use Google
                                        </a>
                                        <a class="btn border border-default-200 flex-grow hover:bg-default-150 shadow-sm hover:text-default-800"
                                           href="#">
                                            <i class="iconify logos--apple text-mono"></i>
                                            Use Apple
                                        </a>
                                    </div>
                                    <div class="mt-10 text-center">
                                        <p class="text-base text-default-500">Already have an account ?
                                            <a class="font-semibold underline hover:text-primary transition duration-200"
                                               href="{{ route('second', ['auth', 'modern-login']) }}"> Login</a>
                                        </p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                <div class="mt-10 text-center">
                    <h3 class="mb-3 text-blue-50 text-2xl font-semibold text-center">Tools For Crafting Your Business's
                        Brand Identity</h3>
                    <p class="text-blue-300 text-base w-2xl text-center">Unlock the potential of our versatile branding
                        tools, designed to empower your business in shaping a distinctive and impactful brand. Elevate
                        your business's image and leave a lasting impression with our comprehensive branding
                        solutions.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
