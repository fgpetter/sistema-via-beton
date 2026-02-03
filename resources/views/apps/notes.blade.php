@extends('layouts.vertical', ['title' => 'Notes'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Notes'] )

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-primary/15 border-primary"
                                        type="button"></button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <div>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Personal
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Busssiness
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Social
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-sm text-default-600 hover:bg-default-150 rounded"
                                           href="#">
                                            Home
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <h5 class="card-title">Show Then Our Research</h5>
                        </div>
                        <div class="hs-dropdown [--placement:bottom-right] relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">You should identify and anticipate any ethical issues or
                        dilemmas that may arise during or after your research, and how you will resolve them.You should
                        identify and anticipate any ethical issues or dilemmas that may arise during...
                    </p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-warning fill-warning/20 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">16 May, 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-danger/15 border-danger"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">New People Hiring</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-800 font-semibold text-sm">Steps to recruiting employees
                    <ol class="flex flex-col text-default-600 gap-1 text-sm mt-1">
                        <li>Consider your actual needs</li>
                        <li>Conduct interviews with top applicants</li>
                        <li>Don’t take too long to hire</li>
                        <li>Making the offer</li>
                    </ol>
                    </p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-default-500 fill-default-200 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">24 Mar,2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-secondary/10 border-secondary"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">Design Tools</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">Visual design tools are, for example, gesture, sketch, drawing,
                        scale model, perspective drawing, photograph, film, video. These include flowcharts, pseudocode,
                        and Nassi-Shneiderman diagrams.</p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-warning fill-warning/20 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">29 Feb, 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-success/10 border-success"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">Create Chat Apps</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do
                        eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    </p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-default-500 fill-default-200 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">01 Jan, 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-primary/10 border-primary"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">Show Then Our Research</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">You should identify and anticipate any ethical issues or
                        dilemmas that may arise during or after your research, and how you will resolve them. You should
                        also consider the impact and consequences of your research on different stakeholders.</p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-warning fill-warning/20 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">16 May, 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-danger/15 border-danger"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">New People Hiring</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-800 font-semibold text-sm">Steps to recruiting employees
                    <ol class="flex flex-col text-default-600 gap-1 text-sm mt-1">
                        <li>Consider your actual needs</li>
                        <li>Conduct interviews with top applicants</li>
                        <li>Don’t take too long to hire</li>
                        <li>Making the offer</li>
                    </ol>
                    </p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-default-500 fill-default-200 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">24 Mar, 2023</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-primary/10 border-primary"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">Boarding is Important Thing</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">Living away from home and residing on campus in a dorm setting
                        provides invaluable opportunities for personal growth. Boarding school students tend to develop
                        life Business such as time management, work ethic</p>
                </div>
                <div class="mt-4 flex justify-between gap-3 items-center">
                    <i class="text-default-500 fill-default-200 size-5" data-lucide="star"></i>
                    <p class="text-default-500 text-sm">29 Mar, 2023</p>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex flex-col justify-between h-full">
                    <div class="mb-5 flex justify-between items-center gap-2">
                        <div class="flex gap-2 items-center">
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle size-4 border border-dashed rounded-full dropdown-toggle shrink-0 bg-secondary/10 border-secondary"
                                        hs-dropdown-placement="bottom-end" type="button">
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Personal
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Busssiness
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Social
                                    </a>
                                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                       href="#">
                                        Home
                                    </a>
                                </div>
                            </div>
                            <h5 class="card-title">Company Improvements</h5>
                        </div>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
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
                    <p class="text-default-700 text-sm">Improving a business's performance requires a strategic and
                        holistic approach that focuses on key areas such as setting and tracking KPIs, improving
                        operational efficiency.
                    </p>
                    <div class="mt-4 flex justify-between gap-3 items-center">
                        <i class="text-warning fill-warning/20 size-5" data-lucide="star"></i>
                        <p class="text-default-500 text-sm">09 Jun, 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
