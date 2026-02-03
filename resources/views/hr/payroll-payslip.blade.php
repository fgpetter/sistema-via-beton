@extends('layouts.vertical', ['title' => 'Payslip'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Payslip'] )
    <div class="lg:w-5xl w-full mx-auto">
        <div class="card relative">
            <div class="card-body">
                <div class="absolute top-0 end-0 opacity-30">
                    <img alt="" src="/images/download.png"/>
                </div>
                <div class="text-center">
                    <h5 class="inline-block relative text-lg text-default-800 font-semibold">
                        Salary Slip
                        <span
                            class="absolute start-0 end-0 -bottom-2 h-0.25 bg-gradient-to-r from-white via-primary to-white"></span>
                    </h5>
                </div>
                <div class="mt-16 text-sm">
                    <p class="mb-2 text-default-500">Employee ID: <span class="font-semibold text-default-800">#TWE1001524</span>
                    </p>
                    <p class="mb-2 text-default-500">Employee Name: <span class="font-semibold text-default-800">Patricia Garcia</span>
                    </p>
                    <p class="mb-2 text-default-500">Experience: <span
                            class="font-semibold text-default-800">2 Year</span></p>
                    <p class="text-default-500">Create Date: <span
                            class="font-semibold text-default-800">08 Oct 2023</span></p>
                </div>
                <div class="flex flex-col mt-10">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                    <tr class="text-sm font-normal text-default-800 whitespace-nowrap">
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Month</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Salary Amount</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Deductions(TDS)</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Professional Tax</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Provident Fund</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Net Payable</th>
                                        <th class="px-3.5 py-2.5 text-start" scope="col">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">Oct, 2023</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$25,000</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> $800</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$150</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm"> $500</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$23,550</td>
                                        <td class="px-3.5 py-2.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/20">Paid</span>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">Nov, 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$25,000</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$800</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$150</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$500</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$23,550</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/20">Paid</span>
                                        </td>
                                    </tr>
                                    <tr class="text-default-800 font-normal">
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">Dec, 2023</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$25,000</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$800</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$150</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$500</td>
                                        <td class="px-4 py-3 whitespace-nowrap text-sm">$23,550</td>
                                        <td class="px-4 py-3 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/10 text-success border border-success/20">Paid</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

@endsection
