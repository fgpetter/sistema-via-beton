@extends('layouts.vertical', ['title' => 'Grid View'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Grid View'])

    <div class="flex justify-between gap-3 flex-wrap items-center mb-5">
        <div class="relative">
            <input class="form-input form-input-sm ps-9" placeholder="Search for name,email,phone number etc..."
                type="email" />
            <div class="absolute inset-y-0 start-4 flex items-center">
                <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
            </div>
        </div>
        <div class="flex gap-3 items-center">
            <button aria-controls="addUserModal" aria-expanded="false" aria-haspopup="dialog"
                class="btn btn-sm bg-primary text-white" data-hs-overlay="#addUserModal" type="button">
                <i class="size-4 ms-1" data-lucide="plus"></i>
                Add User
            </button>
            <button class="btn size-7.5 bg-default-500 text-white hover:bg-default-600" type="button">
                <i class="size-4" data-lucide="sliders-horizontal"></i>
            </button>
        </div>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-1.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Paula
                            Keenan</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Admin</p>
                    <p class="text-sm text-default-500">748 Luettgen Plain Suite South Winstonfort, NM</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-2.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Marie
                            Prohaska</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">125 Ortiz Camp Suite 471 Rippinport, US</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-3.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Jaqueline
                            Hammes</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Editor</p>
                    <p class="text-sm text-default-500">8716 Dell Manors New Ahmedmouth, WI</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    AB
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Angus
                            Bergstrom</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Developer</p>
                    <p class="text-sm text-default-500">617 Powlowski Crossroad Apt. 716 New Victoria</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-4.png" />
                    <span class="absolute bg-danger border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Aurore
                            Maggio</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">8751 Boyer Courts Suite 532 West Fletcherside</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    AB
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Andrea
                            Pesina</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Editor</p>
                    <p class="text-sm text-default-500">32 Maidstone Road WELLSBOROUGH</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-5.png" />
                    <span class="absolute bg-danger border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Daniel
                            Miller</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">431 Elk Rd Little Ticonderoga, NY</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-6.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Ashley
                            Wilson</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">0816 Bradford Alley Lake Adamfort, ME</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-7.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">William
                            Heineman</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Author</p>
                    <p class="text-sm text-default-500">99614 Pollich Extension Apt. 938 South Alf, GA</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    <img alt="" class="rounded-full size-16" src="/images/user/avatar-8.png" />
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Kara
                            Miller</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">755 Kody Plaza Apt. 138 East Reinholdberg, AR</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    MW
                    <span class="absolute bg-success border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">Mark
                            Walton</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Author</p>
                    <p class="text-sm text-default-500">895 Camylle Tunnel Lake Chasity, SC</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="relative flex items-center justify-center mx-auto text-lg rounded-full size-16 bg-default-100">
                    DB
                    <span class="absolute bg-danger border-2 border-white rounded-full size-3 end-0 bottom-1"></span>
                </div>
                <div class="mt-4 text-center text-default-500">
                    <h5 class="mb-1 text-base text-default-800 font-semibold"><a href="pages-account">David
                            Biggs</a></h5>
                    <p class="mb-3 text-sm text-default-500">@Subscriber</p>
                    <p class="text-sm text-default-500">75, Deccan Gymkhana, Alwar</p>
                </div>
                <div class="flex gap-2 mt-5">
                    <a class="btn border-primary text-primary hover:bg-primary hover:text-white flex-grow"
                        href="{{ route('second', ['apps', 'chat']) }}">
                        <i class="iconify lucide--messages-square"></i>
                        <span class="align-middle">Send Message</span>
                    </a>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn bg-primary size-9 text-white" hs-dropdown-placement="bottom-end"
                            type="button">
                            <i class="iconify lucide--ellipsis size-4"></i>
                        </button>
                        <div class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="eye"></i>
                                Overview
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="edit"></i>
                                Edit
                            </a>
                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                href="#">
                                <i class="size-3" data-lucide="trash-2"></i>
                                Delete
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap md:justify-between justify-center items-centermd:gap-0 gap-4 my-5 text-default-500">
        <p class="text-default-500 text-sm">Showing <b>07</b> of <b>19</b> Results</p>
        <nav aria-label="Pagination" class="flex items-center gap-2">
            <button
                class="btn btn-sm border bg-transparent border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                type="button">
                <i class="size-4 me-1" data-lucide="chevron-left"></i> Prev
            </button>
            <button
                class="btn size-7.5 bg-transparent border border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                type="button">
                1
            </button>
            <button class="btn size-7.5 bg-primary text-white" type="button">
                2
            </button>
            <button
                class="btn size-7.5 bg-transparent border border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                type="button">
                3
            </button>
            <button
                class="btn btn-sm border bg-transparent border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                type="button">Next
                <i class="size-4 ms-1" data-lucide="chevron-right"></i>
            </button>
        </nav>
    </div>

    <div id="addUserModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="addUserModal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="card w-full flex flex-col border border-default-200 shadow-2xs rounded-xl pointer-events-auto">
                <div class="card-header">
                    <h3 id="addUserModal-label" class="font-semibold text-base text-default-800 dark:text-white">
                        Add User
                    </h3>
                    <button type="button" class="size-5 text-default-800" aria-label="Close"
                        data-hs-overlay="#addUserModal">
                        <span class="sr-only">Close</span>
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                <div class="card-body h-130" data-simplebar>
                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium">User ID</label>
                        <input type="text"
                            class="block w-full border-default-200 bg-default-100 rounded-md text-sm text-default-500 placeholder:text-default-400"
                            placeholder="#TW1500004" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="invoiceNo" class="inline-block mb-2 text-sm text-default-800 font-medium">Joining
                            Date</label>
                        <input type="date" id="invoiceNo" class="form-input" placeholder="Invoice Date"
                            data-provider="flatpickr" data-date-format="d M, Y" required="">
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium">Name</label>
                        <input type="text" class="form-input" placeholder="Enter Name">
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium">Email</label>
                        <input type="text" class="form-input" placeholder="Enter email">
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium">Phone Number</label>
                        <input type="text" class="form-input" placeholder="12345 67890">
                    </div>

                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium">Status</label>
                        <select type="text" class="form-input">
                            <option value="" selected>Select Status</option>
                            <option value="Verified">Verified</option>
                            <option value="Waiting">Waiting</option>
                            <option value="Rejected">Rejected</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for=""
                            class="inline-block mb-2 text-sm text-default-800 font-medium">Location</label>
                        <input id="" type="text" class="form-input" placeholder="Location">
                    </div>
                </div>

                <div class="card-footer mt-4 flex gap-2 md:justify-end">
                    <button class="bg-transparent  text-danger btn border-0 hover:bg-danger/10">Cancel</button>

                    <button class="btn bg-primary text-white">Add Order</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
