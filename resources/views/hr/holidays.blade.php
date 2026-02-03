@extends('layouts.vertical', ['title' => 'Holidays'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Holidays'])

    <div class="card">
        <div class="card-header">
            <h6 class="text-default-800 text-base font-semibold">Holidays 2024</h6>
            <button class="btn btn-sm bg-primary text-white">
                <i class="size-4 me-1" data-lucide="plus"></i>Add Holiday
            </button>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="font-normal whitespace-nowrap">
                                <tr class="text-sm text-default-800 divide-x divide-default-200">
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">#</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Day</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Date</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Holiday Name</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Type</th>
                                    <th class="px-3.5 py-3 font-medium text-start" scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">1</td>
                                    <td class="px-3.5 py-3 text-sm">Monday</td>
                                    <td class="px-3.5 py-3 text-sm">15 Jan</td>
                                    <td class="px-3.5 py-3 text-sm">Makara Sankranti</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">2</td>
                                    <td class="px-3.5 py-3 text-sm">Friday</td>
                                    <td class="px-3.5 py-3 text-sm">26 Jan</td>
                                    <td class="px-3.5 py-3 text-sm">Republic Day</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">3</td>
                                    <td class="px-3.5 py-3 text-sm">Monday</td>
                                    <td class="px-3.5 py-3 text-sm">25 Mar</td>
                                    <td class="px-3.5 py-3 text-sm">Holi</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">4</td>
                                    <td class="px-3.5 py-3 text-sm">Friday</td>
                                    <td class="px-3.5 py-3 text-sm">29 Mar</td>
                                    <td class="px-3.5 py-3 text-sm">Good Friday</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">5</td>
                                    <td class="px-3.5 py-3 text-sm">Sunday</td>
                                    <td class="px-3.5 py-3 text-sm">4 Aug</td>
                                    <td class="px-3.5 py-3 text-sm">Friendship Day</td>
                                    <td class="px-3.5 py-3 text-sm">Observance</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">6</td>
                                    <td class="px-3.5 py-3 text-sm">Thursday</td>
                                    <td class="px-3.5 py-3 text-sm">15 Aug</td>
                                    <td class="px-3.5 py-3 text-sm">Independence Day</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">7</td>
                                    <td class="px-3.5 py-3 text-sm">Sunday</td>
                                    <td class="px-3.5 py-3 text-sm">15 Sep</td>
                                    <td class="px-3.5 py-3 text-sm">Onam</td>
                                    <td class="px-3.5 py-3 text-sm">Restricted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">8</td>
                                    <td class="px-3.5 py-3 text-sm">Thursday</td>
                                    <td class="px-3.5 py-3 text-sm">31 Oct</td>
                                    <td class="px-3.5 py-3 text-sm">Halloween</td>
                                    <td class="px-3.5 py-3 text-sm">Observance</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">9</td>
                                    <td class="px-3.5 py-3 text-sm">Wednesday</td>
                                    <td class="px-3.5 py-3 text-sm">25 Dec</td>
                                    <td class="px-3.5 py-3 text-sm">Christmas</td>
                                    <td class="px-3.5 py-3 text-sm">Gazetted Holiday</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal whitespace-nowrap divide-x divide-default-200">
                                    <td class="px-3.5 py-3 text-sm">10</td>
                                    <td class="px-3.5 py-3 text-sm">Tuesday</td>
                                    <td class="px-3.5 py-3 text-sm">31 Dec</td>
                                    <td class="px-3.5 py-3 text-sm">New Year</td>
                                    <td class="px-3.5 py-3 text-sm">Observance</td>
                                    <td class="px-3.5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a aria-controls="holidaysLeaveDeleteModal2" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal2" href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a aria-controls="holidaysLeaveDeleteModal" aria-expanded="false"
                                                aria-haspopup="dialog"
                                                class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                                data-hs-overlay="#holidaysLeaveDeleteModal" href="#">
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

    <div id="holidaysLeaveDeleteModal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="holidaysLeaveDeleteModal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 md:w-sm m-3 mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col card shadow-2xs border border-default-200 rounded-xl pointer-events-auto px-6 py-8 relative">
                <div class="absolute top-3 end-3">
                    <button type="button" class="size-5 text-default-800" aria-label="Close"
                        data-hs-overlay="#holidaysLeaveDeleteModal">
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
                            <button class="btn text-danger bg-transparent hover:bg-danger/10"
                                aria-label="Close">Cancel</button>
                            <button class="btn bg-danger text-white">Yes,Delete It!</button>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </div>

    <div id="holidaysLeaveDeleteModal2"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="holidaysLeaveDeleteModal-label2">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 sm:max-w-lg sm:w-full m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col card border border-default-200 shadow-2xs rounded-xl pointer-events-auto">
                <div class="card-header">
                    <h3 id="holidaysLeaveDeleteModal-label2" class="card-title">
                        Add Holiday
                    </h3>

                    <div>
                        <button type="button" class="size-5 text-default-800" aria-label="Close"
                            data-hs-overlay="#holidaysLeaveDeleteModal2">
                            <span class="sr-only">Close</span>
                            <i data-lucide="x" class="size-5"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="grid grid-cols-1 gap-4 lg:grid-cols-12">
                        <!-- Type Select -->
                        <div class="lg:col-span-12">
                            <label for="typeSelect" class="inline-block mb-2 text-base font-medium">Type</label>
                            <select id="typeSelect" name="typeSelect" class="form-input" data-choices
                                data-choices-search-false>
                                <option value="Gazetted Holiday">Gazetted Holiday</option>
                                <option value="Observance">Observance</option>
                                <option value="Restricted Holiday" selected>Restricted Holiday</option>
                                <option value="Season">Season</option>
                            </select>
                        </div>

                        <!-- Holiday Name -->
                        <div class="lg:col-span-12">
                            <label for="holidayInput" class="inline-block mb-2 text-base font-medium">Holiday Name</label>
                            <input type="text" id="holidayInput"
                                class="form-input bg-transparent border-default-200 focus:outline-none focus:border-primary 
                                                                 placeholder:text-default-400"
                                placeholder="Holiday name">
                        </div>

                        <!-- Date -->
                        <div class="lg:col-span-12">
                            <label for="holidayDateInput" class="inline-block mb-2 text-base font-medium">Date</label>
                            <input type="text" placeholder="Select Date" data-provider="flatpickr"
                                data-date-format="d M, Y" data-range-date="true" readonly="readonly"
                                placeholder="Select Date" class="form-input">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end items-center gap-x-2 py-3 px-4">
                    <button
                        class="btn border-0 text-sm rounded-md text-danger bg-transparent transition-all duration-300 hover:bg-danger/10"
                        aria-label="Close">Cancel</button>
                    <button type="button" class="btn bg-primary text-white">
                        Add Holiday
                    </button>
                </div>
            </div>
        </div>

    </div>
    <!-- End Page content -->
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
