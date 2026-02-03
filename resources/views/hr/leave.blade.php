@extends('layouts.vertical', ['title' => 'Leave Manage (HR)'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Leave Manage (HR)'] )

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-primary bg-primary/10 size-12">
                        <i class="iconify lucide--file-bar-chart-2 size-6"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="18">18</span>/
                            <span class="counter-value" data-target="60">60</span>
                        </h5>
                        <p class="text-default-500">Today/Presents Leave</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-success bg-success/10 size-12">
                        <i class="iconify lucide--calendar-check size-6"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="5">5</span>
                        </h5>
                        <p class="text-default-500">Today Leaves</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-secondary bg-secondary/10 size-12">
                        <i class="iconify lucide--codepen size-6"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="0">0</span>
                        </h5>
                        <p class="text-default-500">Unplanned Leaves</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-warning bg-warning/10 size-12">
                        <i class="iconify lucide--loader size-6"></i>
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
            <div class="card-header flex justify-between items-center">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for...." type="email"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
                    </div>
                </div>
                <button class="btn btn-sm bg-primary text-white">
                    <i class="size-4 me-1" data-lucide="download"></i> Export
                </button>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-default-200">
                                <thead class="bg-default-150">
                                <tr class="text-sm font-normal text-default-500 whitespace-nowrap">
                                    <th class="px-3.5 py-3 text-start" scope="col">
                                        #
                                    </th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Employee Name</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Leave Type</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Reason</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">No Of Days</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">From</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">to</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> Willie Torres</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Medical Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Going to Hospital</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">12 Oct, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Patricia Garcia</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Going to Family Function</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07 Sept, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07 Sept, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Juliette Fecteau</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Going to Holiday</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">06</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">11 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-secondary/10 text-secondary">New</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">04</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Thomas Hatfield</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Sick Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Attend Birthday party</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">15 July, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">15 July, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Willie Torres</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Sick Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Personal</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">19 Aug, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20 Aug, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger">Declined</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">06</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Juliette Fecteau</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Going to Family Function</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14 Feb, 2022</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">14 Feb, 2022</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Eugene Clifford</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Parental Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Child Care</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">01 Mar, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05 Mar, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">08</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Laura Mendez</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Annual Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Vacation Trip</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">07</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">10 Apr, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">16 Apr, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-warning/15 text-warning">Pending</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">09</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Marcus Lewis</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Medical Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Hospitalization</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">03</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">20 May, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">22 May, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Approved</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
                                                <i class="size-4" data-lucide="trash-2"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">10</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Sophie Turner</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Casual Leave</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Attending Wedding</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">02</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">05 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">06 Jun, 2023</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/10 text-danger">Declined</span>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <a class="btn size-8 bg-default-200 hover:bg-default-600 hover:text-white text-default-600"
                                               href="#">
                                                <i class="size-4" data-lucide="pencil"></i>
                                            </a>
                                            <a class="btn size-8 bg-success/15 hover:bg-success hover:text-white text-success"
                                               href="#">
                                                <i class="size-4" data-lucide="check"></i>
                                            </a>
                                            <a aria-controls="hr-leave-delete-modal" aria-expanded="false"
                                               aria-haspopup="dialog"
                                               class="btn size-8 bg-danger/10 hover:bg-danger hover:text-white text-danger"
                                               data-hs-overlay="#hr-leave-delete-modal" href="#">
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

    <div id="hr-leave-delete-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none" role="dialog" tabindex="-1" aria-labelledby="hr-leave-delete-modal-label">
        <div class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 md:w-sm m-3 mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div class="w-full flex flex-col card shadow-2xs border border-default-200 rounded-xl pointer-events-auto px-6 py-8 relative">
                <div class="absolute top-3 end-3">
                    <button type="button" class="size-5 text-default-800" aria-label="Close" data-hs-overlay="#hr-leave-delete-modal">
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
                            <button class="btn btn-sm border-0  text-danger bg-transparent hover:bg-danger/10" aria-label="Close">Cancel</button>
                            <button class="btn bg-danger text-white">Yes,Delete It!</button>
                        </div>
                    </div>
                </h3>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection
