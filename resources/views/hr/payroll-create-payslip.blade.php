@extends('layouts.vertical', ['title' => 'Create Payslip'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Create Payslip'] )

    <div class="lg:w-5xl w-full mx-auto">
        <div class="card relative">
            <div class="card-body">
                <div class="absolute top-0 end-0 opacity-30">
                    <img alt="" src="/images/logo-sm.png"/>
                </div>
                <div class="text-center">
                    <h5 class="inline-block relative text-lg text-default-800 font-semibold">
                        Salary Slip
                        <span
                            class="absolute start-0 end-0 -bottom-2 h-0.25 bg-gradient-to-r from-white via-primary to-white"></span>
                    </h5>
                </div>
                <div class="mt-16 lg:max-w-md w-full">
                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="employeeID">Employee
                            ID</label>
                        <input class="form-input bg-default-100" disabled="" id="employeeID" type="text"
                               value="#TWE1001524"/>
                    </div>
                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="employeeSelect">Employee
                            Name</label>
                        <select class="form-input">
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
                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="ExperienceInput">Experience</label>
                        <input class="form-input" id="ExperienceInput" placeholder="0.4 year" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="createDateInput">Create
                            Date</label>
                        <input class="form-input" data-date-format="d M, Y" data-provider="flatpickr"
                               id="createDateInput" placeholder="Select date" readonly="readonly" type="text"/>
                    </div>
                </div>
                <div class="mt-10 overflow-x-auto">
                    <table class="w-full whitespace-nowrap">
                        <thead class="bg-default-100 text-sm text-default-800">
                        <tr>
                            <th class="px-3.5 py-2.5 font-semibold">Month</th>
                            <th class="px-3.5 py-2.5 font-semibold">Salary Amount</th>
                            <th class="px-3.5 py-2.5 font-semibold">Deductions(TDS)</th>
                            <th class="px-3.5 py-2.5 font-semibold">Professional Tax</th>
                            <th class="px-3.5 py-2.5 font-semibold">Provident Fund</th>
                            <th class="px-3.5 py-2.5 font-semibold">Net Payable</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" data-date-format="d M, Y" data-provider="flatpickr"
                                       placeholder="Select date" readonly="readonly" type="text"/>
                            </td>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" placeholder="$00.00" type="number"/>
                            </td>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" placeholder="$00.00" type="number"/>
                            </td>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" placeholder="$00.00" type="number"/>
                            </td>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" placeholder="$00.00" type="number"/>
                            </td>
                            <td class="px-3.5 py-2.5">
                                <input class="form-input" placeholder="$00.00" type="number"/>
                            </td>
                        </tr>
                        </tbody>
                        <tbody class="before:block before:h-4">
                        <tr>
                            <td colspan="6">
                                <button
                                    class="btn bg-transparent border border-dashed border-primary text-primary hover:bg-primary/10"
                                    type="button">
                                    <i class="size-3 me-1" data-lucide="plus"></i>
                                    Add Item
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="grid lg:grid-cols-2 grid-cols-1 mt-10 gap-5">
                    <div class="text-sm">
                        <p class="mb-2 text-default-500">For any inquiries, please contact us at +(252) 0123 456 7890 or
                            reach out via email at tailwick@themesdesign.in.</p>
                        <p class="mb-2 text-default-500">Best Regards,</p>
                        <p class="mb-2 text-default-500">Themesdesign</p>
                        <p class="text-default-500">Founder &amp; CEO: <span class="font-semibold text-default-800">Paula Keenan</span>
                        </p>
                    </div>
                    <div class="flex flex-col lg:justify-end text-center lg:items-end items-center">
                        <img alt="" class="h-12" src="/images/signature.png"/>
                        <h6 class="text-default-800 font-semibold text-sm">Authorized Sign</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
