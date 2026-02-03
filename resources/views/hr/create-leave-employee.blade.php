@extends('layouts.vertical', ['title' => 'Add Leave (Employee)'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Add Leave (Employee)'] )

    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="lg:col-span-3 col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Apply Leave</h6>
                </div>
                <div class="card-body">
                    <div class="grid md:grid-cols-2 grid-cols-1 gap-5 mb-5">
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="employeeName">Leave
                                Type</label>
                            <select class="form-input">
                                <option value="">Select Leave Type</option>
                                <option value="Medical Leave">Medical Leave</option>
                                <option value="Casual Leave">Casual Leave</option>
                                <option value="Sick Leave">Sick Leave</option>
                                <option value="Annual Leave">Annual Leave</option>
                            </select>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="remainingLeaves">Remaining
                                Leaves</label>
                            <input class="form-input" disabled="" id="remainingLeaves" type="text" value="18"/>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="fromInput">Form</label>
                            <input class="form-input" data-date-format="d M, Y" data-provider="flatpickr" id="fromInput"
                                   placeholder="Select date" type="text"/>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="toInput">To</label>
                            <input class="form-input" data-date-format="d M, Y" data-provider="flatpickr" id="toInput"
                                   placeholder="Select date" type="text"/>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="numberOfDayLeaves">Number of Days</label>
                            <input class="form-input" disabled="" id="numberOfDayLeaves" type="text" value="01"/>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="">Leave
                                Day</label>
                            <select class="form-input">
                                <option value="">Select Leave Day</option>
                                <option value="Full Day">Full Day</option>
                                <option value="Half Day">Half Day</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 gap-5">
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="reasonInput">Reason</label>
                            <textarea class="form-input" id="reasonInput" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="flex justify-end gap-2 mt-5">
                        <button class="btn border-0 text-danger bg-transparent hover:bg-danger/10">Reset</button>
                        <button class="text-white btn bg-primary">Apply Leave</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Leave Information (2023)</h6>
                </div>
                <div class="card-body">
                    <table class="w-full mb-0 text-sm">
                        <tbody>
                        <tr>
                            <td class="py-2.5 text-default-800">Medical Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">04</th>
                        </tr>
                        <tr>
                            <td class="py-2.5 text-default-800">Casual Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">08</th>
                        </tr>
                        <tr>
                            <td class="py-2.5 text-default-800">Sick Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">03</th>
                        </tr>
                        <tr>
                            <td class="py-2.5 text-default-800">Annual Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">12</th>
                        </tr>
                        <tr>
                            <td class="py-2.5 text-default-800">Use Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">09</th>
                        </tr>
                        <tr>
                            <td class="py-2.5 text-default-800">Remaining Leave</td>
                            <th class="py-2.5 text-default-800 font-semibold">18</th>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
