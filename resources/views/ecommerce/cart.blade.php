@extends('layouts.vertical', ['title' => 'Shopping Cart'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Shopping Cart'])

    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="lg:col-span-3 col-span-1">
            <div class="flex justify-between gap-5 items-center mb-5">
                <h5 class="text-base text-default-800 font-semibold underline">Shopping Cart (3)</h5>
                <button class="flex items-center gap-1.25 text-danger">
                    <i class="size-4" data-lucide="trash-2"></i>
                    <span class="text-sm">Delete All</span>
                </button>
            </div>
            <div class="card p-5 mb-5">
                <div class="grid lg:grid-cols-12 grid-cols-1 gap-5">
                    <div class="lg:col-span-2 col-span-1">
                        <div class="p-4 rounded-md bg-default-150 flex justify-center">
                            <img alt="" class="" src="/images/product/img-08.png" />
                        </div>
                    </div>
                    <div class="lg:col-span-3 col-span-1 flex flex-col justify-between">
                        <div>
                            <h5 class="mb-1 text-base text-default-800 font-semibold">
                                <a href="{{ route('second', ['ecommerce', 'product-overview']) }}">Roar Twill Blue Baseball
                                    Cap</a>
                            </h5>
                            <p class="mb-2 text-default-500 text-sm"><a href="#">Men's Fashion</a></p>
                            <p class="mb-1 text-default-500 text-sm">Color: <span class="text-default-800">White/Blue</span>
                            </p>
                            <p class="mb-3 text-default-500 text-sm">Size: <span class="text-default-800">L</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-flex p-2 text-center border border-default-200 rounded">
                                <button class="size-7 btn minusBtn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="minus"></i>
                                </button>
                                <input class="text-center product-quantity ps-2 w-15 h-7 border-0 ring-0 bg-transparent"
                                    max="100" min="0" readonly="" type="number" value="2" />
                                <button class="size-7 plusBtn btn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="plus"></i>
                                </button>
                            </div>
                            <button aria-controls="cart-item-delete-modal" aria-expanded="false" aria-haspopup="dialog"
                                class="size-9.5 rounded bg-danger/15 justify-center items-center inline-flex text-danger hover:bg-danger hover:text-white transition-all duration-300"
                                data-hs-overlay="#cart-item-delete-modal" type="button">
                                <i class="size-4" data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="lg:col-span-7 col-span-1 flex lg:justify-end">
                        <div class="flex lg:flex-col flex-row w-full justify-between">
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span>149.99</span>
                                <small class="font-normal line-through text-default-500">$299.99</small>
                            </h6>
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span class="">299</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-5 mb-5">
                <div class="grid lg:grid-cols-12 grid-cols-1 gap-5">
                    <div class="lg:col-span-2 col-span-1">
                        <div class="p-4 rounded-md bg-default-150 flex justify-center">
                            <img alt="" class="" src="/images/product/img-04.png" />
                        </div>
                    </div>
                    <div class="lg:col-span-3 col-span-1 flex flex-col justify-between">
                        <div>
                            <h5 class="mb-1 text-base text-default-800 font-semibold">
                                <a href="{{ route('second', ['ecommerce', 'product-overview']) }}">Mesh Ergonomic Green
                                    Chair</a>
                            </h5>
                            <p class="mb-2 text-default-500 text-sm"><a href="#">Home, Kitchen, Pets</a></p>
                            <p class="mb-1 text-default-500 text-sm">Color: <span class="text-default-800">Green/Blue</span>
                            </p>
                            <p class="mb-3 text-default-500 text-sm">Size: <span class="text-default-800">M</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-flex p-2 text-center border border-default-200 rounded">
                                <button class="size-7 btn minusBtn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="minus"></i>
                                </button>
                                <input class="text-center product-quantity ps-2 w-15 h-7 border-0 ring-0 bg-transparent"
                                    max="100" min="0" readonly="" type="number" value="2" />
                                <button class="size-7 plusBtn btn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="plus"></i>
                                </button>
                            </div>
                            <button aria-controls="cart-item-delete-modal" aria-expanded="false" aria-haspopup="dialog"
                                class="size-9.5 rounded bg-danger/15 justify-center items-center inline-flex text-danger hover:bg-danger hover:text-white transition-all duration-300"
                                data-hs-overlay="#cart-item-delete-modal" type="button">
                                <i class="size-4" data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="lg:col-span-7 col-span-1 flex lg:justify-end">
                        <div class="flex lg:flex-col flex-row w-full justify-between">
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span>362.21 </span>
                                <small class="font-normal line-through text-default-500">$599.99</small>
                            </h6>
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span
                                    class="">362.21</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card p-5 mb-5">
                <div class="grid lg:grid-cols-12 grid-cols-1 gap-5">
                    <div class="lg:col-span-2 col-span-1">
                        <div class="p-4 rounded-md bg-default-150 flex justify-center">
                            <img alt="" class="" src="/images/product/img-01.png" />
                        </div>
                    </div>
                    <div class="lg:col-span-3 col-span-1 flex flex-col justify-between">
                        <div>
                            <h5 class="mb-1 text-base text-default-800 font-semibold">
                                <a href="{{ route('second', ['ecommerce', 'product-overview']) }}">Smartest Printed
                                    T-shirt</a>
                            </h5>
                            <p class="mb-2 text-default-500 text-sm"><a href="#">Unisex Fashion</a></p>
                            <p class="mb-1 text-default-500 text-sm">Color: <span
                                    class="text-default-800">Black/Blue</span></p>
                            <p class="mb-3 text-default-500 text-sm">Size: <span class="text-default-800">M</span></p>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="inline-flex p-2 text-center border border-default-200 rounded">
                                <button class="size-7 btn minusBtn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="minus"></i>
                                </button>
                                <input class="text-center product-quantity ps-2 w-15 h-7 border-0 ring-0 bg-transparent"
                                    max="100" min="0" readonly="" type="number" value="2" />
                                <button class="size-7 plusBtn btn bg-default-200" type="button">
                                    <i class="size-4 text-default-500" data-lucide="plus"></i>
                                </button>
                            </div>
                            <button aria-controls="cart-item-delete-modal" aria-expanded="false" aria-haspopup="dialog"
                                class="size-9.5 rounded bg-danger/15 justify-center items-center inline-flex text-danger hover:bg-danger hover:text-white transition-all duration-300"
                                data-hs-overlay="#cart-item-delete-modal" type="button">
                                <i class="size-4" data-lucide="trash-2"></i>
                            </button>
                        </div>
                    </div>
                    <div class="lg:col-span-7 col-span-1 flex lg:justify-end">
                        <div class="flex lg:flex-col flex-row w-full justify-between">
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span>89.99 </span>
                            </h6>
                            <h6 class="text-base text-end text-default-800 font-semibold">$<span
                                    class="">269.97</span>
                            </h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="sticky top-20">
                <div class="p-5 card mb-5">
                    <h6 class="card-title mb-4">Order Summary</h6>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <tbody class="table-total">
                                <tr class="text-sm">
                                    <td class="py-2 text-default-500"> Sub Total</td>
                                    <td class="py-2 text-default-500 cart-subtotal"> $932.16</td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="py-2 text-default-500"> Estimated Tax (18%)</td>
                                    <td class="py-2 text-default-500 cart-tax"> $167.79</td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="py-2 text-default-500">Item Discounts (12%)</td>
                                    <td class="py-2 text-default-500 cart-discount"> -$111.86</td>
                                </tr>
                                <tr class="text-sm">
                                    <td class="py-2 text-default-500"> Shipping Charge</td>
                                    <td class="py-2 text-default-500 cart-shipping"> $0</td>
                                </tr>
                                <tr class="font-semibold text-sm text-default-800">
                                    <td class="pt-2"> Total Amount (USD)</td>
                                    <td class="pt-2 cart-total"> $988.09</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2 mb-5">
                    <button class="btn bg-danger/90 text-white transition-all duration-300 hover:bg-danger"
                        type="button">Continue to Shopping
                    </button>
                    <button class="btn bg-primary/90 text-white transition-all duration-300 hover:bg-primary"
                        type="button">Checkout
                    </button>
                </div>
                <div class="p-5 card mb-5">
                    <div class="flex items-center gap-5">
                        <div class="btn bg-default-200 size-12">
                            <i class="size-6 text-default-500 fill-default-200" data-lucide="truck"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 text-default-800 font-semibold text-sm">Estimated Delivery</h6>
                            <p class="text-default-500 text-sm">01 - 07 Dec, 2023</p>
                        </div>
                    </div>
                </div>
                <div class="p-5 card">
                    <div class="flex items-center gap-5">
                        <div class="btn bg-default-200 size-12">
                            <i class="size-6 text-default-500 fill-default-200" data-lucide="container"></i>
                        </div>
                        <div>
                            <h6 class="mb-1 text-default-800 font-semibold text-sm">Free Shipping &amp; Returns</h6>
                            <p class="text-default-500 text-sm">On all orders over $200.00</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="cart-item-delete-modal"
        class="hs-overlay hidden size-full fixed top-0 start-0 z-80 overflow-x-hidden overflow-y-auto pointer-events-none"
        role="dialog" tabindex="-1" aria-labelledby="cart-item-delete-modal-label">
        <div
            class="hs-overlay-animation-target hs-overlay-open:scale-100 hs-overlay-open:opacity-100 scale-95 opacity-0 ease-in-out transition-all duration-200 md:w-sm m-3 sm:mx-auto min-h-[calc(100%-56px)] flex items-center">
            <div
                class="w-full flex flex-col bg-card border border-default-200 shadow-2xs rounded-xl pointer-events-auto dark:bg-neutral-800 dark:border-neutral-700 dark:shadow-neutral-700/70 px-6 py-8 relative">

                <div class="absolute top-3 end-3">
                    <button type="button" class="size-5 text-default-800" aria-label="Close"
                        data-hs-overlay="#cart-item-delete-modal">
                        <span class="sr-only">Close</span>
                        <i data-lucide="x" class="size-5"></i>
                    </button>
                </div>

                <h3 class="font-semibold text-base text-default-800 dark:text-white text-center">
                    <img src="/images/delete.png" alt="" class="size-12 mx-auto">

                    <div class="mt-5 text-center">
                        <h5 class="mb-1 text-lg font-semibold text-default-800">Are you sure?</h5>
                        <p class="text-default-500 text-sm font-normal">Are you certain you want to delete this record?</p>

                        <div class="mt-5 flex gap-2 md:justify-center">
                            <button data-hs-overlay="#cart-item-delete-modal"
                                class="py-2 px-4 text-[13px] rounded-md text-danger bg-transparent transition-all duration-300 hover:bg-red-50"
                                aria-label="Close" data-hs-overlay="#cart-item-delete-modal">Cancel</button>

                            <button class="btn bg-danger text-white">Yes,Delete It!</button>
                        </div>
                    </div>
                </h3>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/input-spin.js'])
@endsection
