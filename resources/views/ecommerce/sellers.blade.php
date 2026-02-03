@extends('layouts.vertical', ['title' => 'Sellers'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Sellers'] )

    <div class="flex justify-between gap-3 flex-wrap items-center mb-5">
        <div class="relative">
            <input class="ps-11 form-input" placeholder="Search for..." type="email"/>
            <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
            </div>
        </div>
        <button aria-controls="ecommerce-sellers-add" aria-expanded="false" aria-haspopup="dialog"
                class="btn bg-primary text-white" data-hs-overlay="#ecommerce-sellers-add" type="button">
            <i class="size-4 ms-1" data-lucide="plus"></i>
            Add Seller
        </button>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-warning fill-warning/10" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--google-adwords size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Themesdesign</h6>
                        <p class="text-default-500 text-sm">Paula Keenan</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">4.5k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">310</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$235.3k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-warning fill-warning/10" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--apple-app-store size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Nazox Fashion</h6>
                        <p class="text-default-500 text-sm">Kara Miller</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">2.3k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">67</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$235.3k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-default-500 fill-default-100" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--google-gmail size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">4xM Infotech</h6>
                        <p class="text-default-500 text-sm">Daniel Miller</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">7.1k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">138</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$465.9k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-warning fill-warning/10" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--android-icon size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Extra Fashion</h6>
                        <p class="text-default-500 text-sm">Mark Walton</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">1.9k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">49</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$198.3k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-warning fill-warning/10" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--figma size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Nesta Technologies</h6>
                        <p class="text-default-500 text-sm">William Heineman</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">4.8k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">172</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$746.1k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-default-500 fill-default-100" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--meta-icon size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Digitech Galaxy</h6>
                        <p class="text-default-500 text-sm">David Biggs</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">9.2k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">674</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$14.4m</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-default-500 fill-default-100" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--google-icon size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Zoetic Fashion</h6>
                        <p class="text-default-500 text-sm">Jaqueline Hammes</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">1.8k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">112</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$132.4k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between gap-5 items-center mb-4">
                    <i class="size-5 text-default-500 fill-default-100" data-lucide="heart"></i>
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
                <div>
                    <div
                        class="flex items-center justify-center mx-auto rounded-full size-16 bg-default-100 outline outline-default-100 outline-offset-4">
                        <i class="iconify-color logos--telegram size-10"></i>
                    </div>
                    <div class="mt-4 mb-6 text-center">
                        <h6 class="text-base text-default-800 font-semibold">Force Medicines</h6>
                        <p class="text-default-500 text-sm">Ashley Uilson</p>
                    </div>
                    <div class="grid grid-cols-3">
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">4.1k</h6>
                            <p class="text-default-500">Sales</p>
                        </div>
                        <div class="text-center p-2 border-e border-s border-dashed border-default-200 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">243</h6>
                            <p class="text-default-500">Product</p>
                        </div>
                        <div class="text-center p-2 text-sm">
                            <h6 class="mb-1 text-default-800 font-semibold">$861.7k</h6>
                            <p class="text-default-500">Revenue</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-wrap justify-center md:justify-between items-center md:gap-0 gap-4 mt-5 text-default-500">
        <p class="text-default-500 text-sm">Showing <b>12</b> of <b>44</b> Results</p>
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
@endsection

@section('scripts')

@endsection
