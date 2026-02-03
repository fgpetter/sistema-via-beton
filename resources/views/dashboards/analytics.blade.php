@extends('layouts.vertical', ['title' => 'Analytics'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Dashboards', 'title' => 'Analytics'])

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="col-span-1">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="card bg-success/15 overflow-hidden">
                    <div class="card-body">
                        <i class="absolute top-0 size-32 text-success/10 -end-10" data-lucide="kanban"></i>
                        <div class="btn btn-icon size-12 bg-green-800">
                            <i class="size-6 text-green-50" data-lucide="users"></i>
                        </div>
                        <h5 class="mt-5 mb-2 text-lg font-semibold">
                            <span data-target="15876">15,876</span>
                        </h5>
                        <p class="text-sm text-default-700">Total Users</p>
                    </div>
                </div>
                <div class="card bg-danger/15 overflow-hidden">
                    <div class="card-body">
                        <i class="absolute top-0 size-32 text-danger/10 -end-10" data-lucide="list-filter"></i>
                        <div class="btn btn-icon bg-danger size-12">
                            <i class="size-6 text-white" data-lucide="cog"></i>
                        </div>
                        <h5 class="mt-5 mb-2 text-lg font-semibold">
                            <span data-target="15876">103.15k</span>
                        </h5>
                        <p class="text-sm text-default-700">Sessions</p>
                    </div>
                </div>
                <div class="card bg-secondary/15 overflow-hidden">
                    <div class="card-body">
                        <i class="absolute top-0 size-32 text-secondary/10 -end-10" data-lucide="list-filter"></i>
                        <div class="btn btn-icon bg-secondary size-12">
                            <i class="size-6 text-sky-50" data-lucide="coins"></i>
                        </div>
                        <h5 class="mt-5 mb-2 text-lg font-semibold">
                            <span class="counter-value" data-target="1">0</span>
                            <span>M</span> <span class="counter-value" data-target="29">0</span>sec
                        </h5>
                        <p class="text-sm text-default-700">Avg. Visit Duration</p>
                    </div>
                </div>
                <div class="card bg-info/15 overflow-hidden">
                    <div class="card-body">
                        <i class="absolute top-0 size-32 text-info/10 -end-10" data-lucide="kanban"></i>
                        <div class="btn btn-icon bg-info size-12">
                            <i class="size-6 text-purple-50" data-lucide="coins"></i>
                        </div>
                        <h5 class="mt-5 mb-2 text-lg font-semibold">
                            <span class="counter-value" data-target="49.77">49.77</span>%
                        </h5>
                        <p class="text-sm text-default-700">Bounce Rate</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Platform Perspective</h6>
                    <div class="flex">
                        <select class="form-input form-input-sm border-default-400 bg-transparent border-dashed">
                            <option selected="">This Yearly</option>
                            <option>1 Weekly</option>
                            <option>1 Monthly</option>
                            <option>3 Monthly</option>
                            <option>6 Monthly</option>
                            <option>This Yearly</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div id="platformPerspective"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-12 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-5 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Location-Based Response Times</h6>
                    <button class="btn btn-sm bg-primary/20 text-primary text-nowrap hover:bg-primary hover:text-white"
                        type="button">
                        View More
                        <i class="size-4" data-lucide="move-right"></i>
                    </button>
                </div>
                <div class="card-body">
                    <div id="responseTimes"></div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-7 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Pages Interaction</h6>
                    <button>
                        <select class="bg-default-200 text-default-600 form-input form-input-sm">
                            <option selected="">This Yearly</option>
                            <option>1 Weekly</option>
                            <option>1 Monthly</option>
                            <option>3 Monthly</option>
                            <option>6 Monthly</option>
                            <option>This Yearly</option>
                        </select>
                    </button>
                </div>
                <div class="card-body">
                    <div id="pagesInteraction"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <div class="flex items-center gap-1.5">
                    <h6 class="card-title">User Device</h6>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content max-w-80 hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-50 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">
                                You can see your number of desktop, mobile, and tablet users.
                            </span>
                        </button>
                    </div>
                </div>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150" hs-dropdown-placement="bottom-end"
                        type="button">
                        <i class="iconify lucide--ellipsis-vertical size-4 text-default-500"></i>
                    </button>
                    <div class="hs-dropdown-menu" role="menu">
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Weekly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            3 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            6 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            This Yearly
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="userDeviceCharts"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="flex items-center gap-1.5">
                    <h6 class="card-title">Satisfaction Level</h6>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content max-w-80 hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">
                                The 1-to-5 satisfaction scale is used for measuring customer satisfaction
                            </span>
                        </button>
                    </div>
                </div>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150" hs-dropdown-placement="bottom-end"
                        type="button">
                        <i class="iconify lucide--ellipsis-vertical size-4 text-default-500"></i>
                    </button>
                    <div class="hs-dropdown-menu" role="menu">
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Weekly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            3 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            6 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            This Yearly
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="apex-charts" id="satisfactionRate"></div>
                <p class="text-center text-15xl">Based on Likes 💖</p>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="flex items-center gap-1.5">
                    <h6 class="card-title">Daily Visit Insights </h6>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content max-w-80 hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">
                                Analyst or business user discovering a pattern in data or a relationship between variables
                            </span>
                        </button>
                    </div>
                </div>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150" hs-dropdown-placement="bottom-end"
                        type="button">
                        <i class="iconify lucide--ellipsis-vertical size-4 text-default-500"></i>
                    </button>
                    <div class="hs-dropdown-menu" role="menu">
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Weekly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            1 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            3 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            6 Monthly
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                            href="#">
                            This Yearly
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="apex-charts" id="dailyVisitInsightsChart"></div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Products Statistics</h6>
                <div class="flex gap-3 items-center">
                    <div class="relative">
                        <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email" />
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <i class="size-3.5 text-default-500" data-lucide="search"></i>
                        </div>
                    </div>
                    <button
                        class="btn btn-sm bg-transparent text-primary border border-dashed border-primary hover:bg-primary/20">
                        <i class="size-4 me-1" data-lucide="download"></i>Export
                    </button>
                </div>
            </div>
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                                <tr class="text-default-600">
                                    <th class="py-3 text-start ps-4" scope="col">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Products</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Price</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Income</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Sales</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">View</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Click</th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium whitespace-nowrap"
                                        scope="col">
                                        Click (%)
                                    </th>
                                    <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">SmartTech Pro-4K Ultra HD TV</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,542.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$12.36k</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">3,217</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21,451</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16,287</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">39.56%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">LuxeLeather Vintage
                                        Messenger Bag
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$699.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$22.88k</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">7,321</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">32,151</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">27,485</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">87.33%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">InfinityGlow LED Desk Lamp
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$324.77</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$21.10k</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">8,245</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">33,415</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">25,430</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">91.43%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/15 text-danger rounded">
                                            <i class="size-3" data-lucide="x-circle"></i> Unactive
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">PowerPulse Wireless Earbuds</td>
                                    <td class="px-3.5 py-2.5 text-sm">$99.00</td>
                                    <td class="px-3.5 py-2.5 text-sm">$374</td>
                                    <td class="px-3.5 py-2.5 text-sm">2,987</td>
                                    <td class="px-3.5 py-2.5 text-sm">41,123</td>
                                    <td class="px-3.5 py-2.5 text-sm">46,963</td>
                                    <td class="px-3.5 py-2.5 text-sm">79.21%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">AdventureQuest Outdoor Backpack</td>
                                    <td class="px-3.5 py-2.5 text-sm">$107.00</td>
                                    <td class="px-3.5 py-2.5 text-sm">$8.22</td>
                                    <td class="px-3.5 py-2.5 text-sm">2,541</td>
                                    <td class="px-3.5 py-2.5 text-sm">14,789</td>
                                    <td class="px-3.5 py-2.5 text-sm">12,584</td>
                                    <td class="px-3.5 py-2.5 text-sm">39.04%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/15 text-danger rounded">
                                            <i class="size-3" data-lucide="x-circle"></i> Unactive
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">FitLifePro Fitness Tracker</td>
                                    <td class="px-3.5 py-2.5 text-sm">$111.99</td>
                                    <td class="px-3.5 py-2.5 text-sm">$42.2k</td>
                                    <td class="px-3.5 py-2.5 text-sm">44,201</td>
                                    <td class="px-3.5 py-2.5 text-sm">40,888</td>
                                    <td class="px-3.5 py-2.5 text-sm">14,520</td>
                                    <td class="px-3.5 py-2.5 text-sm">68.41%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">ChefMaster Pro Cookware Set</td>
                                    <td class="px-3.5 py-2.5 text-sm">$107.00</td>
                                    <td class="px-3.5 py-2.5 text-sm">$8.22</td>
                                    <td class="px-3.5 py-2.5 text-sm">2,541</td>
                                    <td class="px-3.5 py-2.5 text-sm">14,789</td>
                                    <td class="px-3.5 py-2.5 text-sm">12,584</td>
                                    <td class="px-3.5 py-2.5 text-sm">39.04%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/15 text-danger rounded">
                                            <i class="size-3" data-lucide="x-circle"></i> Unactive
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">PetPalace Pet Accessories</td>
                                    <td class="px-3.5 py-2.5 text-sm">$1,542.99</td>
                                    <td class="px-3.5 py-2.5 text-sm">$12.36k</td>
                                    <td class="px-3.5 py-2.5 text-sm">3,217</td>
                                    <td class="px-3.5 py-2.5 text-sm">21,451</td>
                                    <td class="px-3.5 py-2.5 text-sm">16,287</td>
                                    <td class="px-3.5 py-2.5 text-sm">39.56%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">TravelSavvy Luggage Collection</td>
                                    <td class="px-3.5 py-2.5 text-sm">$1,542.99</td>
                                    <td class="px-3.5 py-2.5 text-sm">$12.36k</td>
                                    <td class="px-3.5 py-2.5 text-sm">3,217</td>
                                    <td class="px-3.5 py-2.5 text-sm">21,451</td>
                                    <td class="px-3.5 py-2.5 text-sm">16,287</td>
                                    <td class="px-3.5 py-2.5 text-sm">39.56%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">MusicMuse Premium Headphones</td>
                                    <td class="px-3.5 py-2.5 text-sm">$99.00</td>
                                    <td class="px-3.5 py-2.5 text-sm">$374</td>
                                    <td class="px-3.5 py-2.5 text-sm">2,987</td>
                                    <td class="px-3.5 py-2.5 text-sm">41,123</td>
                                    <td class="px-3.5 py-2.5 text-sm">46,963</td>
                                    <td class="px-3.5 py-2.5 text-sm">79.21%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/15 text-success rounded">
                                            <i class="size-3" data-lucide="check-circle-2"></i>
                                            Active
                                        </span>
                                    </td>
                                </tr>
                                <tr class="text-default-800">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 text-sm">WellnessWonders Yoga Mat</td>
                                    <td class="px-3.5 py-2.5 text-sm">$324.77</td>
                                    <td class="px-3.5 py-2.5 text-sm">$21.10k</td>
                                    <td class="px-3.5 py-2.5 text-sm">8,245</td>
                                    <td class="px-3.5 py-2.5 text-sm">33,415</td>
                                    <td class="px-3.5 py-2.5 text-sm">25,430</td>
                                    <td class="px-3.5 py-2.5 text-sm">91.43%</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/15 text-danger rounded">
                                            <i class="size-3" data-lucide="x-circle"></i> Unactive
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>07</b> of <b>11</b> Results</p>
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
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-header mb-4">
                <h6 class="card-title">Analytics Reports</h6>
            </div>
            <div class="card-body">
                <div id="analytics-reports"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Status of Monthly Campaign</h6>
            </div>
            <div class="card-body">
                <ul class="flex flex-col gap-5">
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-danger/10 btn size-8">
                            <i class="text-danger size-4" data-lucide="mail"></i>
                        </div>
                        <h6 class="grow text-default-900">Clicked</h6>
                        <p>9,745</p>
                        <div class="w-12 text-success text-end">2.5%</div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-secondary/10 btn size-8">
                            <i class="text-secondary size-4" data-lucide="users"></i>
                        </div>
                        <h6 class="grow text-default-900">Subscribe</h6>
                        <p>3,352</p>
                        <div class="w-12 text-success text-end">18.9%</div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-orange-500/10 btn size-8">
                            <i class="text-orange-500 size-4" data-lucide="user-x-2"></i>
                        </div>
                        <h6 class="grow text-default-900">Unsubscribe</h6>
                        <p>85,745</p>
                        <div class="w-12 text-danger text-end">1.2%</div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-success/10 btn size-8">
                            <i class="text-success size-4" data-lucide="eye"></i>
                        </div>
                        <h6 class="grow text-default-900">Viewers</h6>
                        <p>85,745</p>
                        <div class="w-12 text-success text-end">11.6%</div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-default-950/10 btn size-8">
                            <i class="size-4" data-lucide="package-open"></i>
                        </div>
                        <h6 class="grow text-default-900">Opened</h6>
                        <p>85,745</p>
                        <div class="w-12 text-danger text-end">3.1%</div>
                    </li>
                    <li class="flex items-center gap-3 text-sm">
                        <div class="bg-info/10 btn size-8">
                            <i class="text-info size-4" data-lucide="user-x-2"></i>
                        </div>
                        <h6 class="grow text-default-900">Trial Period</h6>
                        <p>70,775</p>
                        <div class="w-12 text-danger text-end">22%</div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Subscription Distribution</h6>
            </div>
            <div class="card-body">
                <div id="subscriptionDistribution"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Traffic Source</h6>
                <a class="text-primary underline" href="#">See More</a>
            </div>
            <div class="card-body">
                <div class="flex flex-col gap-5">
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2 text-sm">
                            <h6 class="text-default-900">Google</h6>
                            <span class="text-default-500">54,963</span>
                        </div>
                        <div class="w-full h-3.5 rounded bg-default-200">
                            <div class="h-3.5 rounded bg-primary" style="width: 89%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2 text-sm">
                            <h6 class="text-default-900">Meta</h6>
                            <span class="text-default-500">30,478</span>
                        </div>
                        <div class="w-full h-3.5 rounded bg-default-200">
                            <div class="h-3.5 rounded bg-sky-500" style="width: 55%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2 text-sm">
                            <h6 class="text-default-900">Social Media</h6>
                            <span class="text-default-500">54,963</span>
                        </div>
                        <div class="w-full h-3.5 rounded bg-default-200">
                            <div class="h-3.5 rounded bg-warning" style="width: 81%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2 text-sm">
                            <h6 class="text-default-900">Direct Message</h6>
                            <span class="text-default-500">54,963</span>
                        </div>
                        <div class="w-full h-3.5 rounded bg-default-200">
                            <div class="h-3.5 rounded bg-success" style="width: 63%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between gap-4 mb-2 text-sm">
                            <h6 class="text-default-900">Others</h6>
                            <span class="text-default-500">54,963</span>
                        </div>
                        <div class="w-full h-3.5 rounded bg-default-200">
                            <div class="h-3.5 rounded bg-default-600" style="width: 25%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/dashboard-analytics.js'])
@endsection
