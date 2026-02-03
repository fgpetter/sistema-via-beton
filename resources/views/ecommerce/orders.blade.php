@extends('layouts.vertical', ['title' => 'Orders'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Order Lists', 'title' => 'Orders'] )

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="col-span-1">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-primary/10 text-primary">
                                <i class="size-6" data-lucide="boxes"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="15101">
                                    15,101</h5>
                                <p class="text-default-500 text-sm">Total Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-secondary/10 text-secondary">
                                <i class="size-6" data-lucide="truck"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="9,543">9,543</h5>
                                <p class="text-default-500 text-sm">Shipping Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-warning/15 text-warning">
                                <i class="size-6" data-lucide="loader"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="1,548">1,548</h5>
                                <p class="text-default-500 text-sm">Pending Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-primary/10 text-primary">
                                <i class="size-6" data-lucide="package-plus"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="3,874">3,874</h5>
                                <p class="text-default-500 text-sm">New Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-success/10 text-success">
                                <i class="size-6" data-lucide="package-check"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="30,914">
                                    30,914</h5>
                                <p class="text-default-500 text-sm">Delivered Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn size-12 text-15 bg-danger/10 text-danger">
                                <i class="size-6" data-lucide="package-x"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base font-semibold text-default-800" data-target="3,863">3,863</h5>
                                <p class="text-default-500 text-sm">Cancelled Orders</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="car-title">Orders Overview</h6>
                </div>
                <div class="card-body">
                    <div id="ordersOverview"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="relative">
                <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email"/>
                <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                    <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
                </div>
            </div>
            <button class="btn btn-sm bg-primary text-white">
                <i class="size-4 me-1" data-lucide="plus"></i>Add Product
            </button>
        </div>
        <div class="card-header">
            <div class="flex items-center flex-wrap gap-3">
                <button class="btn btn-sm bg-primary text-white font-medium" type="button">
                    <i class="size-4" data-lucide="boxes"></i>
                    All Orders
                </button>
                <button class="btn btn-sm text-default-500 hover:text-primary border-0 bg-transparent" type="button">
                    <i class="size-4" data-lucide="loader"></i>
                    Pending
                </button>
                <button class="btn btn-sm text-default-500 hover:text-primary border-0 bg-transparent" type="button">
                    <i class="size-4" data-lucide="package-check"></i>
                    Delivered
                </button>
                <button class="btn btn-sm text-default-500 hover:text-primary border-0 bg-transparent" type="button">
                    <i class="size-4" data-lucide="refresh-cw"></i>
                    Returns
                </button>
                <button class="btn btn-sm text-default-500 hover:text-primary border-0 bg-transparent" type="button">
                    <i class="size-4" data-lucide="package-x"></i>
                    Cancelled
                </button>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                            <tr class="text-sm font-normal text-default-500 whitespace-nowrap">
                                <th class="ps-4 text-start">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </th>
                                <th class="px-3.5 py-3 text-start" scope="col">Order ID</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Order Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Delivery Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Customer Name</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Payment Method</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Amount</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Delivery Status</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    #TWT5015100365
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    08 Jun, 2023
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    15 Jun, 2023
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Marie Prohaska
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    Credit Card
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$541.32
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100366</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 July, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20 July, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Jaqueline Hammes</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Paypal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,876.33</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-secondary/10 text-secondary border border-secondary/30">Shipping</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100367</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Aug, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">24 Aug, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Marlene Hirthe</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Visa Card</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$15,023.99</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-info/10 text-info border border-info/30">New</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100368</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">28 Nov, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02 Dec, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Reagan Larson</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">American Express</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$783.56</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100369</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Glennie Langosh</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">American Express</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$986.49</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/10 text-warning border border-warning/30">Pending</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100370</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16 Feb, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">22 Feb, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Rickie Cremin</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">COD</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$741.32</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100371</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18 Apr, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">29 Apr, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Domenic Tromp</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Credit Card</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,386.49</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-secondary/10 text-secondary border border-secondary/30">Shipping</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100372</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Jan, 2024</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">24 Jan, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Akeem Paucek</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$3,487.21</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-info/10 text-info border border-info/30">New</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100373</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05 Oct, 2024</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">David Gaby</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">COD</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$5,986.11</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 text-default-800/80 border border-default-800/20">Return</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="py-2.5 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TWT5015100374</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07 Oct, 2024</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">13 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Joel Freeleagus</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">American Express</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$9,451.75</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap">
                                    <span
                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger border border-danger/30">Cancelled</span>
                                </td>
                                <td class="px-3.5 py-2.5">
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
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
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
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/apps-ecommerce-orders.js'])
@endsection
