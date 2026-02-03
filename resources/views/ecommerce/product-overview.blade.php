@extends('layouts.vertical', ['title' => 'Product Overview'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Overview'] )

    <div class="grid lg:grid-cols-3 grid-cols-1 lg:gap-5">
        <div class="col-span-1">
            <div class="sticky top-24">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="grid md:grid-cols-3 grid-cols-1 gap-5 mb-5">
                            <div class="md:col-span-2 grid-cols-1">
                                <div class="rounded-md bg-default-100">
                                    <img alt="" src="/images/product/overview-01.png"/>
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="rounded-md bg-default-100 mb-5">
                                    <img alt="" src="/images/product/overview-02.png"/>
                                </div>
                                <div class="rounded-md bg-default-100">
                                    <img alt="" src="/images/product/img-01.png"/>
                                </div>
                            </div>
                        </div>
                        <div class="grid md:grid-cols-3 grid-cols-1 gap-5">
                            <div class="rounded-md bg-default-100">
                                <img alt="" src="/images/product/img-09.png"/>
                            </div>
                            <div class="rounded-md bg-default-100">
                                <img alt="" src="/images/product/img-12.png"/>
                            </div>
                            <div class="rounded-md bg-default-100">
                                <img alt="" src="/images/product/img-13.png"/>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 mt-4">
                            <a class="border border-primary w-full rounded btn text-primary hover:bg-primary/10 border-dashed"
                               href="{{ route('second', ['ecommerce', 'cart'])}}">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </a>
                            <button class="bg-danger/85 w-full rounded btn text-white hover:bg-danger">
                                Buy Now
                            </button>
                        </div>
                        <div class="flex items-center gap-3 mt-3 justify-evenly">
                            <a class="flex items-center gap-1.25 text-default-700 text-sm transition-all duration-300 hover:text-primary"
                               href="#">
                                <i class="size-3" data-lucide="repeat"></i>
                                <span class="align-middle">Compare</span>
                            </a>
                            <a class="flex items-center gap-1.25 text-default-700 text-sm transition-all duration-300 hover:text-primary"
                               href="#">
                                <i class="size-3" data-lucide="help-circle"></i>
                                <span class="align-middle">Ask a Question</span>
                            </a>
                            <a class="flex items-center gap-1.25 text-default-700 text-sm transition-all duration-300 hover:text-primary"
                               href="#">
                                <i class="size-3" data-lucide="share-2"></i>
                                <span class="align-middle">Share</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body border-b border-b-default-200">
                        <div class="flex justify-between flex-wrap gap-5">
                            <h6 class="text-default-800 font-semibold text-[15px] flex items-center gap-1.25">
                                <i class="size-4" data-lucide="store"></i>
                                Themesdesign
                            </h6>
                            <span class="flex items-center gap-1.25 text-default-700">
<i class="size-4 text-yellow-500" data-lucide="star"></i>
                                            (4.8)
                                        </span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="flex gap-5 justify-between">
                            <h6 class="text-default-800 font-semibold text-[15px] flex items-center gap-1.25">
                                <i class="size-4 text-orange-500" data-lucide="store"></i>
                                California, USA
                            </h6>
                            <button class="text-white btn btn-sm btn-primary">View Store</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
                <div class="card-body">
                    <div class="flex justify-between items-center">
                        <span class="px-2.5 py-0.5 text-xs inline-block font-semibold rounded bg-info/10 text-info">New Arrivals</span>
                        <div class="hs-dropdown relative inline-flex">
                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                    hs-dropdown-placement="bottom-end" type="button">
                                <i class="iconify lucide--ellipsis size-4"></i>
                            </button>
                            <div class="hs-dropdown-menu" role="menu">
                                <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                   href="#">
                                    <i class="size-3" data-lucide="edit"></i>
                                    Edit
                                </a>
                                <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                   href="#">
                                    <i class="size-3" data-lucide="trash-2"></i>
                                    Delete
                                </a>
                            </div>
                        </div>
                    </div>
                    <h5 class="mt-3 mb-1 text-xl text-default-800 font-semibold">Smartees Printed Men Round Neck
                        Pink</h5>
                    <ul class="flex flex-wrap text-sm items-center gap-4 mb-5 text-default-500">
                        <li><a class="font-medium underline text-primary text-sm" href="#!">Rossie Fadel</a></li>
                        <li>Seller: <a class="font-medium text-sm" href="#!">Themesdesign</a></li>
                        <li>Published: <span class="font-medium text-sm">20 Oct, 2023</span></li>
                    </ul>
                    <div class="flex flex-wrap items-center gap-3 mb-4">
                        <div class="flex items-center gap-2 text-yellow-500">
                            <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                            <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                            <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                            <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                            <i class="size-4 fill-yellow-500" data-lucide="star-half"></i>
                            <div class="text-default-800 text-sm">
                                <h6>(4.8)</h6>
                            </div>
                        </div>
                        <div class="text-default-800 text-sm">
                            <h6>973 Reviews</h6>
                        </div>
                        <div class="text-default-800 text-sm">
                            <h6>1,231 Sold</h6>
                        </div>
                    </div>
                    <div class="mb-4">
                        <p class="mb-1 text-success text-sm">Special Price</p>
                        <h4 class="text-default-900 font-semibold text-xl">$487.32 <small
                                class="font-normal text-base line-through align-middle text-default-500">$599.99</small>
                            <small class="text-success text-base align-middle">20% Off</small></h4>
                    </div>
                    <h6 class="mb-3 text-[15px] font-semibold text-default-800">Select Color</h6>
                    <div class="flex gap-2">
                        <input class="form-radio rounded-sm size-5 text-primary" id="color1" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-red-300" id="color2" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-green-300" id="color3" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-default-500" id="color4" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-purple-500" id="color5" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-sky-500" id="color6" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-yellow-500" id="color7" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-green-500" id="color8" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-default-800" id="color9" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-default-200" id="color10" name="SelectColor"
                               type="radio"/>
                        <input class="form-radio rounded-sm size-5 text-emerald-300" id="color11" name="SelectColor"
                               type="radio"/>
                    </div>
                    <h6 class="mt-5 mb-3 card-title">Select Size</h6>
                    <div class="flex gap-2 items-center">
                        <button
                            class="btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            XS
                        </button>
                        <button
                            class="active btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            S
                        </button>
                        <button
                            class="btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            M
                        </button>
                        <button
                            class="btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            L
                        </button>
                        <button
                            class="btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            XL
                        </button>
                        <button
                            class="btn size-8 text-xs text-default-500 border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                            2XL
                        </button>
                    </div>
                    <h6 class="mt-5 mb-3 card-title">Available Offers (4)</h6>
                    <div class="flex gap-2 flex-col">
                        <div class="flex gap-1.75 items-center">
                            <div>
                                <i class="size-4 text-success fill-success/20" data-lucide="tag"></i>
                            </div>
                            <div class="text-default-700 text-sm">
                                <span class="text-default-800 font-semibold">Bank Offer</span> 10% Instant Discount on
                                Paypal, up to $1250 on orders of $5,000 and above
                                <a class="underline text-primary" href="#">T&amp;C</a>
                            </div>
                        </div>
                        <div class="flex gap-1.75 items-center text-sm">
                            <div>
                                <i class="size-4 text-success fill-success/20" data-lucide="tag"></i>
                            </div>
                            <div class="text-default-700 text-sm">
                                <span class="text-default-800 font-semibold"> Special Price</span> Get at flat $199
                                <a class="underline text-primary" href="#">T&amp;C</a>
                            </div>
                        </div>
                        <div class="flex gap-1.75 items-center text-sm">
                            <div>
                                <i class="size-4 text-success fill-success/20" data-lucide="tag"></i>
                            </div>
                            <div class="text-default-700">
                                <span class="text-default-800 font-semibold"> Partner Offer</span> Purchase now &amp;
                                get 1 surprise cashback coupon in Future
                                <a class="underline text-primary" href="#">Know More</a>
                            </div>
                        </div>
                        <div class="flex gap-1.75 items-center text-sm">
                            <div>
                                <i class="size-4 text-success fill-success/20" data-lucide="tag"></i>
                            </div>
                            <div class="text-default-700">
                                <span class="text-default-800 font-semibold"> Bank Offer </span> UPI Offer Men's
                                Clothing
                                <a class="underline text-primary" href="#">T&amp;C</a>
                            </div>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-3 my-5">
                        <div class="flex items-center gap-5 p-4 border rounded-md border-default-200">
                            <div class="flex items-center justify-center">
                                <i class="size-6 text-default-500 fill-default-200" data-lucide="truck"></i>
                            </div>
                            <div class="text-default-700 text-sm">
                                <h6 class="mb-2 text-default-800 font-semibold">Estimated Delivery</h6>
                                <p>01 - 07 Dec, 2023</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-5 p-4 border rounded-md border-default-200">
                            <div class="flex items-center justify-center">
                                <i class="size-6 text-default-500 fill-default-200" data-lucide="container"></i>
                            </div>
                            <div class="text-default-700 text-sm">
                                <h6 class="mb-2 text-default-800 font-semibold">Free Shipping &amp; Returns</h6>
                                <p>On all orders over $200.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-5">
                        <h6 class="card-title mb-3">Product Description:</h6>
                        <p class="mb-2 text-sm text-default-600">Latest <b>Trends</b> in Fashion Clothing. Currently,
                            the latest clothing trends for women on FabAlley include playful check print, breezy floral
                            motif, bold red hue, cool denim fabric, quirky polka dot and romantic ruffles.</p>
                        <p class="text-default-600 text-sm"><b>Avoid shapeless and baggy clothing</b>. Stay away from
                            pieces with extra fabric at the hips or bust to keep your look proportionate. Avoid wearing
                            ruffles or pleats around your waist or hips. Be sure to wear supportive undergarments that
                            fit you well!</p>
                    </div>
                    <div class="mt-5">
                        <h6 class="card-title">Features:</h6>
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start text-sm w-64 text-default-500">
                                        Type
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">Round Neck</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Sleeve
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">Half Sleeve</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Fit
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">Regular</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Fabric
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">Cotton Blend</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Pack of
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">1</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Product Code
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">TWT1542</td>
                                </tr>
                                <tr>
                                    <th class="px-3.5 py-2.5 font-semibold text-start w-64 text-default-500 text-sm">
                                        Ideal for
                                    </th>
                                    <td class="px-3.5 py-2.5 text-sm text-default-700">Women</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <h6 class="mt-5 mb-3 card-title">Ratings &amp; Reviews</h6>
                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
                        <div class="col-span-1">
                            <div class="card-body border border-dashed border-default-200 rounded-md">
                                <div class="text-center">
                                    <h5 class="mb-2 text-base font-semibold text-default-800">Customer Ratings</h5>
                                    <span
                                        class="px-3.5 py-1.5 text-default-500 inline-flex gap-3 text-xs font-medium rounded-full border bg-default-100 border-default-200">
<span class="flex items-center gap-2 text-yellow-500">
<i class="size-3 fill-yellow-500" data-lucide="star"></i>
<i class="size-3 fill-yellow-500" data-lucide="star"></i>
<i class="size-3 fill-yellow-500" data-lucide="star"></i>
<i class="size-3 fill-yellow-500" data-lucide="star"></i>
<i class="size-3 fill-yellow-500" data-lucide="star-half"></i>
</span>
                                                    (4.8 out of 5)
                                                </span>
                                    <p class="mt-2 text-[13px] text-default-500">4,213 total ratings</p>
                                </div>
                                <div class="flex flex-col gap-3 mt-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center text-default-800 text-[13px]"> 5 <i
                                                class="size-3.25 fill-yellow-500 ms-1 text-yellow-500"
                                                data-lucide="star"></i></div>
                                        <div class="w-full h-1.5 rounded-full bg-default-200">
                                            <div class="h-1.5 rounded-full bg-success" style="width: 79%"></div>
                                        </div>
                                        <div class="text-end w-10 text-default-800 text-[13px]">
                                            1,210
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center text-default-800 text-[13px]"> 4 <i
                                                class="size-3.25 fill-yellow-500 ms-1 text-yellow-500"
                                                data-lucide="star"></i></div>
                                        <div class="w-full h-1.5 rounded-full bg-default-200">
                                            <div class="h-1.5 rounded-full bg-secondary" style="width: 66%"></div>
                                        </div>
                                        <div class="text-end w-10 text-default-800 text-[13px]">
                                            1,174
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center text-default-800 text-[13px]"> 3 <i
                                                class="size-3.25 fill-yellow-500 ms-1 text-yellow-500"
                                                data-lucide="star"></i></div>
                                        <div class="w-full h-1.5 rounded-full bg-default-200">
                                            <div class="h-1.5 rounded-full bg-info" style="width: 45%"></div>
                                        </div>
                                        <div class="text-end w-10 text-default-800 text-[13px]">
                                            762
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center text-default-800 text-[13px]"> 2 <i
                                                class="size-3.25 fill-yellow-500 ms-1 text-yellow-500"
                                                data-lucide="star"></i></div>
                                        <div class="w-full h-1.5 rounded-full bg-default-200">
                                            <div class="h-1.5 rounded-full bg-warning" style="width: 22%"></div>
                                        </div>
                                        <div class="text-end w-10 text-default-800 text-[13px]">
                                            274
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div class="flex items-center text-default-800 text-[13px]"> 1 <i
                                                class="size-3.25 fill-yellow-500 ms-1 text-yellow-500"
                                                data-lucide="star"></i></div>
                                        <div class="w-full h-1.5 rounded-full bg-default-200">
                                            <div class="h-1.5 rounded-full bg-danger" style="width: 5%"></div>
                                        </div>
                                        <div class="text-end w-10 text-default-800 text-[13px]">
                                            32
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="lg:col-span-2 col-span-1">
                            <div class="flex justify-between items-center gap-5">
                                <h6 class="text-default-800 font-semibold text-[15px]">Reviews</h6>
                                <button class="text-white btn btn-sm btn-primary">Add Review</button>
                            </div>
                            <div class="mt-3">
                                <div class="flex justify-between items-center gap-5">
                                    <div class="flex gap-3 items-center">
                                        <div class="bg-sky-50 rounded-full">
                                            <img alt="" class="h-10 rounded-full" src="/images/user/avatar-2.png"/>
                                        </div>
                                        <div>
                                            <h6 class="card-title"><a href="#">Aubrey Beer</a></h6>
                                            <p class="text-[13px] text-default-500">on 14 Jan, 2024</p>
                                        </div>
                                    </div>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle flex justify-center items-center size-7.5 text-sm font-semibold rounded-md bg-default-100 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div class="hs-dropdown-menu" role="menu">
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="edit"></i>
                                                Edit
                                            </a>
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="trash-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4 mb-2 text-yellow-500">
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star-half"></i>
                                </div>
                                <p class="text-default-500 text-sm">"Nice product good quality and looking"</p>
                                <div class="flex items-center gap-3 mt-3">
                                    <a class="text-success flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-up"></i>
                                        <span class="text-sm">15</span>
                                    </a>
                                    <a class="text-danger flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-down"></i>
                                        <span class="text-sm">3</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-default-200">
                                <div class="flex justify-between items-center gap-5">
                                    <div class="flex gap-3 items-center">
                                        <div class="bg-default-200 rounded-full">
                                            <img alt="" class="h-10 rounded-full" src="/images/user/avatar-11.png"/>
                                        </div>
                                        <div>
                                            <h6 class="card-title"><a href="#">Theodora Jones</a></h6>
                                            <p class="text-[13px] text-default-500">on 20 July, 2023</p>
                                        </div>
                                    </div>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle flex justify-center items-center size-7.5 text-sm font-semibold rounded-md bg-default-100 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div class="hs-dropdown-menu" role="menu">
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="edit"></i>
                                                Edit
                                            </a>
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="trash-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4 mb-2 text-yellow-500">
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5" data-lucide="star"></i>
                                </div>
                                <p class="text-default-500 text-sm">"Amazing! Fast, to the point, professional and
                                    really amazing to work with them!!!"</p>
                                <div class="flex items-center gap-3 mt-3">
                                    <a class="text-success flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-up"></i>
                                        <span class="text-sm">77</span>
                                    </a>
                                    <a class="text-danger flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-down"></i>
                                        <span class="text-sm">26</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-default-200">
                                <div class="flex justify-between items-center gap-5">
                                    <div class="flex gap-3 items-center">
                                        <div class="bg-yellow-100 rounded-full">
                                            <img alt="" class="h-10 rounded-full" src="/images/user/avatar-5.png"/>
                                        </div>
                                        <div>
                                            <h6 class="card-title"><a href="#">Jordane Dare</a></h6>
                                            <p class="text-default-500">on 07 Dec, 2023</p>
                                        </div>
                                    </div>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle flex justify-center items-center size-7.5 text-sm font-semibold rounded-md bg-default-100 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div class="hs-dropdown-menu" role="menu">
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="edit"></i>
                                                Edit
                                            </a>
                                            <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                               href="#">
                                                <i class="size-3" data-lucide="trash-2"></i>
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4 mb-2 text-yellow-500">
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                </div>
                                <p class="text-default-500 text-sm">"Very nice design. Clean Code and easy
                                    customizable"</p>
                                <div class="flex items-center gap-3 mt-3">
                                    <a class="text-success flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-up"></i>
                                        <span class="text-sm">31</span>
                                    </a>
                                    <a class="text-danger flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-down"></i>
                                        <span class="text-sm">09</span>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 pt-3 border-t border-default-200">
                                <div class="flex justify-between items-center gap-5">
                                    <div class="flex gap-3 items-center">
                                        <div class="bg-green-100 rounded-full">
                                            <img alt="" class="h-10 rounded-full" src="/images/user/avatar-8.png"/>
                                        </div>
                                        <div>
                                            <h6 class="card-title"><a href="#">avern Ratke</a></h6>
                                            <p class="text-[13px] text-default-500">on 10 Aug, 2023</p>
                                        </div>
                                    </div>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle flex justify-center items-center size-7.5 text-sm font-semibold rounded-md bg-default-100 hover:bg-default-600 text-default-500 hover:text-white"
                                                hs-dropdown-placement="bottom-end" type="button">
                                            <i class="iconify lucide--ellipsis size-4"></i>
                                        </button>
                                        <div class="hs-dropdown-menu" role="menu">
                                            <div>
                                                <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                   href="#">
                                                    <i class="size-3" data-lucide="edit"></i>
                                                    Edit
                                                </a>
                                                <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-sm text-default-500 hover:bg-default-150 rounded"
                                                   href="#">
                                                    <i class="size-3" data-lucide="trash-2"></i>
                                                    Delete
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 mt-4 mb-2 text-yellow-500">
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star"></i>
                                    <i class="size-3.5 fill-yellow-500" data-lucide="star-half"></i>
                                </div>
                                <p class="text-default-500 text-sm">"The best templates which is supported multiple
                                    programming languages with beautiful templates. thank you for the valuable
                                    template."</p>
                                <div class="flex items-center gap-3 mt-3">
                                    <a class="text-success flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-up"></i>
                                        <span class="text-sm">49</span>
                                    </a>
                                    <a class="text-danger flex items-center gap-1.25" href="#">
                                        <i class="size-3" data-lucide="thumbs-down"></i>
                                        <span class="text-sm">17</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
