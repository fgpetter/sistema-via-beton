@extends('layouts.vertical', ['title' => 'Email'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Dashboards', 'title' => 'Email Analytics'])

    <div class="mb-5">
        <div class="card">
            <div class="card-body">
                <div
                    class="grid grid-cols-1 gap-5 divide-y md:divide-x md:divide-y-0 md:grid-cols-2 lg:grid-cols-4 divide-default-200">
                    <div class="py-5 md:pe-5 pe-0 md:border-e md:border-b-0 border-b border-default-200">
                        <div class="grid grid-cols-3 mb-4">
                            <div class="text-default-500 text-sm w-36 shrink-0">
                                <div class="flex items-center gap-1.5 mb-6">
                                    <i class="size-4" data-lucide="rocket"></i>
                                    <p class="uppercase">sent</p>
                                </div>
                                <h5 class="text-default-800 text-lg font-semibold"><span class="counter-value"
                                        data-target="1452">1,452</span>
                                </h5>
                            </div>
                            <div class="col-span-2">
                                <div id="sentEmail"></div>
                            </div>
                        </div>
                        <span class="text-default-500">238 Emails (Monthly)</span>
                    </div>
                    <div class="md:p-5 px-0 py-5 md:border-e md:border-b-0 border-b border-default-200">
                        <div class="grid grid-cols-3 mb-4">
                            <div class="text-default-500 text-sm w-36 shrink-0">
                                <div class="flex items-center gap-1.5 mb-6">
                                    <i class="size-4" data-lucide="mouse-pointer-click"></i>
                                    <p class="uppercase">Open Rate</p>
                                </div>
                                <h5 class="text-default-800 text-lg font-semibold"><span data-target="92.74">92.74</span>%
                                </h5>
                            </div>
                            <div class="col-span-2">
                                <div id="openRate"></div>
                            </div>
                        </div>
                        <span class="text-default-500">60 Opened (Monthly)</span>
                    </div>
                    <div class="md:p-5 px-0 py-5 md:border-e md:border-b-0 border-b border-default-200">
                        <div class="grid grid-cols-3 mb-4">
                            <div class="text-default-500 text-sm w-36 shrink-0">
                                <div class="flex items-center gap-1.5 mb-6">
                                    <i class="size-4" data-lucide="square-mouse-pointer"></i>
                                    <p class="uppercase">Open Rate</p>
                                </div>
                                <h5 class="text-default-800 text-lg font-semibold"><span data-target="3.79">3.79</span>%
                                </h5>
                            </div>
                            <div class="col-span-2">
                                <div id="clickRate"></div>
                            </div>
                        </div>
                        <span class="text-default-500">29 Clicks (Monthly)</span>
                    </div>
                    <div class="py-5 md:ps-5 ps-0">
                        <div class="grid grid-cols-3 mb-4">
                            <div class="text-default-500 text-sm w-36 shrink-0">
                                <div class="flex items-center gap-1.5 mb-6">
                                    <i class="size-4" data-lucide="goal"></i>
                                    <p class="uppercase">Clicks Through</p>
                                </div>
                                <h5 class="text-default-800 text-lg font-semibold"><span data-target="4.06">4.06</span>%
                                </h5>
                            </div>
                            <div class="col-span-2">
                                <div id="clickThrough"></div>
                            </div>
                        </div>
                        <span class="text-default-500">29 Click Through (Monthly)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-default-500">Delivered Rate</p>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">Taking the number of delivered emails and dividing it by the total number of
                                emails sent
                            </span>
                        </button>
                    </div>
                </div>
                <h5 class="mb-4 text-default-800 text-lg font-semibold"><span class="" data-target="100">100</span>%
                </h5>
                <div class="w-87 h-20" id="deliveredRate"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-default-500">Hard Bounce Rate</p>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xl"
                                role="tooltip">
                                Taking the number of delivered emails and dividing it by the total number of
                                emails sent
                            </span>
                        </button>
                    </div>
                </div>
                <h5 class="mb-4 text-default-800 text-lg font-semibold"><span class="" data-target="89">89</span>%
                </h5>
                <div class="w-87 h-20" id="hardBounceRate"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-default-500">Unsubscribed Rate</p>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">
                                Taking the number of delivered emails and dividing it by the total number of
                                emails sent
                            </span>
                        </button>
                    </div>
                </div>
                <h5 class="mb-4 text-default-800 text-lg font-semibold"><span class="" data-target="33">33</span>%
                </h5>
                <div class="w-87 h-20" id="unsubscribedRate"></div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center justify-between mb-3">
                    <p class="text-default-500">Spam Report Rate</p>
                    <div class="hs-tooltip [--placement:top]">
                        <button class="hs-tooltip-toggle" type="button">
                            <i class="size-4 text-default-500 mt-2" data-lucide="info"></i>
                            <span
                                class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible z-30 py-1 px-2 bg-default-900 text-xs font-medium text-default-100 rounded-md shadow-2xs"
                                role="tooltip">
                                Taking the number of delivered emails and dividing it by the total number of
                                emails sent
                            </span>
                        </button>
                    </div>
                </div>
                <h5 class="mb-4 text-default-800 text-lg font-semibold"><span class=""
                        data-target="11.8">11.8</span>%
                </h5>
                <div class="w-87 h-20" id="spanReportRate"></div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Email Data</h6>
                    <div>
                        <select class="form-input form-input-sm">
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
                    <div id="emailDataChart"></div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Email Marketing</h6>
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150"
                            hs-dropdown-placement="bottom-end" type="button">
                            <i class="iconify lucide--ellipsis size-4 text-default-600"></i>
                        </button>
                        <div aria-labelledby="hs-dropdown-custom-icon-trigger" aria-orientation="vertical"
                            class="hs-dropdown-menu" role="menu">
                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                href="#">
                                This Year
                            </a>
                            <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                href="#">
                                Last Year
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="emailMarketingChart"></div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="mb-3.5 text-default-800 text-xl leading-relaxed font-semibold">Experience Our Fresh Email
                        Composition Interface</h4>
                    <p class="mb-5 text-default-500">A local-part, the symbol @, and a domain, which may be a domain
                        name or an IP address enclosed in brackets.
                    </p>
                    <a class="mb-3 btn bg-primary text-white transition-all"
                        href="{{ route('second', ['apps', 'mailbox']) }}">Compose Email</a>
                    <div class="flex justify-end">
                        <img alt="" class="-scale-x-100 h-48" src="/images/email-dashboard.png" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Email Performance</h6>
            <div class="flex gap-3 items-center">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email" />
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-3.5 text-default-500" data-lucide="search"></i>
                    </div>
                </div>
                <button class="btn btn-sm bg-primary text-white">
                    <i class="size-4" data-lucide="download"></i>Export
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
                                    <th class="py-3 px-4 pe-0 text-start" scope="col">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Email</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Create Date</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Open Rate (%)</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Click Through (%)</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Click Rate (%)</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Unsubscribed (%)</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Bounce (%)</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">TSpam(%)</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Adverting &amp; Marketing Agencies
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05 Aug, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.65%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.66%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.14%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.19%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.29%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.03%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Automotive &amp; Aerospace</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20 Sep, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20.13%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">3.44%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.03%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.18%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.18%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Education</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">04 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.74%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.80%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.94%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.17%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.35%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.02%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Financial Services</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Feb, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.23%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.72%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.79%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.16%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.30%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Food &amp; Beverage</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">26 Nov, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">15.48%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.69%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">10.69%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.11%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.63%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Healthcare Services</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">19 Jul, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">19.12%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.98%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">15.11%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.17%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.08%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Professional Services</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.14%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.39%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">12.92%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.17%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.10%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Logistics &amp; Wholesale</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.50%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.20%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.84%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.15%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.40%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Real Estate Agents &amp; Brokers
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18.06%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.02%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11.51%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.22%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.18%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.00%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Nonprofit</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20.39%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.66%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">12.99%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.17%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">1.09%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.01%</td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="py-2.5 ps-4">
                                        <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Retail</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.98%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">2.25%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14.82%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.12%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.69%</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0.01%</td>
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
    @vite(['resources/js/pages/dashboard-email.js'])
@endsection
