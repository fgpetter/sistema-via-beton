@extends('layouts.vertical', ['title' => 'Order Overview'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Order Overview'] )
    <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between">
                    <div>
                        <h6 class="mb-4 card-title">Shipping Details</h6>
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Pauline Hylton</h6>
                        <p class="mb-1 text-default-500 text-sm">1235 Crossing Meadows Dr, Onalaska</p>
                        <p class="text-default-500 text-sm">West Virginia, USA</p>
                    </div>
                    <div class="btn bg-secondary/10 text-secondary size-12 float-end">
                        <i class="text-2xl" data-lucide="truck"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between">
                    <div>
                        <h6 class="mb-4 card-title">Billing Details</h6>
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Pauline Hylton</h6>
                        <p class="mb-1 text-default-500 text-sm">1235 Crossing Meadows Dr, Onalaska</p>
                        <p class="text-default-500 text-sm">West Virginia, USA</p>
                    </div>
                    <div class="btn bg-danger/10 text-danger size-12 float-end">
                        <i class="text-2xl" data-lucide="credit-card"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between">
                    <div>
                        <h6 class="mb-4 card-title">Payment Details</h6>
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">ID: #TSD456DF41SD5</h6>
                        <p class="mb-1 text-default-500 text-sm">Payment Method: <b>Credit Card</b></p>
                        <p class="mb-1 text-default-500 text-sm">Card Number: <b>xxxx xxxx xxxx 1501</b></p>
                    </div>
                    <div class="btn bg-info/10 text-info size-12 float-end">
                        <i class="text-2xl" data-lucide="circle-dollar-sign"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="flex justify-between">
                    <div>
                        <h6 class="mb-4 card-title">Customer Info</h6>
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">Pauline Hylton</h6>
                        <p class="mb-1 text-default-500 text-sm">pauline@tailwick.com</p>
                        <p class="text-default-500 text-sm">+(78) 120 4843 4714</p>
                    </div>
                    <div class="btn bg-warning/20 text-info size-12 float-end">
                        <img alt="" src="/images/user/avatar-4.png"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-3 col-span-1">
            <div class="grid lg:grid-cols-5 md:grid-cols-2 grid-cols-1 gap-5 mb-5">
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">#TWT5015100366</h6>
                        <p class="uppercase text-default-500 text-sm">Order ID</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">02 Nov, 2023</h6>
                        <p class="uppercase text-default-500 text-sm">Order Date</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">09 Nov, 2023</h6>
                        <p class="uppercase text-default-500 text-sm">Delivery Date</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <h6 class="mb-1 text-default-800 font-semibold text-sm">$843.49</h6>
                        <p class="uppercase text-default-500 text-sm">Order Amount</p>
                    </div>
                </div>
                <div class="card text-center">
                    <div class="card-body">
                        <span
                            class="py-0.5 px-2.5 font-semibold uppercase border border-secondary/30 text text-secondary rounded inline-block mb-2 text-xs bg-secondary/10">Shipping</span>
                        <p class="uppercase text-default-500 text-sm">Order Status</p>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-body">
                    <div class="flex justify-between gap-5 items-center">
                        <h6 class="mb-4 card-title">Orders Summary</h6>
                        <a class="text-danger text-sm underline" href="#">Cancelled Order</a>
                    </div>
                    <div>
                        <div
                            class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                            <div class="flex items-center gap-3">
                                <div class="btn rounded-md size-12 bg-default-100">
                                    <img alt="" class="h-8" src="/images/product/img-08.png"/>
                                </div>
                                <div>
                                    <h6 class="mb-1 card-title">
                                        <a class="transition-all duration-300 ease-linear hover:text-primary"
                                           href="{{ route('second', ['ecommerce', 'product-overview'])}}">Roar Twill Blue Baseball Cap</a>
                                    </h6>
                                    <p class="text-default-500 text-sm">$149.99 x 02</p>
                                </div>
                            </div>
                            <span class="text-sm">$299.98</span>
                        </div>
                        <div
                            class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                            <div class="flex items-center gap-3">
                                <div class="btn rounded-md size-12 bg-default-100">
                                    <img alt="" class="h-8" src="/images/product/img-04.png"/>
                                </div>
                                <div>
                                    <h6 class="mb-1 card-title"><a
                                            class="transition-all duration-300 ease-linear hover:text-primary"
                                            href="{{ route('second', ['ecommerce', 'product-overview'])}}">Mesh Ergonomic Green Chair</a>
                                    </h6>
                                    <p class="text-default-500 text-sm">$362.21 x 1</p>
                                </div>
                            </div>
                            <span class="text-sm">$362.21</span>
                        </div>
                        <div
                            class="flex justify-between items-center gap-5 py-4 border-b border-dashed border-default-200">
                            <div class="flex items-center gap-3">
                                <div class="btn rounded-md size-12 bg-default-100">
                                    <img alt="" class="h-8" src="/images/product/img-01.png"/>
                                </div>
                                <div>
                                    <h6 class="mb-1 card-title"><a
                                            class="transition-all duration-300 ease-linear hover:text-primary"
                                            href="{{ route('second', ['ecommerce', 'product-overview'])}}">Smartest Printed T-shirt</a>
                                    </h6>
                                    <p class="text-default-500 text-sm">$89.99 x 03</p>
                                </div>
                            </div>
                            <span class="text-sm">$269.97</span>
                        </div>
                        <div class="flex justify-between items-center gap-5 py-3 text-sm">
                            <span class="text-default-500">Sub Total </span>
                            <span class="text-default-800">$932.16</span>
                        </div>
                        <div class="flex justify-between items-center gap-5 py-3 text-sm">
                            <span class="text-default-500">Estimated Tax (18%) </span>
                            <span class="text-default-800">$167.79</span>
                        </div>
                        <div class="flex justify-between items-center gap-5 py-3 text-sm">
                            <span class="text-default-500">Item Discounts (12%)</span>
                            <span class="text-default-800">-$111.86</span>
                        </div>
                        <div class="flex justify-between items-center gap-5 py-3 text-sm">
                            <span class="text-default-500">Shipping Charge </span>
                            <span class="text-default-800">$0</span>
                        </div>
                        <div class="flex justify-between items-center gap-5 pt-4 font-semibold text-sm">
                            <span class="text-default-500">Total Amount (USD) </span>
                            <span class="text-default-800">$988.09</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-body">
                    <div class="flex justify-between gap-5 items-center mb-4">
                        <h6 class="card-title">Order Status</h6>
                        <div class="flex items-center gap-3">
                            <a class="text-danger underline text-sm" href="#">Cancelled Order</a>
                            <a class="btn btn-sm bg-primary text-white"
                               href="{{ route('second', ['apps', 'invoice-overview']) }}">
                                <i class="size-4 me-1" data-lucide="download"></i>
                                Invoice
                            </a>
                        </div>
                    </div>
                    <div>
                        <div
                            class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-primary before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                            <div class="flex justify-between">
                                <div>
                                    <h6 class="mb-2 card-title">Order Placed</h6>
                                    <p class="text-default-500 text-sm">Your order has been successfully submitted.</p>
                                </div>
                                <p class="text-[13px] text-default-400">02 Nov, 2023</p>
                            </div>
                        </div>
                        <div
                            class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-primary before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                            <div class="flex justify-between">
                                <div>
                                    <h6 class="mb-2 card-title">Order Processing</h6>
                                    <p class="text-default-500 text-sm">Once the order is received, it goes through the
                                        processing stage. During this time, the items are gathered, and the order is
                                        prepared for shipment.</p>
                                </div>
                                <p class="text-[13px] text-default-400">02 Nov, 2023</p>
                            </div>
                        </div>
                        <div
                            class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-primary before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                            <div class="flex justify-between">
                                <div>
                                    <h6 class="mb-2 card-title">Shipped Order</h6>
                                    <p class="text-default-500 text-sm">The order is shipped out to the customer's
                                        designated delivery address.</p>
                                </div>
                                <p class="text-[13px] text-default-400">04 Nov, 2023</p>
                            </div>
                        </div>
                        <div
                            class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-primary before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                            <div class="flex justify-between">
                                <div>
                                    <h6 class="mb-2 card-title">Out for Delivery</h6>
                                    <p class="text-default-500 text-sm">This status indicates that the order is
                                        currently out for delivery by the shipping or courier company.</p>
                                </div>
                                <p class="text-[13px] text-default-400">06 Nov, 2023</p>
                            </div>
                        </div>
                        <div
                            class="relative px-6 before:absolute before:start-0.75 before:border-primary before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                            <div class="flex justify-between">
                                <div>
                                    <h6 class="mb-2 card-title">Delivered</h6>
                                    <p class="text-default-500 text-sm">Finally, when the order successfully reaches the
                                        customer's address and is handed over, the status changes to "Delivered."</p>
                                </div>
                                <p class="text-[13px] text-default-400">09 Nov, 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card mb-5">
                <div class="card-body">
                    <h6 class="mb-3 card-title">Documents</h6>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody>
                            <tr>
                                <td class="pe-3.5 py-2 text-default-500 text-sm">Invoice No.</td>
                                <td class="ps-3.5 py-2 text-sm"><a class="text-primary"
                                                                   href="{{ route('second', ['apps', 'invoice-overview']) }}">#TWI154203</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-3.5 py-2 text-sm text-default-500">Shipping No</td>
                                <td class="ps-3.5 py-2 text-sm"><a class="text-primary" href="#">#TWS987102301</a></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between gap-3 mb-4">
                        <h6 class="card-title">Logistics Details</h6>
                        <a class="underline text-primary" href="#">Track Order</a>
                    </div>
                    <div class="gap-4 flex">
                        <img alt="" class="h-10" src="/images/brand/delivery-1.png"/>
                        <div>
                            <h6 class="mb-1 card-title">Express Delivery</h6>
                            <p class="text-default-500 text-sm">ID: EDTW1400457854</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
