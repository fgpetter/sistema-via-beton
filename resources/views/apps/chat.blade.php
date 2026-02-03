@extends('layouts.vertical', ['title' => 'chat'])

@section('css')

@endsection

@section('content')
    <div class="card overflow-hidden">
        <div class="flex">
            <div class="lg:border-e border-default-200">
                <div aria-label="Sidebar"
                     class="hs-overlay [--auto-close:lg] lg:block lg:translate-x-0 lg:static lg:end-auto lg:bottom-0 w-96 hs-overlay-open:translate-x-0 -translate-x-full transition-all duration-300 transform h-full hidden fixed top-0 start-0 bottom-0 overflow-hidden z-60"
                     id="hs-offcanvas-left" role="dialog" tabindex="-1">
                    <div
                        class="card rounded-none shadow-none relative flex flex-row h-full max-h-full overflow-hidden divide-x divide-default-200">
                        <div class="card-body flex flex-col justify-between">
                            <a href="#">
                                <img alt="logo" class="h-8 mx-auto" src="/images/logo-sm.png"/>
                            </a>
                            <div class="flex flex-col items-center gap-6 pt-10">
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="messages-square"></i>
                                </button>
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="user-square"></i>
                                </button>
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="bot"></i>
                                </button>
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="user-2"></i>
                                </button>
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="scroll-text"></i>
                                </button>
                            </div>
                            <div class="flex flex-col items-center gap-4">
                                <button class="btn size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                    <i class="size-5" data-lucide="settings"></i>
                                </button>
                                <div class="hs-dropdown relative">
                                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                            class="hs-dropdown-toggle flex justify-center items-center"
                                            hs-dropdown-placement="top-end" type="button">
                                        <img alt="avatar" class="rounded-md bg-pink-500/10 size-12 object-cover"
                                             src="/images/user/avatar-1.png"/>
                                    </button>
                                    <div class="hs-dropdown-menu" role="menu">
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Logout
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Switch Account
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="w-80">
                            <div class="card-body">
                                <div class="flex justify-between">
                                    <div class="flex gap-3 items-center">
                                        <h6 class="card-title">Chats</h6>
                                    </div>
                                    <button class="size-8 btn bg-default-150">
                                        <i class="size-4 text-default-500 hover:text-primary" data-lucide="plus"></i>
                                    </button>
                                </div>
                                <div class="mt-5 relative">
                                    <input class="ps-11 block w-full form-input form-input-sm"
                                           placeholder="Search for...." type="email"/>
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-4">
                                        <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="lg:h-[calc(100vh-310px)] h-[calc(100vh-125px)]" data-simplebar="">
                                <div class="px-5 mb-1">
                                    <p class="mb-1 text-default-500 text-sm">Recent Chats</p>
                                </div>
                                <a class="flex gap-3 py-2 px-4 bg-default-200" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/avatar-5.png"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-green-500"></span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Marie Prohaska</h6>
                                        <p class="text-xs truncate text-default-500">I will purchase it for support</p>
                                    </div>
                                    <small class="text-xs text-default-500">2min ago</small>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/user-1.jpg"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-danger"></span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Kara Miller</h6>
                                        <p class="text-xs truncate text-default-500">Hey, how's it going?</p>
                                    </div>
                                    <small class="text-xs text-default-500">02:57 PM</small>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/avatar-1.png"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-green-500"></span>
                                    </div>
                                    <div class="flex-grow">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Mark Walton</h6>
                                        <p class="text-xs truncate text-default-500">Hey, how's it going?</p>
                                    </div>
                                    <small class="text-xs text-default-500">Yesterday</small>
                                </a>
                                <div class="px-5 pt-2">
                                    <p class="mb-1 text-default-500 text-sm">All Conversion</p>
                                </div>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/user-2.jpg"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-default-500"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Aurore Maggio</h6>
                                        <p class="text-xs truncate text-default-500">React Developer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        LP
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-green-500"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Mark Walton</h6>
                                        <p class="text-xs truncate text-default-500">UI / UX Designer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/avatar-5.png"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-danger"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Daniel Miller</h6>
                                        <p class="text-xs truncate text-default-500">ASP.Net Developer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/user-3.jpg"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-default-950"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Jaqueline Hammes</h6>
                                        <p class="text-xs truncate text-default-500">Angular Developer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/avatar-8.png"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-default-950"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Andrea Pesina</h6>
                                        <p class="text-xs truncate text-default-500">Laravel Developer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/avatar-10.png"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-green-500"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Bernard Pereira</h6>
                                        <p class="text-xs truncate text-default-500">Web Designer </p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/user-4.jpg"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-default-950"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">William Jones</h6>
                                        <p class="text-xs truncate text-default-500">Project Manager </p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        <img alt="" class="rounded-full w-9 h-9" src="/images/user/user-2.jpg"/>
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-default-500"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Aurore Maggio</h6>
                                        <p class="text-xs truncate text-default-500">React Developer</p>
                                    </div>
                                </a>
                                <a class="flex gap-3 py-2 px-4 hover:bg-default-150" href="#">
                                    <div
                                        class="relative flex items-center justify-center font-semibold rounded-full size-9 bg-default-200">
                                        LP
                                        <span
                                            class="absolute bottom-0 right-0 w-2.5 h-2.5 border-2 border-default-50 rounded-full bg-green-500"></span>
                                    </div>
                                    <div class="">
                                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Mark Walton</h6>
                                        <p class="text-xs truncate text-default-500">UI / UX Designer</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full border-e border-default-200 rounded">
                <div class="card-body">
                    <div class="gap-3 flex justify-between">
                        <div class="flex gap-3.5 items-center">
                            <button aria-controls="hs-offcanvas-left" aria-expanded="false" aria-haspopup="dialog"
                                    class="lg:hidden size-8 rounded-md flex justify-center items-center bg-default-100"
                                    data-hs-overlay="#hs-offcanvas-left">
                                <i class="size-4 text-default-500 hover:text-primary" data-lucide="chevrons-left"></i>
                            </button>
                            <div class="rounded-full size-10 bg-default-100">
                                <img alt="" class="h-10 rounded-full" src="/images/user/avatar-7.png"/>
                            </div>
                            <div>
                                <h6 class="text-default-800 mb-1 font-bold text-sm">William Heineman</h6>
                                <p class="text-xs text-default-500">NextJS Developer</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <button
                                class="btn rounded-full size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                <i class="size-5" data-lucide="phone"></i>
                            </button>
                            <button
                                class="btn rounded-full size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                <i class="size-5" data-lucide="video"></i>
                            </button>
                            <button
                                class="btn rounded-full size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                <i class="size-5" data-lucide="search"></i>
                            </button>
                            <button
                                class="btn rounded-full size-9 hover:bg-primary/10 hover:text-primary transition-all">
                                <i class="size-5" data-lucide="panel-right-open"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="h-[calc(100vh-340px)]" data-simplebar="">
                    <div class="card-body bg-default-50">
                        <div class="flex flex-col gap-5">
                            <div class="flex gap-3 items-end">
                                <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                   href="#">
                                    <img alt="" class="object-cover rounded-full h-9" src="/images/user/avatar-7.png"/>
                                </a>
                                <div class="p-4 card text-default-700 text-sm">
                                    Sure, I have my pen and paper ready.
                                </div>
                            </div>
                            <div class="flex gap-3 justify-end items-end">
                                <div class="w-92 p-4 card text-default-700 text-sm">
                                    Great. Please read the notes of our last meeting for us.
                                </div>
                                <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                   href="#">
                                    <img alt="" class="object-cover rounded-full h-9" src="/images/user/avatar-1.png"/>
                                </a>
                            </div>
                            <div class="flex gap-3 items-end">
                                <div>
                                    <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                       href="#">
                                        <img alt="" class="object-cover rounded-full h-9"
                                             src="/images/user/avatar-7.png"/>
                                    </a>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <div class="w-92 p-4 card">
                                        <div class="text-default-700 text-sm">
                                            Okay. First, we talked about the budget for next year.
                                        </div>
                                        <div class="grid grid-cols-3 gap-4 mt-4">
                                            <a href="#">
                                                <img alt="" class="rounded-md" src="/images/small/img-3.jpg"/>
                                            </a>
                                            <a href="#">
                                                <img alt="" class="rounded-md" src="/images/small/img-5.jpg"/>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="w-77 p-4 card text-default-700 text-sm">
                                        I will budget is getting smaller every year.
                                    </div>
                                    <div class="w-92 p-4 card text-default-700 text-sm">
                                        Second, we talked about the new products we are going to selling.
                                    </div>
                                    <div class="w-92 p-4 card text-default-700 text-sm">
                                        O.K. Third, we talked about the profits that we had last month. And fourth, we
                                        talked about the bills we had to pay.
                                    </div>
                                </div>
                            </div>
                            <div class="flex gap-3 justify-end items-end">
                                <div class="w-92 p-4 card text-default-700 text-sm">
                                    Sorry, William. O.K. We have a few things to talk about today. would you like to
                                    give your report.
                                </div>
                                <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                   href="#">
                                    <img alt="" class="object-cover rounded-full h-9" src="/images/user/avatar-1.png"/>
                                </a>
                            </div>
                            <div class="flex gap-3 items-end">
                                <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                   href="#">
                                    <img alt="" class="object-cover rounded-full h-9" src="/images/user/avatar-7.png"/>
                                </a>
                                <div class="w-92 p-4 card text-default-700 text-sm">
                                    Yes, thank you 🤩. I have a sales graph I would like to show everyone. This shows how
                                    well we are selling our products this year.
                                </div>
                            </div>
                            <div class="flex gap-3 justify-end items-end">
                                <div class="w-92 p-4 card text-default-700 text-sm">
                                    Thank you 🤩, William. Very good. Tom, do you have anything to tell everyone.
                                </div>
                                <a class="flex items-center justify-center text-sm font-semibold rounded-full size-9 bg-default-200"
                                   href="#">
                                    <img alt="" class="object-cover rounded-full h-9" src="/images/user/avatar-1.png"/>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="flex gap-2 items-center">
                        <input class="form-input w-full" placeholder="Type your message here..." type="text"/>
                        <div class="flex items-center gap-2">
                            <button class="btn size-9 bg-danger/10 text-danger hover:bg-danger hover:text-white">
                                <i class="size-4" data-lucide="mic"></i>
                            </button>
                            <button class="btn size-9 bg-primary/10 text-primary hover:bg-primary hover:text-white">
                                <i class="size-4" data-lucide="image"></i>
                            </button>
                            <button class="btn bg-primary text-white"><i class="size-4" data-lucide="send"></i>Send
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
