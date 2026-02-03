@extends('layouts.vertical', ['title' => 'Attendance'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Attendance'] )

    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="col-span-1">
            <div class="mb-5">
                <label class="inline-block card-title" for="deliveryStatusSelect">Select Employee</label>
                <select class="form-input" id="typeSelect" name="typeSelect">
                    <option value="">Select Employee</option>
                    <option value="Willie Torres">Willie Torres</option>
                    <option value="Patricia Garcia">Patricia Garcia</option>
                    <option value="Juliette Fecteau">Juliette Fecteau</option>
                    <option value="Thomas Hatfield">Thomas Hatfield</option>
                    <option value="Juliette Fecteau">Juliette Fecteau</option>
                    <option value="Nancy Reynolds">Nancy Reynolds</option>
                    <option value="Holly Kavanaugh">Holly Kavanaugh</option>
                    <option value="Jonas Frederiksen">Jonas Frederiksen</option>
                </select>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        <div class="mx-auto rounded-full size-20 bg-default-100">
                            <img alt="" class="h-20 rounded-full" src="/images/user/user-3.jpg"/>
                        </div>
                        <h6 class="mt-3 mb-1 text-base text-heading font-semibold"><a href="#">Willie Torres</a></h6>
                        <p class="text-default-500">Product Designer</p>
                    </div>
                    <div class="mt-5 overflow-x-auto">
                        <table class="w-full mb-0">
                            <tbody>
                            <tr>
                                <td class="py-2.5 text-default-500">Employee ID</td>
                                <td class="py-2.5 font-semibold">#TWE1001501</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Experience</td>
                                <td class="py-2.5 font-semibold">3 Year</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Joining Date</td>
                                <td class="py-2.5 font-semibold">05 Feb, 2020</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Total Hours (Years)</td>
                                <td class="py-2.5 font-semibold">953.8 Hrs</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Total Hours</td>
                                <td class="py-2.5 font-semibold">218.4 Hrs</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Regular Hours</td>
                                <td class="py-2.5 font-semibold">172 Hrs</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Overtime</td>
                                <td class="py-2.5 font-semibold">24 Hrs</td>
                            </tr>
                            <tr>
                                <td class="py-2.5 text-default-500">Holiday</td>
                                <td class="py-2.5 font-semibold">22.40 Hrs</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 col-span-1">
            <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn text-info bg-info/10 size-12">
                                <i class="size-6" data-lucide="clock"></i>
                            </div>
                            <div>
                                <h5 class="mb-1 text-base text-heading font-semibold">
                                    <span class="counter-value" data-target="187">187</span>
                                </h5>
                                <p class="text-default-500">Approved Hours</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn text-danger bg-danger/10 size-12">
                                <i class="size-6" data-lucide="x-octagon"></i>
                            </div>
                            <div class="">
                                <h5 class="mb-1 text-base text-heading font-semibold">
                                    <span class="counter-value" data-target="19">19</span>
                                </h5>
                                <p class="text-default-500">Rejected Hours</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center gap-3">
                            <div class="btn text-warning bg-warning/10 size-12">
                                <i class="size-6" data-lucide="refresh-cw"></i>
                            </div>
                            <div class="">
                                <h5 class="mb-1 text-base text-heading font-semibold">
                                    <span class="counter-value" data-target="32">32</span>
                                </h5>
                                <p class="text-default-500">Pending Hours</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="flex gap-3 items-center">
                        <div class="relative">
                            <input class="ps-11 form-input form-input-sm" placeholder="Search for...." type="email"/>
                            <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none ps-4">
                                <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
                            </div>
                        </div>
                        <input class="form-input form-input-sm" data-date-format="d M, Y" data-provider="flatpickr"
                               data-range-date="true" placeholder="Select Date" readonly="readonly" type="text"/>
                    </div>
                    <div class="flex gap-3 items-center">
                        <button
                            class="border btn btn-sm border-dashed border-danger text-danger bg-transparent ease-linear hover:bg-red-50"
                            type="button">
                            Reject All
                        </button>
                        <button class="btn btn-sm bg-primary text-white" type="button">
                            Approve All
                        </button>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-100 font-normal whitespace-nowrap">
                                    <tr class="text-sm text-default-800">
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Date</th>
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Check In</th>
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Check Out</th>
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Meal Break&gt;
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Work Hours</th>
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Overtime</th>
                                        <th class="px-3.5 py-3 font-medium text-start" scope="col">Action</th>
                                        </th></tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">13 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Fri</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:23 AM</td>
                                        <td class="px-3.5 py-3 text-sm">07:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">1.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.00 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            12 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Thu</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:28 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:46 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.45 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            11 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Wed</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">09:00 AM</td>
                                        <td class="px-3.5 py-3 text-sm">06:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.50 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.35 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            10 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Tue</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">09:15 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.35 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">7.55 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            09 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Mon</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:28 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:46 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.45 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            06 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Fri</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">09:00 AM</td>
                                        <td class="px-3.5 py-3 text-sm">06:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.50 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.35 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            05 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Thu</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:28 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:46 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.45 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            04 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Wed</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:28 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:46 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.45 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            03 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Tue</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">08:23 AM</td>
                                        <td class="px-3.5 py-3 text-sm">07:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">1.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">8.00 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.00 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal whitespace-nowrap">
                                        <td class="px-3.5 py-3 text-sm">
                                            02 Oct, 2023
                                            <span
                                                class="py-0.5 px-2.5 border border-default-200 text-default-600 rounded">Mon</span>
                                        </td>
                                        <td class="px-3.5 py-3 text-sm">09:15 AM</td>
                                        <td class="px-3.5 py-3 text-sm">05:00 PM</td>
                                        <td class="px-3.5 py-3 text-sm">0.35 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">7.55 Hrs</td>
                                        <td class="px-3.5 py-3 text-sm">0.15 Hrs</td>
                                        <td class="px-3.5 py-3">
                                            <div class="flex items-center gap-2">
                                                <a class="btn size-8 bg-success/10 hover:bg-success hover:text-white text-success"
                                                   href="#">
                                                    <i class="size-4" data-lucide="check"></i>
                                                </a>
                                                <a class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                                   href="#">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-default-500 text-sm">Showing <b>10</b> of <b>15</b> Results</p>
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
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
