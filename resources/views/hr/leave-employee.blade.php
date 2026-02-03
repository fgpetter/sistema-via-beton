@extends('layouts.vertical', ['title' => 'Leave Manage (Employee)'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Leave Manage (Employee)'] )

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-danger bg-danger/10 size-12">
                        <i class="size-6" data-lucide="file-bar-chart-2"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-heading font-semibold">
                            <span class="counter-value text-base" data-target="23">23</span>
                        </h5>
                        <p class="text-default-500">Total Leave Balance</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-secondary bg-secondary/10 size-12">
                        <i class="size-6" data-lucide="stethoscope"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="4">4</span>
                        </h5>
                        <p class="text-default-500">Medical Leave</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-success bg-success/10 size-12">
                        <i class="size-6" data-lucide="calendar-days"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="12">12</span>
                        </h5>
                        <p class="text-default-500">Annual Leave</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-info bg-info/10 size-12">
                        <i class="size-6" data-lucide="anchor"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="11">11</span>
                        </h5>
                        <p class="text-default-500">Remaining Leave</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <div class="relative">
                    <input class="ps-11 form-input form-input-sm" placeholder="Search for...." type="email"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
                    </div>
                </div>
                <button class="btn btn-sm bg-primary text-white">
                    <i class="size-3.5 me-1" data-lucide="download"></i> Export
                </button>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-default-200">
                                <thead class="bg-default-150">
                                <tr class="text-sm font-normal whitespace-nowrap text-default-500">
                                    <th class="px-3.5 py-3 text-start" scope="col">
                                        #
                                    </th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Leave Type</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Reason</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">No Of Days</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">From</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">to</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Approved By</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                    <th class="px-3.5 py-3 text-end" scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">01</td>
                                    <td class="px-3.5 py-2.5 text-sm">Medical Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Hospital</td>
                                    <td class="px-3.5 py-2.5 text-sm">02</td>
                                    <td class="px-3.5 py-2.5 text-sm">11 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">12 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">02</td>
                                    <td class="px-3.5 py-2.5 text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Family Function</td>
                                    <td class="px-3.5 py-2.5 text-sm">01</td>
                                    <td class="px-3.5 py-2.5 text-sm">07 Sept, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">07 Sept, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Admin</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 flex items-center justify-end gap-2">
                                        <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white transition-all text-default-600"
                                           href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">03</td>
                                    <td class="px-3.5 py-2.5 text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Holiday</td>
                                    <td class="px-3.5 py-2.5 text-sm">06</td>
                                    <td class="px-3.5 py-2.5 text-sm">11 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">16 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Admin</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger">Declined</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">04</td>
                                    <td class="px-3.5 py-2.5 text-sm">Sick Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Attend Birthday party</td>
                                    <td class="px-3.5 py-2.5 text-sm">01</td>
                                    <td class="px-3.5 py-2.5 text-sm">15 July, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">15 July, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">05</td>
                                    <td class="px-3.5 py-2.5 text-sm">Sick Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Personal</td>
                                    <td class="px-3.5 py-2.5 text-sm">02</td>
                                    <td class="px-3.5 py-2.5 text-sm">19 Aug, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">20 Aug, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger">Declined</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">06</td>
                                    <td class="px-3.5 py-2.5 text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Family Function</td>
                                    <td class="px-3.5 py-2.5 text-sm">01</td>
                                    <td class="px-3.5 py-2.5 text-sm">14 Feb, 2022</td>
                                    <td class="px-3.5 py-2.5 text-sm">14 Feb, 2022</td>
                                    <td class="px-3.5 py-2.5 text-sm">Admin</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">07</td>
                                    <td class="px-3.5 py-2.5 text-sm">Medical Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Medical Emergency</td>
                                    <td class="px-3.5 py-2.5 text-sm">04</td>
                                    <td class="px-3.5 py-2.5 text-sm">23 Jan, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">26 Jan, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 flex items-center justify-end gap-2">
                                        <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white transition-all text-default-600"
                                           href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">08</td>
                                    <td class="px-3.5 py-2.5 text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Personal</td>
                                    <td class="px-3.5 py-2.5 text-sm">02</td>
                                    <td class="px-3.5 py-2.5 text-sm">16 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">17 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger">Declined</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">09</td>
                                    <td class="px-3.5 py-2.5 text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Holiday</td>
                                    <td class="px-3.5 py-2.5 text-sm">05</td>
                                    <td class="px-3.5 py-2.5 text-sm">29 Nov, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">03 Dec, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Admin</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap">
                                    <td class="px-3.5 py-2.5 text-sm">10</td>
                                    <td class="px-3.5 py-2.5 text-sm">Sick Leave</td>
                                    <td class="px-3.5 py-2.5 text-sm">Going to Hospital</td>
                                    <td class="px-3.5 py-2.5 text-sm">01</td>
                                    <td class="px-3.5 py-2.5 text-sm">15 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">15 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 text-sm">Paula Keenan</td>
                                    <td class="px-3.5 py-2.5">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 text-end">
                                        <a class="btn size-8 bg-primary/20 hover:bg-primary text-primary hover:text-white"
                                           href="#">
                                            <i class="iconify lucide--info size-4"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <p class="text-default-500 text-sm">Showing <b>10</b> of <b>17</b> Results</p>
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
@endsection

@section('scripts')

@endsection
