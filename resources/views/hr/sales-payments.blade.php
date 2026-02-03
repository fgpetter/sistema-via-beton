@extends('layouts.vertical', ['title' => 'Payments'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Payments'] )

    <div class="card">
        <div class="card-header">
            <div class="flex gap-3">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email"/>
                    <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                        <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
                    </div>
                </div>
                <input class="form-input form-input-sm" data-date-format="d M, Y" data-provider="flatpickr"
                       data-range-date="true" id="dateRangeFilterInput" placeholder="Select date" type="text"/>
            </div>
            <div>
                <select class="form-input form-input-sm" id="dateRangeFilterInput" placeholder="Select date"
                        type="text">
                    <option value="Accepted">Failed</option>
                    <option selected="" value="Declined">Paid</option>
                    <option value="Expired">Pending</option>
                </select>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                            <tr class="text-sm font-normal text-default-500">
                                <th class="px-3.5 py-3 text-start" scope="col">Payment ID</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Membership Plan</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Payment Type</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Username</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Amount</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021320</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Regular License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 02 July, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Infra Teach</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$2,403</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">
<span class="size-1.5 me-1 rounded-full bg-success inline-block"></span>Paid
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021321</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Extended License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 08 Nov, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Credit Card</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Kim Broberg</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,341</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">
<span class="size-1.5 me-1 rounded-full bg-warning inline-block"></span>Pending
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021322</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Extended License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Aug, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Bank Transfer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Everett Moore</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$816.21</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">
<span class="size-1.5 me-1 rounded-full bg-danger inline-block"></span>Failed
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021323</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Regular License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 20 Sep, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Omari Welch</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,184</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">
<span class="size-1.5 me-1 rounded-full bg-success inline-block"></span>Paid
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021324</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Regular License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 07 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Debit Card</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Susana Dooley</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$5,463</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">
<span class="size-1.5 me-1 rounded-full bg-success inline-block"></span>Paid
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021325</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Regular License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 18 Dec, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Paul Gerhold</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$3,463</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">
<span class="size-1.5 me-1 rounded-full bg-warning inline-block"></span>Pending
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021326</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Extended License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Jan, 2024</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Bank Transfer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Lucie Beahan</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,543</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">
<span class="size-1.5 me-1 rounded-full bg-danger inline-block"></span>Failed
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021327</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Regular License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02 Feb, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Jose White</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$4,177</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">
<span class="size-1.5 me-1 rounded-full bg-success inline-block"></span>Paid
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021328</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Extended License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Dec, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Debit Card</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Jonas Frederiksen</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$2,307</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">
<span class="size-1.5 me-1 rounded-full bg-warning inline-block"></span>Pending
                                                    </span>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#">#TWP10021329</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Extended License</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01 Jan, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PayPal</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Stephen Tillman</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$543.99</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
<span class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">
<span class="size-1.5 me-1 rounded-full bg-success inline-block"></span>Paid
                                                    </span>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>8</b> of <b>10</b> Results</p>
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
    @vite(['resources/js/components/timepicker.js'])
@endsection
