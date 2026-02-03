@extends('layouts.vertical', ['title' => 'HR'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Dashboards', 'title' => 'HR'])

    <div class="grid lg:grid-cols-4 grid-cols-1 mb-5 gap-5">
        <div class="lg:col-span-2">
            <h5 class="mb-2 text-xl text-default-800 font-semibold">Welcome Paula Keenan 🎉</h5>
            <p>
                The salary of
                <a class="underline text-default-900" href="#">Glennie Langosh</a>is pending since 05 Dec, 2023. the
                documentation of the tasks, workflows, and activities
                that make up a process managed by the HR or People Ops team.
                <a class="text-danger" href="#">Learn More</a>
            </p>
        </div>
        <div class="lg:col-start-4">
            <div class="card">
                <div class="card-body">
                    <div class="grid grid-cols-3">
                        <div class="px-4 text-center border-e border-default-200 text-sm">
                            <h6 class="mb-1 font-bold">
                                <span class="counter-value text-default-800" data-target="36">36</span>
                            </h6>
                            <p class="text-default-500">Absent</p>
                        </div>
                        <div class="px-4 text-center border-e border-default-200 text-sm">
                            <h6 class="mb-1 font-bold">
                                <span class="counter-value text-default-800" data-target="465">465</span>
                            </h6>
                            <p class="text-default-500">Attendance</p>
                        </div>
                        <div class="px-4 text-center text-sm">
                            <h6 class="mb-1 font-bold">
                                <span class="counter-value text-default-800" data-target="50">50</span>
                            </h6>
                            <p class="text-default-500">Late</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="col-span-1">
            <div class="grid md:grid-cols-2 grid-cols-1 gap-5">
                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-4">
                            <div class="col-span-3">
                                <p class="text-base text-default-500 font-medium">Total Employee</p>
                                <h5 class="text-3xl font-medium mt-4"><span data-target="615">615</span></h5>
                            </div>
                            <div>
                                <div id="totalEmployee"></div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between gap-3 mt-8">
                            <p class="font-medium text-sm text-default-600">
                                <span class="font-medium text-success">15%</span> Increase
                            </p>
                            <p class="font-semibold text-base text-default-400">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-4">
                            <div class="col-span-3">
                                <p class="text-base text-default-500 font-medium">Total Application</p>
                                <h5 class="text-3xl font-medium mt-4"><span data-target="174">174</span></h5>
                            </div>
                            <div id="totalApplication"></div>
                        </div>
                        <div class="flex items-center justify-between gap-3 mt-8">
                            <p class="font-medium text-sm text-default-600">
                                <span class="font-medium text-success">26%</span> Increase
                            </p>
                            <p class="font-semibold text-base text-default-400">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-4">
                            <div class="col-span-3">
                                <p class="text-base text-default-500 font-medium">Hired Candidates</p>
                                <h5 class="text-3xl font-medium mt-4"><span data-target="64">64</span></h5>
                            </div>
                            <div id="hiredCandidates"></div>
                        </div>
                        <div class="flex items-center justify-between gap-3 mt-8">
                            <p class="font-medium text-sm text-default-600">
                                <span class="font-medium text-danger">0.5%</span> Increase
                            </p>
                            <p class="font-semibold text-base text-default-400">This Month</p>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="grid grid-cols-4">
                            <div class="col-span-3">
                                <p class="text-base text-default-500 font-medium">Rejected Candidates</p>
                                <h5 class="text-3xl font-medium mt-4"><span data-target="110">110</span></h5>
                            </div>
                            <div id="rejectedCandidates"></div>
                        </div>
                        <div class="flex items-center justify-between gap-3 mt-8">
                            <p class="font-medium text-sm text-default-600">
                                <span class="font-medium text-danger">16%</span> Increase
                            </p>
                            <p class="font-semibold text-base text-default-400">This Month</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-body">
                    <div class="flex justify-between">
                        <h6 class="card-title">Application Received</h6>
                        <div class="flex gap-2">
                            <div class="btn size-7.5 bg-primary rounded text-white text-xs">
                                All
                            </div>
                            <div
                                class="btn size-7.5 bg-primary/20 hover:bg-primary hover:text-white rounded text-primary text-xs">
                                1M
                            </div>
                            <div
                                class="btn size-7.5 bg-primary/20 hover:bg-primary hover:text-white rounded text-primary text-xs">
                                6M
                            </div>
                            <div
                                class="btn size-7.5 bg-primary/20 hover:bg-primary hover:text-white rounded text-primary text-xs">
                                1Y
                            </div>
                        </div>
                    </div>
                    <div id="applicationReceivedChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="lg:col-span-3 col-span-1">
            <div class="card mb-5">
                <div class="card-header">
                    <h6 class="card-title">Employee Performance</h6>
                    <div class="flex gap-3 items-center">
                        <div class="relative">
                            <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email" />
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                                <i class="size-4 text-default-500" data-lucide="search"></i>
                            </div>
                        </div>
                        <button class="btn btn-sm border-dashed border-primary hover:bg-primary/20 text-primary">
                            <i class="size-4 me-1" data-lucide="download"></i>Export
                        </button>
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                        <tr class="text-default-600">
                                            <th class="py-3 px-4 text-start pe-0" scope="col">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">ID</th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Name
                                            </th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">
                                                Designation
                                            </th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">
                                                Performance
                                            </th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Status
                                            </th>
                                            <th class="px-3.5 py-3 text-start text-sm font-medium" scope="col">Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        <tr class="text-default-800 text-sm whitespace-nowrap">
                                            <td class="py-3.5 ps-4">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </td>
                                            <td class="px-3.5 py-2">TW-1001</td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    <img alt="" class="bg-green-100 size-10 rounded-full"
                                                        src="/images/user/avatar-10.png" />
                                                    <div class="text-sm">
                                                        <h6 class="font-semibold mb-0.5">Kristen Redden</h6>
                                                        <p class="text-default-500">kredden@tailwick.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-2.5">Designer</td>
                                            <td class="px-3.5 py-2.5 text-green-700">Good</td>
                                            <td class="px-3.5 py-2.5">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Active</span>
                                            </td>
                                            <td class="px-3.5 py-2.5 text-start">
                                                <span class="inline-flex justify-start gap-2.5">
                                                    <a class="btn size-8 bg-default-100 hover:bg-blue-100 text-default-600 hover:text-primary"
                                                        href="#">
                                                        <i class="size-4" data-lucide="pencil"></i>
                                                    </a>
                                                    <a class="btn size-8 bg-default-100 hover:bg-red-100 text-default-600 hover:text-danger"
                                                        href="#">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="text-default-800 text-sm whitespace-nowrap">
                                            <td class="py-3.5 ps-4">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </td>
                                            <td class="px-3.5 py-2.5 whitespace-nowrap">TW-1002</td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    <img alt="" class="size-10 rounded-full"
                                                        src="/images/user/avatar-2.png" />
                                                    <div>
                                                        <h6 class="font-semibold mb-0.5">Howard George
                                                        </h6>
                                                        <p class="text-default-500">george@tailwick.com
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-2.5">ASP.Net Developer</td>
                                            <td class="px-3.5 py-2.5"><span class="text-danger">Low</span></td>
                                            <td class="px-3.5 py-2.5">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Active</span>
                                            </td>
                                            <td class="px-3.5 py-2.5 text-start">
                                                <span class="inline-flex justify-start gap-2.5">
                                                    <a class="btn size-8 bg-default-100 hover:bg-blue-100 text-default-600 hover:text-primary"
                                                        href="#">
                                                        <i class="size-4" data-lucide="pencil"></i>
                                                    </a>
                                                    <a class="btn size-8 bg-default-100 hover:bg-red-100 text-default-600 hover:text-danger"
                                                        href="#">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="text-default-800 text-sm whitespace-nowrap">
                                            <td class="py-3.5 ps-4">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </td>
                                            <td class="px-3.5 py-2.5">TW-1003</td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    <img alt="" class="size-10 rounded-full"
                                                        src="/images/user/avatar-3.png" />
                                                    <div>
                                                        <h6 class="font-semibold mb-0.5">Laura Dawson
                                                        </h6>
                                                        <p class="text-default-500">laura@tailwick.com
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-2.5">React Developer</td>
                                            <td class="px-3.5 py-2.5"><span class="text-green-700">Good</span></td>
                                            <td class="px-3.5 py-2.5">
                                                <span
                                                    class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/30">Active</span>
                                            </td>
                                            <td class="px-3.5 py-2.5 text-start">
                                                <span class="inline-flex justify-start gap-2.5">
                                                    <a class="btn size-8 bg-default-100 hover:bg-blue-100 text-default-600 hover:text-primary"
                                                        href="#">
                                                        <i class="size-4" data-lucide="pencil"></i>
                                                    </a>
                                                    <a class="btn size-8 bg-default-100 hover:bg-red-100 text-default-600 hover:text-danger"
                                                        href="#">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="text-default-800 text-sm whitespace-nowrap">
                                            <td class="py-3.5 ps-4">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </td>
                                            <td class="px-3.5 py-2.5">TW-1004</td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    <img alt="" class="size-10 rounded-full"
                                                        src="/images/user/avatar-4.png" />
                                                    <div>
                                                        <h6 class="font-semibold mb-0.5">Joseph Morgan
                                                        </h6>
                                                        <p class="text-default-500">morgan@tailwick.com
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-2.5">Angular Developer</td>
                                            <td class="px-3.5 py-2.5"><span class="text-green-700">Good</span></td>
                                            <td class="px-3.5 py-2.5">
                                                <span
                                                    class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-default-100 text-default-600 border border-default-200 rounded">Disabled</span>
                                            </td>
                                            <td class="px-3.5 py-2.5 text-start">
                                                <span class="inline-flex justify-start gap-2.5">
                                                    <a class="btn size-8 bg-default-100 hover:bg-blue-100 text-default-600 hover:text-primary"
                                                        href="#">
                                                        <i class="size-4" data-lucide="pencil"></i>
                                                    </a>
                                                    <a class="btn size-8 bg-default-100 hover:bg-red-100 text-default-600 hover:text-danger"
                                                        href="#">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                        <tr class="text-default-800 text-sm whitespace-nowrap">
                                            <td class="py-3.5 ps-4">
                                                <input class="form-checkbox" id="checkbox-all" type="checkbox" />
                                            </td>
                                            <td class="px-3.5 py-2.5">TW-1005</td>
                                            <td class="px-3.5 py-2.5">
                                                <div class="flex items-center gap-2">
                                                    <img alt="" class="size-10 rounded-full"
                                                        src="/images/user/avatar-4.png" />
                                                    <div>
                                                        <h6 class="font-semibold mb-0.5">Jeremy Rose</h6>
                                                        <p class="text-default-500">rose@tailwick.com</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-3.5 py-2.5">UI / UX Designer</td>
                                            <td class="px-3.5 py-2.5"><span class="text-danger">Low</span></td>
                                            <td class="px-3.5 py-2.5">
                                                <span
                                                    class="py-0.5 px-2.5 inline-flex items-center text-xs font-medium bg-default-100 text-default-600 border border-default-200 rounded">Disabled</span>
                                            </td>
                                            <td class="px-3.5 py-2.5 text-start">
                                                <span class="inline-flex justify-start gap-2.5">
                                                    <a class="btn size-8 bg-default-100 hover:bg-blue-100 text-default-600 hover:text-primary"
                                                        href="#">
                                                        <i class="size-4" data-lucide="pencil"></i>
                                                    </a>
                                                    <a class="btn size-8 bg-default-100 hover:bg-red-100 text-default-600 hover:text-danger"
                                                        href="#">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <p class="text-default-500 text-sm">Showing <b>10</b> of <b>19</b> Results</p>
                        <nav aria-label="Pagination" class="flex items-center gap-2">
                            <button
                                class="btn btn-sm border bg-transparent border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                                type="button">
                                <i class="size-4 me-1" data-lucide="chevron-left"></i>Prev
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
            <div class="grid lg:grid-cols-3 col-span-1 gap-5">
                <div class="col-span-1">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Total Projects (247)</h6>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150"
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
                            <div id="totalProjectChart"></div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="card z-10">
                        <div class="card-header">
                            <h6 class="card-title">Upcoming Interview </h6>
                        </div>
                        <div class="h-98" data-simplebar="">
                            <div class="card-body">
                                <div class="flex flex-col gap-3">
                                    <div class="border rounded-md border-default-200">
                                        <div class="flex justify-between items-center p-2 border-b border-default-200">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <div class="rounded-full size-10">
                                                    <img alt="" class="rounded-full"
                                                        src="/images/user/user-1.jpg" />
                                                </div>
                                                <div class="text-sm">
                                                    <h6 class="mb-1 text-default-800 font-semibold"><a
                                                            href="#">James
                                                            Krogman</a></h6>
                                                    <p class="text-default-500">james@tailwick.com</p>
                                                </div>
                                            </div>
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150 text-default-500"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis-vertical size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-60 mt-2 p-2"
                                                    role="menu">
                                                    <div class="flex flex-col gap-y-1 text-sm">
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Overview
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Edit
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div class="flex justify-between items-center gap-3 text-sm">
                                                <div class="flex gap-3 items-center text-default-500">
                                                    <div class="flex items-center">
                                                        <i class="size-4 me-1.5" data-lucide="calendar"></i>
                                                        <span>25 Nov</span>
                                                    </div>
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="clock"></i>
                                                        <span class="uppercase">02:41 pm</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded text-xs font-normal border border-success/40 text-success">Confirm</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-md border-default-200">
                                        <div class="flex justify-between items-center p-2 border-b border-default-200">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <div class="rounded-full size-10">
                                                    <img alt="" class="rounded-full"
                                                        src="/images/user/user-2.jpg" />
                                                </div>
                                                <div class="text-sm">
                                                    <h6 class="mb-1 text-default-800 font-semibold"><a
                                                            href="#">Michael
                                                            Scott</a></h6>
                                                    <p class="text-default-500">michaelScott@tailwick.com</p>
                                                </div>
                                            </div>
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150 text-default-500"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis-vertical size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-140 mt-2 p-2"
                                                    role="menu">
                                                    <div class="flex flex-col gap-y-1 text-sm">
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Overview
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Edit
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div class="flex justify-between items-center gap-3 text-sm">
                                                <div class="flex gap-3 items-center">
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="calendar"></i>
                                                        <span>05 Dec</span>
                                                    </div>
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="clock"></i>
                                                        <span class="uppercase">01:23 pm</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded text-xs font-normal border border-primary/40 text-primary">Re-scheduled</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-md border-default-200">
                                        <div class="flex justify-between items-center p-2 border-b border-default-200">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <div class="rounded-full size-10">
                                                    <img alt="" class="rounded-full"
                                                        src="/images/user/user-3.jpg" />
                                                </div>
                                                <div class="text-sm">
                                                    <h6 class="mb-1 text-default-800 font-semibold"><a
                                                            href="#">Denise
                                                            Ledford</a></h6>
                                                    <p class="text-default-500">ledford@tailwick.com</p>
                                                </div>
                                            </div>
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150 text-default-500"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis-vertical size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-140 mt-2 p-2"
                                                    role="menu">
                                                    <div class="flex flex-col gap-y-1 text-sm">
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Overview
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Edit
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div class="flex justify-between items-center gap-3 text-sm">
                                                <div class="flex gap-3 items-center">
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="calendar"></i>
                                                        <span> 27 Nov</span>
                                                    </div>
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="clock"></i>
                                                        <span class="uppercase">11:59 pm</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded text-xs font-normal border border-secondary/40 text-secondary">Scheduled</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="border rounded-md border-default-200">
                                        <div class="flex justify-between items-center p-2 border-b border-default-200">
                                            <div class="flex flex-wrap items-center gap-3">
                                                <div class="rounded-full size-10">
                                                    <img alt="" class="rounded-full"
                                                        src="/images/user/avatar-5.png" />
                                                </div>
                                                <div>
                                                    <h6 class="mb-1 text-default-800 font-semibold"><a
                                                            href="#">Gladys
                                                            Smith</a></h6>
                                                    <p class="text-default-500">gap-4@tailwick.com</p>
                                                </div>
                                            </div>
                                            <div class="hs-dropdown relative inline-flex">
                                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150 text-default-500"
                                                    hs-dropdown-placement="bottom-end" type="button">
                                                    <i class="iconify lucide--ellipsis-vertical size-4"></i>
                                                </button>
                                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-140 mt-2 p-2"
                                                    role="menu">
                                                    <div class="flex flex-col gap-y-1 text-sm">
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Overview
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Edit
                                                        </a>
                                                        <a class="py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                                            href="#">
                                                            Delete
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="p-2">
                                            <div class="flex justify-between items-center gap-3 text-sm">
                                                <div class="flex gap-3 items-center">
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="calendar"></i>
                                                        <span> 07 Dec</span>
                                                    </div>
                                                    <div class="flex items-center text-default-500">
                                                        <i class="size-4 me-1.5" data-lucide="clock"></i>
                                                        <span class="uppercase">05:19 pm</span>
                                                    </div>
                                                </div>
                                                <div>
                                                    <span
                                                        class="inline-flex items-center gap-x-1.5 py-0.5 px-2 rounded text-xs font-normal border border-danger/40 text-danger">Cancelled</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-span-1">
                    <div class="relative mb-5 bg-gradient-to-r to-primary/50 from-transparent rounded-md shadow-md">
                        <div class="bg-[url('/images/hr-dashboard.png')] absolute inset-0 bg-cover opacity-30"></div>
                        <div class="relative card-body">
                            <div class="flex gap-3 mb-4">
                                <div class="bg-purple-500/10 rounded-full size-10">
                                    <img alt="" class="h-10 rounded-full" src="/images/user/avatar-6.png" />
                                </div>
                                <div>
                                    <h6 class="mb-1 text-sm text-default-800">Nakisha Short</h6>
                                    <p class="text-default-600">Her Birthday Today</p>
                                </div>
                            </div>
                            <button class="btn btn-sm bg-primary text-white" type="button">Wish Her</button>
                        </div>
                        <img alt="" class="absolute bottom-0 right-0" src="/images/birthday.png" />
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title">Recent Payroll</h6>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 hover:bg-default-150"
                                    hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis-vertical size-4 text-default-500"></i>
                                </button>
                                <div class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 bg-card shadow-md rounded-lg z-30 mt-2 p-2"
                                    role="menu">
                                    <div class="text-sm">
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                            href="#">
                                            Today
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                            href="#">
                                            Yesterday
                                        </a>
                                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                                            href="#">
                                            Thursday
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="h-60" data-simplebar="">
                            <div class="card-body">
                                <div class="flex flex-col gap-3.5">
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-danger size-4" data-lucide="move-up-right"></i>
                                        <h6 class="text-default-800 font-semibold grow">Christopher Horn</h6>
                                        <h6 class="text-default-900">$145.32</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Paid</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-success size-4" data-lucide="move-up-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">Richard Peters</h6>
                                        <h6 class="text-default-900">$4512.99</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-success size-4" data-lucide="move-up-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">James Perez</h6>
                                        <h6 class="text-default-900">$879.99</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Paid</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-danger size-4" data-lucide="move-up-right"></i>
                                        <h6 class="text-default-800 font-semibold grow">Myrtle Velez</h6>
                                        <h6 class="text-default-900">$978.14</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">Cancelled</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-success size-4" data-lucide="move-up-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">Brad Castillo</h6>
                                        <h6 class="text-default-900">$412.59</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <i class="text-success size-4" data-lucide="move-up-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">Robert Jump</h6>
                                        <h6 class="text-default-900">$666.99</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Paid</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-danger size-4" data-lucide="move-up-right"></i>
                                        <h6 class="text-default-800 font-semibold grow">Myrtle Velez</h6>
                                        <h6 class="text-default-900">$978.14</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">Cancelled</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3 text-sm">
                                        <i class="text-danger size-4" data-lucide="move-up-right"></i>
                                        <h6 class="text-default-800 font-semibold grow">Christopher Horn</h6>
                                        <h6 class="text-default-900">$145.32</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Paid</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <i class="text-success size-4" data-lucide="move-down-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">Richard Peters</h6>
                                        <h6 class="text-default-900">$4512.99</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                        </div>
                                    </div>
                                    <div class="flex flex-wrap items-center gap-3">
                                        <i class="text-success size-4" data-lucide="move-down-left"></i>
                                        <h6 class="text-default-800 font-semibold grow">James Perez</h6>
                                        <h6 class="text-default-900">$879.99</h6>
                                        <div>
                                            <span
                                                class="py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Paid</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Upcoming Scheduled</h6>
                </div>
                <div class="card-body">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-900 font-semibold">28</h6>
                                <span class="text-default-500">July</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Meeting with Designer
                                    <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">09:57
                                        AM</small>
                                </h6>
                                <p class="text-default-500">Created by Admin</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">08</h6>
                                <span class="text-default-500">June</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Developing Line Managers
                                    Conference <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">10:54
                                        AM</small>
                                </h6>
                                <p class="text-default-500">Created by HR</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">17</h6>
                                <span class="text-default-500">July</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Airplane in Las Vegas <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">12:00
                                        PM</small>
                                </h6>
                                <p class="text-default-500">Created by HR</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">11</h6>
                                <span class="text-default-500">Nov</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Hospitality Project Discuses</h6>
                                <p class="text-default-500">Created by Admin</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">20</h6>
                                <span class="text-default-500">Nov</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Gartner Digital Workplace <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">03:49
                                        PM</small>
                                </h6>
                                <p class="text-default-500">Created by HR</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">04</h6>
                                <span class="text-default-500">Dec</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">Nordic People Analytics <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">11:00
                                        AM</small>
                                </h6>
                                <p class="text-default-500">Created by Admin</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">17</h6>
                                <span class="text-default-500">Jan</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">CIPD Festival of Work <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">01:29
                                        PM</small>
                                </h6>
                                <p class="text-default-500">Created by HR</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">03</h6>
                                <span class="text-default-500">Feb</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">HRO Today Forum <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">02:15
                                        PM</small>
                                </h6>
                                <p class="text-default-500">Created by Admin</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">15</h6>
                                <span class="text-default-500">Mar</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">
                                    HR Training Workshop
                                    <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">09:00
                                        AM</small>
                                </h6>
                                <p class="text-default-500">Created by HR</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">29</h6>
                                <span class="text-default-500">Apr</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">
                                    Marketing Strategy Review
                                    <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">04:45
                                        PM</small>
                                </h6>
                                <p class="text-default-500">Created by Marketing</p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div
                                class="flex flex-col items-center justify-center border rounded-sm size-12 border-default-200">
                                <h6 class="text-default-800 font-semibold">10</h6>
                                <span class="text-default-500">May</span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-default-900 text-sm font-medium">
                                    Client Demo Presentation
                                    <small
                                        class="px-2 font-medium rounded text-xs py-0.5 bg-default-100 text-default-500">11:30
                                        AM</small>
                                </h6>
                                <p class="text-default-500">Created by Admin</p>
                            </div>
                        </div>
                    </div>
                    <div class="flex gap-3 p-2 mt-4 rounded-md bg-primary">
                        <img alt="" class="h-24" src="/images/support.png" />
                        <div>
                            <h6 class="mb-1 text-base text-white">Need Help ?</h6>
                            <p class="text-white">If you would like to learn more about transferring the license to a
                                customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/pages/dashboard-hr.js'])
@endsection
