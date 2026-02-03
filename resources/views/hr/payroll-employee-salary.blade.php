@extends('layouts.vertical', ['title' => 'Employee Salary'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Employee Salary'] )

    <div class="card mb-5">
        <div class="card-body">
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <h5 class="mb-1 text-lg text-default-800 font-semibold">$78,564.00 <small
                            class="font-normal text-default-500">/ year</small></h5>
                    <p class="text-default-500 text-sm">Average Base Salary (USD)</p>
                    <div class="mt-6 mb-4">
                        <div class="flex w-full h-10 rounded-md bg-default-2 text-sm">
                            <div
                                class="flex items-center justify-center h-10 text-white bg-primary rounded-tl-md rounded-bl-md"
                                style="width: 20%">20%
                            </div>
                            <div class="flex items-center justify-center h-10 text-white bg-success" style="width: 15%">
                                15%
                            </div>
                            <div class="flex items-center justify-center h-10 text-white bg-secondary"
                                 style="width: 35%">35%
                            </div>
                            <div
                                class="flex items-center justify-center h-10 text-white bg-danger rounded-tr-md rounded-br-md"
                                style="width: 30%">30%
                            </div>
                        </div>
                    </div>
                    <p class="text-sm">The average salary for all employees is $78,564.</p>
                </div>
                <div class="col-span-1">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <tbody>
                            <tr>
                                <td class="px-3.5 py-2 text-default-800">Base Salary</td>
                                <td class="px-3.5 py-2 text-default-800 font-semibold">$45,932</td>
                            </tr>
                            <tr>
                                <td class="px-3.5 py-2 text-default-800">Bonus</td>
                                <td class="px-3.5 py-2 text-default-800 font-semibold">$16,000</td>
                            </tr>
                            <tr>
                                <td class="px-3.5 py-2 text-default-800">Profit Sharing</td>
                                <td class="px-3.5 py-2 text-default-800 font-semibold">$2.5k to 4.5k</td>
                            </tr>
                            <tr>
                                <td class="px-3.5 py-2 text-default-800">Total Pay</td>
                                <td class="px-3.5 py-2 text-default-800 font-semibold">$78,564.00</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="flex gap-3">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
                    </div>
                </div>
                <input class="form-input form-input-sm lg:w-52 w-full" data-date-format="d M, Y"
                       data-provider="flatpickr" data-range-date="true" id="dateRangeFilterInput"
                       placeholder="Select date" readonly="readonly" type="text"/>
            </div>
            <a class="btn btn-sm bg-primary text-white" href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">
                <i class="size-4 me-1" data-lucide="plus"></i>
                Create Salary
            </a>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                            <tr class="text-sm font-normal text-default-500">
                                <th class="px-3.5 py-3 text-start" scope="col">Employee ID</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Joining Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Name</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Designation</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Email Id</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Phone Number</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Salary</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Bonus</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001501</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05 Feb, 2020</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/user-1.jpg"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Willie Torres</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Nuxt JS Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">willie@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">070 3715 3689</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$8,500</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$500</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001524</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">12 Aug, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-3.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Patricia Garcia</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> ASP.Net Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">PatriciaJGarcia@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 077 7317 7572</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$3,800</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">-</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001506</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Nov, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-6.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Tonya Johnson</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Project Manager</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> TonyaEJohnson@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 079 2383 2340</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$6,000</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,500</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001502</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">09 Jun, 2022</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/user-dummy-img.jpg"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Jose White</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> React Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> ameida@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 03476 56 14 12</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$7,150</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$300</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001503</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> 11 May, 2021</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/user-3.jpg"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Juliette Fecteau</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Sr. Angular Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">JulietteFecteau@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07231 96 25 88</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$7,900</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">-</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001504</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18 Jan, 2019</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/user-2.jpg"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Jonas Frederiksen</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Team Leader</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">jonas@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">61 53 62 05</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$5,399</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">-</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001505</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">23 April, 2021</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-8.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Kim Broberg</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> UI / UX Designer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> KimBroberg@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">040 382 2096</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$6,983</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,800</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001507</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01 July, 2022</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-10.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Nancy Reynolds</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Web Designer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> NancyM@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0391 13 79 21</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$3,300</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,000</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001508</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">08 Aug, 2021</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-9.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Thomas Hatfield</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> VueJs Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">thomas@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">0911 47 65 49</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$9,145</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$760</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">
                                    <a href="#"> #TWE1001509</a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">23 Dec, 2020</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <a class="flex items-center gap-3" href="#">
                                        <div class="rounded-full size-6 shrink-0 bg-default-100">
                                            <img alt="" class="h-6 rounded-full" src="/images/user/avatar-4.png"/>
                                        </div>
                                        <h6 class="text-sm text-default-800">Holly Kavanaugh</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Laravel Developer</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HollyKavanaugh@tailwick.com</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">819 947 5846</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$8,750</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$2,300</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm flex items-center gap-2">
                                    <a class="text-xs text-white bg-sky-500 transition-all duration-300 hover:bg-sky-600 rounded py-1.5 px-2"
                                       href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">Generate Slip</a>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2"
                                            role="menu">
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
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>10</b> of <b>46</b> Results</p>
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
                        class="btn size-7.5 bg-transparent border border-default-200 text-default-600 hover:bg-primary/10 hover:text-primary hover:border-primary/10"
                        type="button">
                        4
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
