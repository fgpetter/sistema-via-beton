@extends('layouts.vertical', ['title' => 'Department'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Department'])

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Departments</h6>
            <button class="btn btn-sm bg-primary text-white">
                <i class="size-4 me-1" data-lucide="plus"></i>Add Department
            </button>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="font-semibold whitespace-nowrap">
                                <tr class="text-sm text-default-800 divide-x divide-default-200">
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">#</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Department Name</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Head of Dep.</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Phone Number</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Email</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Employee</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">1</td>
                                    <td class="px-3.5 py-3 text-sm">Web Development</td>
                                    <td class="px-3.5 py-3 text-sm">Patricia Garcia</td>
                                    <td class="px-3.5 py-3 text-sm">077 7317 7572</td>
                                    <td class="px-3.5 py-3 text-sm">PatriciaJGarcia@tailwick.com</td>
                                    <td class="px-3.5 py-3 text-sm">15</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="department-edit-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-edit-modal" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="department-delete-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">2</td>
                                    <td class="px-3.5 py-3 text-sm">IOS Application Development</td>
                                    <td class="px-3.5 py-3 text-sm"> Frederiksen</td>
                                    <td class="px-3.5 py-3 text-sm">61 53 62 05</td>
                                    <td class="px-3.5 py-3 text-sm">jonas@tailwick.com</td>
                                    <td class="px-3.5 py-3 text-sm">09</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="department-edit-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-edit-modal" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="department-delete-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">3</td>
                                    <td class="px-3.5 py-3 text-sm">Designing</td>
                                    <td class="px-3.5 py-3 text-sm">Juliette Fecteau</td>
                                    <td class="px-3.5 py-3 text-sm">07231 96 25 88</td>
                                    <td class="px-3.5 py-3 text-sm">JulietteFecteau@tailwick.com</td>
                                    <td class="px-3.5 py-3 text-sm">11</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="department-edit-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-edit-modal" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="department-delete-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">4</td>
                                    <td class="px-3.5 py-3 text-sm">HR Management</td>
                                    <td class="px-3.5 py-3 text-sm">Thomas Hatfield</td>
                                    <td class="px-3.5 py-3 text-sm">0911 47 65 49</td>
                                    <td class="px-3.5 py-3 text-sm">thomas@tailwick.com</td>
                                    <td class="px-3.5 py-3 text-sm">03</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="department-edit-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-edit-modal" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="department-delete-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">5</td>
                                    <td class="px-3.5 py-3 text-sm">Accounts Management</td>
                                    <td class="px-3.5 py-3 text-sm">Holly Kavanaugh</td>
                                    <td class="px-3.5 py-3 text-sm">819 947 5846</td>
                                    <td class="px-3.5 py-3 text-sm">HollyKavanaugh@tailwick.com</td>
                                    <td class="px-3.5 py-3 text-sm">02</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="department-edit-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-edit-modal" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="department-delete-modal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="btn size-8 bg-default-200 hover:bg-primary/10 hover:text-primary text-default-600"
                                                data-hs-overlay="#department-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
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
                <p class="text-default-500 text-sm">Showing <b>5</b> of <b>8</b> Results</p>
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

    <div id="department-delete-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="department-delete-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 md:w-sm m-3 mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col card shadow-2xs border border-default-200 rounded-xl pointer-events-auto px-6 py-8 relative">
                <div class="absolute top-3 end-3">
                    <button type="button" class="size-5 text-default-800" aria-label="Close"
                        data-hs-overlay="#department-delete-modal">
                        <span class="sr-only">Close</span>
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                <h3 class="font-semibold text-base text-default-800  text-center">
                    <img src="/images/delete.png" alt="" class="size-12 mx-auto">
                    <div class="mt-5 text-center">
                        <h5 class="mb-1 text-lg font-semibold text-default-800">Are you sure?</h5>
                        <p class="text-default-500 text-sm font-normal">Are you certain you want to delete this record?</p>
                        <div class="mt-5 flex gap-2 justify-center">
                            <button data-hs-overlay="#department-delete-modal"
                                class="btn text-danger bg-transparent hover:bg-danger/10"
                                aria-label="Close">Cancel</button>
                            <button class="bg-danger text-white  btn border-0 btn-sm">Yes,Delete It!</button>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </div>

    <div id="department-edit-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="department-delete-modal-label2">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col card border border-default-200 shadow-2xs rounded-xl pointer-events-auto">
                <div class="card-header">
                    <h3 id="department-delete-modal-label2" class="font-bold text-default-800 text-base">
                        Add Department
                    </h3>
                    <div>
                        <button type="button" class="size-5 text-default-800" aria-label="Close"
                            data-hs-overlay="#department-edit-modal">
                            <span class="sr-only">Close</span>
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                </div>

                <div class="p-4 overflow-y-auto">
                    <div class="flex flex-col gap-y-4">

                        <div class="lg:col-span-12">
                            <label for="Department Name" class="inline-block mb-2 text-base font-medium">Department
                                Name</label>
                            <input type="text" id="Department Name" class="form-input" placeholder="Department Name">
                        </div>

                        <!-- Date -->
                        <div class="lg:col-span-12">
                            <label for="Head of Dep. Name" class="inline-block mb-2 text-base font-medium">Head of Dep.
                                Name</label>
                            <input type="text" placeholder="Head name" class="form-input">
                        </div>

                        <div class="lg:col-span-12">
                            <label for="Phone Number" class="inline-block mb-2 text-base font-medium">Phone Number</label>
                            <input type="text" id="Phone Number" class="form-input" placeholder="1234567890">
                        </div>

                        <!-- Date -->
                        <div class="lg:col-span-12">
                            <label for="Email" class="inline-block mb-2 text-base font-medium">Email</label>
                            <input type="text" placeholder="Enter Email" class="form-input">
                        </div>

                        <div class="lg:col-span-12">
                            <label for="Total Employee" class="inline-block mb-2 text-base font-medium">Total
                                Employee</label>
                            <input type="text" placeholder="0" class="form-input">
                        </div>
                    </div>

                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4">
                    <button data-hs-overlay="#department-edit-modal"
                        class="bg-transparent text-danger btn border-0 hover:bg-danger/10"
                        aria-label="Close">Cancel</button>

                    <button type="button" class="text-white  btn bg-primary">
                        Add Department
                    </button>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
