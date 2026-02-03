@extends('layouts.vertical', ['title' => 'Main Attendance'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Main Attendance'] )

    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-info bg-info/10 size-12">
                        <i class="size-6" data-lucide="users-2"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="43">43</span>
                        </h5>
                        <p class="text-default-500">Total Employee</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-danger bg-danger/10 size-12">
                        <i class="size-6" data-lucide="user-x"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="6">6</span>
                        </h5>
                        <p class="text-default-500">Absent Employee (Today)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-success bg-success/10 size-12">
                        <i class="size-6" data-lucide="user-check"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="32">32</span>
                        </h5>
                        <p class="text-default-500">Present Employee (Today)</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex items-center gap-3">
                    <div class="btn text-primary bg-primary/10 size-12">
                        <i class="ize-6" data-lucide="briefcase"></i>
                    </div>
                    <div>
                        <h5 class="mb-1 text-base text-heading font-semibold">
                            <span class="counter-value" data-target="22">22</span>
                        </h5>
                        <p class="text-default-500">Working Days (Current Month)</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <div class="relative">
                <input class="ps-11 form-input form-input-sm" placeholder="Search for...." type="email"/>
                <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                    <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
                </div>
            </div>
            <div class="relative">
                <input class="form-input form-input-sm ps-10" data-date-format="d M, Y" data-provider="flatpickr"
                       data-range-date="true" placeholder="Select Date" readonly="readonly" type="text"/>
                <i class="absolute top-1.5 start-3 size-4 flex items-center text-default-500"
                   data-lucide="calendar"></i>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-100 font-normal whitespace-nowrap">
                            <tr class="text-sm text-default-800">
                                <th class="px-3.5 py-3 font-medium" scope="col">Employee Name</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">01</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">02</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">03</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">04</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">05</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">06</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">07</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">08</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">09</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">10</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">11</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">12</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">13</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">14</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">15</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">16</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">17</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">18</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">19</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">20</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">21</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">22</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">23</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">24</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">25</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">26</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">27</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">28</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">29</th>
                                <th class="px-3.5 py-3 font-medium" scope="col">30</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">Patricia Garcia</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    -
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Tonya Johnson
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Willie Torres
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Jose White
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Jose White
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Jonas Frederiksen
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Kim Broberg
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Nancy Reynolds
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Thomas Hatfield
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm">
                                    Holly Kavanaugh
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">-</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-danger" data-lucide="x"></i>
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <i class="size-4 text-success" data-lucide="check"></i>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
