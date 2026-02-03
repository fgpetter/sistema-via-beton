@extends('layouts.vertical', ['title' => 'Add New'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Add New'] )

    <div class="lg:flex justify-between items-center mb-5">
        <div>
            <h6 class="mb-1 card-title">New Invoice</h6>
        </div>
        <div class="flex flex-wrap items-center md:justify-end gap-2 md:mt-0 mt-4">
            <button class="bg-default-200 text-default-500 text-nowrap btn border-0 hover:bg-default-300"><i
                    class="size-4 me-1" data-lucide="eye"></i>Preview
            </button>
            <button class="bg-info/90 text-white btn text-nowrap border-0 hover:bg-info" onclick="window.print()">Save
                Draft
            </button>
            <button class="btn bg-primary text-white text-nowrap border-0"><i class="size-4 text-white me-1"
                                                                              data-lucide="save"></i>Save &amp; Download
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <h6 class="mb-4 text-default-800 underline text-base font-semibold">Generale Info:</h6>
            <div class="grid lg:grid-cols-4 grid-cols-1 gap-5 mb-6">
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="First Name">Invoice
                        No.
                    </label>
                    <input class="form-input" id="First Name" placeholder="Enter invoice no.." readonly="" type="text"
                           value="#TW15090251"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="invoiceNo">Invoice
                        Date</label>
                    <input class="form-input" data-date-format="d M, Y" data-provider="flatpickr" id="invoiceNo"
                           placeholder="Invoice Date" required="" type="date"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="InvoiceDue">Invoice
                        Due</label>
                    <input class="form-input" id="InvoiceDue" placeholder="Invoice Due" required="" type="date"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="legalRegistrationNo">Legal
                        Registration No.</label>
                    <input class="form-input" id="legalRegistrationNo" placeholder="Legal Registration No" required=""
                           type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="emailInvoiceInput">Email
                    </label>
                    <input class="form-input" id="emailInvoiceInput" placeholder="tailwick@themesdesign.in" required=""
                           type="email"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-default-800 text-sm font-medium"
                           for="websiteInput">Website</label>
                    <input class="form-input" id="websiteInput" placeholder="www.themesdesign.in" required=""
                           type="text"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-default-800 text-sm font-medium" for="contactInput">Contact
                        US</label>
                    <input class="form-input" id="contactInput" placeholder="(241) 1234 567 8900" required=""
                           type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="paymentStatus">Payment
                        Status</label>
                    <select class="form-input" placeholder="Select a country...">
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                        <option value="Cancel">Cancel</option>
                        <option value="Refund">Refund</option>
                    </select>
                </div>
            </div>
            <h6 class="mb-4 text-default-800 text-base underline font-semibold">Shipping Info:</h6>
            <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="fullNameShippingInput">Full
                        Name</label>
                    <input class="form-input" id="fullNameShippingInput" placeholder="Full Name" required=""
                           type="text"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="phoneNoShippingInput">Phone
                        No.</label>
                    <input class="form-input" id="phoneNoShippingInput" placeholder="(00) 1234 567 8956" required=""
                           type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                           for="alternativeNoShippingInput">Alternative No.</label>
                    <input class="form-input" id="alternativeNoShippingInput" placeholder="(00) 1234 567 8956"
                           required="" type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="taxShippingInput">TAX
                        No.</label>
                    <input class="form-input" id="taxShippingInput" placeholder="12-34567974" required=""
                           type="number"/>
                </div>
                <div class="lg:col-span-4 col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="addressShippingInput">Address</label>
                    <textarea class="form-input" id="addressShippingInput" placeholder="Address" rows="3"></textarea>
                </div>
            </div>
            <div class="mt-5">
                <div class="flex items-center gap-2">
                    <input class="form-switch" id="switchAddress" type="checkbox"/>
                    <label class="text-sm text-default-600" for="switchAddress">Will your Shipping &amp; Billing address
                        same?</label>
                </div>
            </div>
            <h6 class="my-5 text-default-800 text-base underline font-semibold">Billing Info:</h6>
            <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="fullNameBillingInput">Full
                        Name</label>
                    <input class="form-input" id="fullNameBillingInput" placeholder="Full Name" required=""
                           type="text"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="phoneNoBillingInput">Phone
                        No.</label>
                    <input class="form-input" id="phoneNoBillingInput" placeholder="(00) 1234 567 8956" required=""
                           type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                           for="alternativeNoBillingInput">Alternative No.</label>
                    <input class="form-input" id="alternativeNoBillingInput" placeholder="(00) 1234 567 8956"
                           required="" type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="taxBillingInput">TAX
                        No.</label>
                    <input class="form-input" id="taxBillingInput" placeholder="12-34567974" required="" type="number"/>
                </div>
                <div class="lg:col-span-4 grid-cols-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="addressBillingInput">Address</label>
                    <textarea class="form-input" id="addressBillingInput" placeholder="Address" rows="3"></textarea>
                </div>
            </div>
            <h6 class="my-4 text-default-800 text-base underline font-semibold">Products Info:</h6>
            <div class="overflow-x-auto">
                <table class="w-full whitespace-nowrap">
                    <thead>
                    <tr class="border border-default-200 text-default-500 text-center font-medium uppercase">
                        <th class="px-3.5 py-2.5">Item Name</th>
                        <th class="px-3.5 py-2.5">Quantity</th>
                        <th class="px-3.5 py-2.5">Price</th>
                        <th class="px-3.5 py-2.5">Discount</th>
                        <th class="px-3.5 py-2.5">TAX</th>
                        <th class="px-3.5 py-2.5 w-44">Total</th>
                    </tr>
                    </thead>
                    <tbody class="item-list">
                    <tr class="border border-default-200">
                        <td class="">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="Item Name" required="" type="text"/>
                        </td>
                        <td class="w-40 border rounded-xl border-default-200">
                            <div class="flex p-2 justify-center">
                                <button
                                    class="size-9 minusBtn border rounded-tr-0 rounded-br-0 border-default-200 flex justify-center items-center"
                                    type="button">
                                    <i class="size-4 text-default-500" data-lucide="minus"></i>
                                </button>
                                <input
                                    class="text-center ps-2 w-12 h-9 border-t border-b border-e-0 bg-transparent border-l-0 border-default-200 ring-0 product-quantity focus:shadow-none"
                                    max="100" min="0" readonly="" type="number" value="2"/>
                                <button
                                    class="size-9 plusBtn rounded-tl-0 rounded-bl-0 border border-default-200 flex justify-center items-center"
                                    type="button">
                                    <i class="size-4 text-default-500" data-lucide="plus"></i>
                                </button>
                            </div>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="$00.00" required="" type="text"/>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="0%" required="" type="text"/>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="0%" required="" type="text"/>
                        </td>
                        <td class="border border-default-200" rowspan="2">
                            <div class="mb-1">
                                <input
                                    class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                    id="ItemTotal" placeholder="$00.00" readonly="" required="" type="text"/>
                            </div>
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemDiscountsInput" placeholder="-$00.00" readonly="" required="" type="text"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemdescription1" placeholder="Enter Description (Optional)" required=""
                                type="text"/>
                        </td>
                        <td class="border border-default-200" colspan="3"></td>
                    </tr>
                    </tbody>
                    <tbody class="before:block before:h-3 item-list">
                    <tr class="item">
                        <td class="border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="Item Name" required="" type="text"/>
                        </td>
                        <td class="w-40 border rounded-xl border-default-200">
                            <div class="flex p-2 justify-center">
                                <button
                                    class="size-9 minusBtn border rounded-tr-0 rounded-br-0 border-default-200 flex justify-center items-center"
                                    type="button">
                                    <i class="size-4 text-default-500" data-lucide="minus"></i>
                                </button>
                                <input
                                    class="text-center ps-2 w-12 h-9 border-t bg-transparent border-b border-e-0 border-l-0 border-default-200 ring-0 product-quantity focus:shadow-none"
                                    max="100" min="0" readonly="" type="number" value="2"/>
                                <button
                                    class="size-9 plusBtn rounded-tl-0 rounded-bl-0 border border-default-200 flex justify-center items-center"
                                    type="button">
                                    <i class="size-4 text-default-500" data-lucide="plus"></i>
                                </button>
                            </div>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="$00.00" required="" type="number"/>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="0%" required="" type="text"/>
                        </td>
                        <td class="w-40 border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemName1" placeholder="0%" required="" type="text"/>
                        </td>
                        <td class="border border-default-200" rowspan="2">
                            <div class="mb-1">
                                <input
                                    class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                    id="ItemTotal" placeholder="$00.00" readonly="" type="text"/>
                            </div>
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemDiscountsInput" placeholder="-$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    <tr>
                        <td class="border border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-500 placeholder:text-default-400 ring-0"
                                id="itemdescription1" placeholder="Enter Description (Optional)" required=""
                                type="text"/>
                        </td>
                        <td class="border border-default-200" colspan="3"></td>
                    </tr>
                    </tbody>
                    <tbody class="before:block before:h-4" id="invoiceTable">
                    <tr>
                        <td colspan="6">
                            <a href="javascript:void(0)" id="addBtn">
                                <button
                                    class="btn border border-primary w-auto bg-transparent text-primary border-dashed hover:bg-primary/10">
                                    <i class="size-3 me-2" data-lucide="plus"></i>
                                    Add Item
                                </button>
                            </a>
                        </td>
                    </tr>
                    </tbody>
                    <tbody class="before:block before:h-3" id="totalAmount">
                    <tr class="text-default-800">
                        <td colspan="4"></td>
                        <td class="border-b border-default-200 text-default-500 text-sm">
                            Sub Total
                        </td>
                        <td class="font-medium border-b border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-800 placeholder:text-default-800 ring-0"
                                id="subTotale" placeholder="$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    <tr class="text-default-800">
                        <td colspan="4"></td>
                        <td class="border-b border-default-200 text-default-600 text-sm">
                            Estimated Tax (18%)
                        </td>
                        <td class="font-medium border-b border-default-200 text-default-600 text-sm">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-800 placeholder:text-default-800 ring-0"
                                id="subTotale" placeholder="$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    <tr class="text-default-800">
                        <td colspan="4"></td>
                        <td class="border-b border-default-200 text-default-600 text-sm">
                            Item Discounts
                        </td>
                        <td class="font-medium border-b border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-800 placeholder:text-default-800 ring-0"
                                id="subTotale" placeholder="$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    <tr class="text-default-800">
                        <td colspan="4"></td>
                        <td class="border-b border-default-200 text-default-600 text-sm">
                            Shipping Charge
                        </td>
                        <td class="font-medium border-b border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-800 placeholder:text-default-800 ring-0"
                                id="subTotale" placeholder="$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    <tr class="text-default-800">
                        <td colspan="4"></td>
                        <td class="border-b border-default-200 text-default-600 text-sm">
                            Total Amount
                        </td>
                        <td class="font-medium border-b border-default-200">
                            <input
                                class="bg-transparent block w-full border-0 rounded-md text-sm text-default-800 placeholder:text-default-800 ring-0"
                                id="subTotale" placeholder="$00.00" readonly="" type="text"/>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <h6 class="mb-4 text-text-default-800 underline text-sm font-semibold">Payments Details:</h6>
            <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="paymentMethod">Full
                        Name</label>
                    <select class="form-input" data-kt-select="" id="paymentMethod" name="paymentMethod">
                        <option value="">Select Method</option>
                        <option value="Credit Card">Credit Card</option>
                        <option value="Paypal">Paypal</option>
                        <option value="Paypal">Paypal</option>
                        <option value="American Express">American Express</option>
                    </select>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="cardHolderName">Card
                        Holder Name</label>
                    <input autocomplete="cc-number" class="form-input" id="cardHolderName" inputmode="numeric"
                           maxlength="19" pattern="[0-9\s]{13,19}" placeholder="Full Name" required="" type="number"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="cardNumber">Card
                        Number</label>
                    <input class="form-input" id="cardNumber" placeholder="xxxx xxxx xxxx xxxx" required=""
                           type="text"/>
                </div>
                <div class="col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="totalPayment">Total
                        Payment</label>
                    <input class="form-input" id="totalPayment" placeholder="$00.00" required="" type="text"/>
                </div>
                <div class="lg:col-span-4 col-span-1">
                    <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                           for="taxBillingInput">Notes</label>
                    <textarea class="form-input" id="taxBillingInput"
                              placeholder="Enter notes pertaining to the customer or payment" rows="3"></textarea>
                </div>
            </div>
            <div class="flex justify-end items-center mt-5">
                <div class="flex flex-wrap items-center gap-2">
                    <button class="bg-default-200 text-default-500 text-nowrap border-0 btn hover:bg-default-300"><i
                            class="size-4 me-1" data-lucide="refresh-ccw"></i>Reset
                    </button>
                    <button class="text-white border-0 btn text-nowrap bg-primary"><i class="size-4 me-1"
                                                                                      data-lucide="save"></i>Save
                    </button>
                    <button class="bg-teal-600 border-0 text-nowrap text-white btn hover:bg-tral-700"><i
                            class="size-4 me-1" data-lucide="download"></i>Download
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/input-spin.js'])
@endsection
