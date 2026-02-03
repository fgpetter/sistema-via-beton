@extends('layouts.vertical', ['title' => 'index'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Dashboards', 'title' => 'Ecommerce'])

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="card-body relative overflow-hidden bg-zinc-900 rounded-md mb-5">
                <div class="relative z-10 grid grid-cols-12 items-center">
                    <div class="lg:col-span-8 col-span-12">
                        <h5 class="mb-3 text-lg text-white">Welcome Paula Keenan 🎉</h5>
                        <p class="mb-5 text-white/70 text-sm">An ecommerce dashboard has just that purpose. It provides
                            your ecommerce team with a clear overview of key financial and website KPIs at any time.</p>
                        <button class="btn bg-primary text-white" type="button">Take a Product</button>
                    </div>
                    <div class="col-span-4 ms-auto lg:block hidden">
                        <img alt="" class="h-40" src="/images/dashboard.png" />
                    </div>
                </div>
                <div class="absolute inset-0">
                    <svg class="size-full" preserveaspectratio="none" version="1.1" viewbox="0 0 1440 560"
                        xmlns="http://www.w3.org/2000/svg" xmlns:svgjs="http://svgjs.dev/svgjs"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g fill="none" mask='url("#SvgjsMask1000")'>
                            <use x="0" xlink:href="#SvgjsSymbol1007" y="0"></use>
                            <use x="720" xlink:href="#SvgjsSymbol1007" y="0"></use>
                        </g>
                        <defs>
                            <mask id="SvgjsMask1000">
                                <rect fill="#ffffff" height="560" width="1440"></rect>
                            </mask>
                            <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                            <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                            <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                            <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                            <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                            <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                        </defs>
                        <symbol id="SvgjsSymbol1007">
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1003" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1003" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1004" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1003" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="150" xlink:href="#SvgjsPath1006" y="330">
                            </use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1004" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="210" xlink:href="#SvgjsPath1006"
                                y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1005" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="210" xlink:href="#SvgjsPath1006"
                                y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1003" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="270" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="330" xlink:href="#SvgjsPath1006"
                                y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="330" xlink:href="#SvgjsPath1006"
                                y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1003" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1004" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1004" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1003" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1005" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1004" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="510" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1005" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="570" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1005" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="630" xlink:href="#SvgjsPath1006"
                                y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="630" xlink:href="#SvgjsPath1006"
                                y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="690" xlink:href="#SvgjsPath1006"
                                y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="570"></use>
                        </symbol>
                    </svg>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-primary/10">
                            <i class="size-6 text-primary" data-lucide="wallet-2"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">$
                            <span data-target="236.18">236.18</span>k
                        </h5>
                        <p class="text-center text-sm text-default-500">Total Revenue</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-info/10">
                            <i class="size-6 text-info" data-lucide="package"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">
                            <span data-target="13,461">13,461</span>
                        </h5>
                        <p class="text-center text-sm text-default-500">Total Orders</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-success/10">
                            <i class="size-6 text-success" data-lucide="truck"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">
                            <span data-target="17,150">17,150</span>
                        </h5>
                        <p class="text-center text-sm text-default-500">Delivered</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-danger/10">
                            <i class="size-6 text-danger" data-lucide="package-x"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">
                            <span data-target="3,519">3,519</span>
                        </h5>
                        <p class="text-center text-sm text-default-500">Cancelled </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Order Statistics</h6>
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="#">View All
                        <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div id="orderStatisticsChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Sales Revenue Overview</h6>
                    <div class="relative">
                        <input class="form-input form-input-sm ps-9" data-date-format="d M, Y" data-provider="flatpickr"
                            data-range-date="true" placeholder="Select Date" type="text" />
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <i class="size-4 text-default-500" data-lucide="calendar-range"></i>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid md:grid-cols-4 grid-cols-1 mb-3 gap-4">
                        <div class="col-span-1">
                            <div class="flex items-center gap-3">
                                <div class="btn size-12 bg-secondary/10">
                                    <i class="text-secondary size-6" data-lucide="bar-chart"></i>
                                </div>
                                <div>
                                    <p class="mb-1.5 text-default-500 text-sm">Total Sales</p>
                                    <h5 class="text-base font-semibold text-default-800">$<span
                                            data-target="1517.36">1,517.36</span>k
                                    </h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-1">
                            <div class="flex items-center gap-3">
                                <div class="btn size-12 bg-success/10">
                                    <i class="text-success size-6" data-lucide="trending-up"></i>
                                </div>
                                <div>
                                    <p class="mb-1.5 text-default-500 text-sm">Total Profit</p>
                                    <h5 class="text-base font-semibold text-default-800">$<span
                                            data-target="746.84">746.84</span>k
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="salesRevenueOverview"></div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card mb-5">
                <div class="card-header">
                    <h6 class="card-title">Traffic Resources</h6>
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="#">View Status
                        <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="card-body">
                    <div class="grid md:grid-cols-12 grid-cols-1">
                        <div class="rounded-md md:col-span-7 col-span-1">
                            <div dir="rtl" id="trafficResourcesChart"></div>
                        </div>
                        <div class="md:col-span-5 col-span-1">
                            <div class="flex flex-col gap-3">
                                <div class="flex items-center gap-2">
                                    <div class="bg-green-500 size-3"
                                        style="clip-path: polygon(50% 0%, 0% 100%, 100% 100%);"></div>
                                    <p class="text-green-500">Search Engine (22%)</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="bg-purple-500 size-3"
                                        style="clip-path: polygon(50% 0%, 0% 100%, 100% 100%);"></div>
                                    <p class="text-purple-500">Referral (34%)</p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="bg-sky-500 size-3"
                                        style="clip-path: polygon(50% 0%, 0% 100%, 100% 100%);"></div>
                                    <p class="text-sky-500">Direct (44%)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between mb-2">
                        <h5 class="text-lg text-default-900 font-semibold">
                            <span data-target="1596">1,596</span>
                        </h5>
                        <span
                            class="px-2.5 py-0.5 text-xs rounded border bg-transparent border-danger/50 text-danger flex items-center gap-1">
                            <i class="size-3" data-lucide="trending-down"></i>
                            6.8%
                        </span>
                    </div>
                    <h6 class="font-semibold text-default-900">Monthly Orders Goal (20000+)</h6>
                    <div>
                        <div class="flex items-center justify-between mt-5 mb-2">
                            <p class="text-default-500 text-sm">Total Orders</p>
                            <h6 class="mb-0 text-primary">85%</h6>
                        </div>
                        <div class="w-full bg-default-200 rounded-full h-2.54">
                            <div class="bg-primary h-2.5 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Product Orders</h6>
                <div class="flex gap-3 items-center">
                    <div class="relative">
                        <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email" />
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <i class="size-3.5 text-default-500" data-lucide="search"></i>
                        </div>
                    </div>
                    <button class="btn btn-sm bg-primary text-white">
                        <i class="size-3.5 me-1" data-lucide="download"></i>Export
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
                                        <th class="px-3.5 py-3 text-start" scope="col">#</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Order ID</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Customer Name</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Location</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Order Date</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Payments</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Quantity</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Price</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Total Amount</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                        <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-default-200">
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100365</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Marie Prohaska</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Germany</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">08 Jun, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Credit Card</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$146.99</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$749.95</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100366</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Jaqueline Hammes</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">France</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 July, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Paypal</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$450.00</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$900.00</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-info/10 text-info border border-info/30">Shipping</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100367</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Marlene Hirthe</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Argentina</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Aug, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Visa Card</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$147.23</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$294.46</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-secondary/10 text-secondary border border-secondary/30">New</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">04</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100368</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Reagan Larson</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Belgium</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">28 Nov, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">American Express</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$579.12</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$579.12</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100369</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Glennie Langosh</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Australia</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Oct, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">American Express</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$349.00</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$349.00</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/10 text-warning border border-warning/30">Pending</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">06</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100370</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Rickie Cremin</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">United States</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16 Feb, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">COD</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$89.49</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$268.47</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Delivered</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">#TWT5015100371</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Domenic Tromp</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Afghanistan</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Jan, 2024</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$739.79</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,479.58</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-secondary/10 text-secondary border border-secondary/30">New</span>
                                        </td>
                                        <td class="px-3.5 py-2.5">
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-150 hover:bg-default-600 text-default-500 hover:text-white"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu" role="menu">
                                                    <div>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="eye"></i>
                                                            Overview
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="edit"></i>
                                                            Edit
                                                        </a>
                                                        <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            <i class="size-3" data-lucide="trash-2"></i>
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
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
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Customer Service</h6>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn size-7.5 text-sm font-semibold rounded-lg hover:bg-default-150"
                        hs-dropdown-placement="bottom-end" type="button">
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
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <p class="text-default-500 text-sm">28% of the Goal Reached ($25k)</p>
                    </div>
                    <div class="w-full h-2 rounded-full bg-default-200">
                        <div class="h-2 bg-success rounded-full" style="width: 28%"></div>
                    </div>
                    <div class="flex mt-3">
                        <div class="flex items-center gap-2">
                            <div>
                                <i class="size-4 text-default-800" data-lucide="calendar-days"></i>
                            </div>
                            <p class="mb-0 text-default-600">This Month:
                                <span class="font-medium text-default-800">$13,741</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div>
                    <h6 class="mt-4 mb-3 text-default-800 text-sm font-semibold">Top Customer</h6>
                    <div class="divide-y divide-default-200">
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3 py-2.25">
                                <div class="size-8 rounded-full bg-default-100">
                                    <img alt="" class="size-8 rounded-full" src="/images/user/avatar-2.png" />
                                </div>
                                <div>
                                    <h6 class="font-medium text-default-800 mb-1">Urrie Arthur</h6>
                                    <p class="text-default-500 font-normal">arthur@tailwick.com</p>
                                </div>
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800">$2,452</h6>
                            </div>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3 py-2.25">
                                <div class="size-8 rounded-full bg-default-100">
                                    <img alt="" class="size-8 rounded-full" src="/images/user/avatar-3.png" />
                                </div>
                                <div>
                                    <h6 class="font-medium text-default-800 mb-1">Natalie Christy</h6>
                                    <p class="text-default-500 font-normal">natalie@tailwick.com</p>
                                </div>
                            </div>
                            <h6 class="font-semibold text-default-800">$1,893</h6>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3 py-2.25">
                                <div class="size-8 rounded-full bg-default-100">
                                    <img alt="" class="size-8 rounded-full" src="/images/user/avatar-4.png" />
                                </div>
                                <div>
                                    <h6 class="font-medium text-default-800 mb-1">Laurie Jackson</h6>
                                    <p class="text-default-500 font-normal">jackson@tailwick.com</p>
                                </div>
                            </div>
                            <h6 class="font-semibold text-default-800">$1,196</h6>
                        </div>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-3 pt-2">
                                <div class="size-8 rounded-full bg-default-100">
                                    <img alt="" class="size-8 rounded-full" src="/images/user/avatar-5.png" />
                                </div>
                                <div>
                                    <h6 class="font-medium text-default-800 mb-1">Michael Torres</h6>
                                    <p class="text-default-500 font-normal">torres@tailwick.com</p>
                                </div>
                            </div>
                            <h6 class="font-semibold text-default-800">$976</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Sales This Month</h6>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn size-7.5 text-sm font-semibold rounded-lg hover:bg-default-150"
                        hs-dropdown-placement="bottom-end" type="button">
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
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center rounded-md size-12 bg-success/10">
                        <i class="size-6 text-success" data-lucide="trending-up"></i>
                    </div>
                    <div class="text-sm">
                        <p class="mb-1 text-default-500">Total Profit</p>
                        <h5 class="font-semibold text-default-800">$<span data-target="746.84">746.84</span>k</h5>
                    </div>
                </div>
                <div id="salesThisMonthChart"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Top Selling Products</h6>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle bt size-7.5 text-sm font-semibold rounded-lg hover:bg-default-150"
                        hs-dropdown-placement="bottom-end" type="button">
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
                <div class="flex flex-col gap-5">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3 whitespace-nowrap">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-02.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 mb-1 text-sm">Mesh
                                    Ergonomic Black Chair</h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800 text-sm">798</h6>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-03.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 text-sm mb-1">
                                    Fastcolors Typography Men </h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800 text-sm">695</h6>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-04.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 text-sm mb-1">Mesh
                                    Ergonomic Green Chair </h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800">985</h6>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-05.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 text-sm mb-1">Techel
                                    Black Bluetooth Soundbar </h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800">813</h6>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-06.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 text-sm mb-1">Bovet
                                    Fleurier AIFSQ029</h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800"> 915</h6>
                        </div>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-3">
                            <div class="flex items-center justify-center rounded-md size-10 bg-default-100">
                                <img alt="" class="h-6" src="/images/product/img-03.png" />
                            </div>
                            <div>
                                <h6 class="font-semibold text-default-800 md:w-full truncate w-43 text-sm mb-1">
                                    Fastcolors Typography Men</h6>
                                <div class="flex items-center text-yellow-500 gap-0.5">
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                    <i class="fill-yellow-500 size-3.5" data-lucide="star-half"></i>
                                </div>
                            </div>
                        </div>
                        <div class="flex gap-1.5 items-center">
                            <i class="size-4 text-default-500" data-lucide="shopping-cart"></i>
                            <h6 class="font-semibold text-default-800"> 785</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h6 class="card-title">Audience</h6>
                <div class="hs-dropdown relative inline-flex">
                    <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle bt size-7.5 text-sm font-semibold rounded-lg hover:bg-default-150"
                        hs-dropdown-placement="bottom-end" type="button">
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
                <div class="apex-charts min-h-auto" id="audienceChart"></div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/dashboard-ecommerce.js'])
    @vite(['resources/js/components/timepicker.js'])
@endsection
