@extends('layouts.vertical', ['title' => 'Expenses'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Expenses'] )

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
                       placeholder="Select date" type="text"/>
            </div>
            <a aria-controls="sales-expenses-add" aria-expanded="false" aria-haspopup="dialog"
               class="btn btn-sm bg-primary text-white" data-hs-overlay="#sales-expenses-add" href="#">
                <i class="size-4 me-1" data-lucide="plus"></i>
                Add Estimate
            </a>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                            <tr class="text-sm font-normal text-default-500 whitespace-nowrap">
                                <th class="px-3.5 py-3 text-start" scope="col">Purchase Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Item</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Purchased By</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Paid By</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Amount</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal">
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02 July, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Mac System</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$5,478</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">08 Nov, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> HP Desktop</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Louisa Howe</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$4,342</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Aug, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">i5 PC</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Everett Moore</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Admin</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$8,327</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20 Sep, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Decoration</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Omari Welch</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$563</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07 Oct, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Cake</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Susana Dooley</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$148</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">18 Dec, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Salary to Employees</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Omari Welch</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Paula Keenan</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$4,500</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">21 Jan, 2024</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Salary to Employees</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Everett Moore</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Paula Keenan</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$3,000</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02 Feb, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HP &amp; Lenovo Desktop</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$4,177</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Dec, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Birthday Party</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$2,307</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01 Jan, 2023</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Festival Decoration</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Lucie Beahan</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">HR</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$543.99</td>
                                <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div
                                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                                            role="menu">
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
                <p class="text-default-500 text-sm">Showing <b>10</b> of <b>25</b> Results</p>
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
