@extends('layouts.vertical', ['title' => 'Product Grid'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Grid View'] )

    <div class="grid lg:grid-cols-4 grid-cols-1 gap-5">
        <div class="col-span-1 lg:block hidden">
            <div class="card">
                <div class="card-body">
                    <div class="flex items-center justify-between gap-3">
                        <h6 class="card-title">Filter</h6>
                        <div class="shrink-0">
                            <a class="underline transition-all duration-200 text-default-700 text-sm ease-linear hover:text-primary"
                               href="#">Clear All
                            </a>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="relative">
                            <input class="ps-9 form-input form-input-sm w-full" id="hs-leading-icon"
                                   name="hs-leading-icon" placeholder="Search for..." type="text"/>
                            <div class="absolute inset-y-0 start-0 flex items-center z-20 ps-3">
                                <i class="size-3.5 text-default-600" data-lucide="search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <div class="hs-accordion-group" data-hs-accordion-always-open="">
                            <div class="hs-accordion active mt-4"
                                 id="hs-basic-with-title-and-arrow-stretched-heading-one">
                                <button aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-one"
                                        aria-expanded="true"
                                        class="hs-accordion-toggle underline inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-default-800 rounded-lg disabled:opacity-50 text-sm disabled:pointer-events-none">
                                    Color
                                    <i class="iconify lucide--chevron-down text-base hs-accordion-active:hidden block"></i>
                                    <i class="iconify lucide--chevron-up text-base hs-accordion-active:block hidden"></i>
                                </button>
                                <div aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-one"
                                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                     id="hs-basic-with-title-and-arrow-stretched-collapse-one" role="region">
                                    <div class="mt-4 flex gap-2">
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-primary bg-primary checked:bg-primary checked:border-primary focus:ring-0"
                                            id="color1" type="checkbox" value="">
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-red-300 bg-red-300 checked:bg-red-300 checked:border-red-300 focus:ring-0"
                                            id="color2" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-green-300 bg-green-300 checked:bg-green-300 checked:border-green-300 focus:ring-0"
                                            id="color3" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-default-500 bg-default-500 checked:bg-default-500 checked:border-default-500 focus:ring-0"
                                            id="color4" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-purple-500 bg-purple-500 checked:bg-purple-500 checked:border-purple-500 focus:ring-0"
                                            id="color5" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-sky-500 bg-sky-500 checked:bg-sky-500 checked:border-sky-500 focus:ring-0"
                                            id="color6" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-yellow-500 bg-yellow-500 checked:bg-yellow-500 checked:border-yellow-500 focus:ring-0"
                                            id="color7" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-green-500 bg-green-500 checked:bg-green-500 checked:border-green-500 focus:ring-0"
                                            id="color8" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-default-800 bg-default-800 checked:bg-default-800 checked:border-default-800 focus:ring-0"
                                            id="color9" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-default-200 bg-default-200 checked:bg-default-200 checked:border-default-200 focus:ring-0"
                                            id="color10" type="checkbox" value=""/>
                                        <input
                                            class="size-5 cursor-pointer rounded-sm border border-emerald-300 bg-emerald-300 checked:bg-emerald-300 checked:border-emerald-300 focus:ring-0"
                                            id="color11" type="checkbox" value=""/>
                                        </input></div>
                                </div>
                            </div>
                            <div class="hs-accordion active mt-4"
                                 id="hs-basic-with-title-and-arrow-stretched-heading-two">
                                <button aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-two"
                                        aria-expanded="true"
                                        class="hs-accordion-toggle underline inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-default-800 rounded-lg disabled:opacity-50 text-sm disabled:pointer-events-none">
                                    Price
                                    <i class="iconify lucide--chevron-down text-base hs-accordion-active:hidden block"></i>
                                    <i class="iconify lucide--chevron-up text-base hs-accordion-active:block hidden"></i>
                                </button>
                                <div aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-two"
                                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                     id="hs-basic-with-title-and-arrow-stretched-collapse-two" role="region">
                                    <div class="mt-4 flex gap-2 flex-col">
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="priceAll"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="priceAll">
                                                All
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price1"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price1">
                                                $0.00 – $110.00
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price2"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price2">
                                                $110.00 – $220.00
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price3"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price3">
                                                $220 - $330
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price4"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price4">
                                                $330 -
                                                $550
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price5"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price5">
                                                $550+
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price6"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price6">
                                                Low to High
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="price7"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="price7">
                                                High to Low
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hs-accordion active mt-4"
                                 id="hs-basic-with-title-and-arrow-stretched-heading-three">
                                <button aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-three"
                                        aria-expanded="true"
                                        class="hs-accordion-toggle underline inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-default-800 rounded-lg disabled:opacity-50 text-sm disabled:pointer-events-none">
                                    Product Category
                                    <i class="iconify lucide--chevron-down text-base hs-accordion-active:hidden block"></i>
                                    <i class="iconify lucide--chevron-up text-base hs-accordion-active:block hidden"></i>
                                </button>
                                <div aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-three"
                                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                     id="hs-basic-with-title-and-arrow-stretched-collapse-three" role="region">
                                    <div class="mt-4 flex gap-2 flex-col">
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="categoryAll"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="categoryAll">
                                                All
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category1"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category1">
                                                Mobiles, Computers
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category2"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category2">
                                                TV, Appliances, Electronics
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category3"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category3">
                                                Men's Fashion
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category4"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category4">
                                                Women's Fashion
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category5"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category5">
                                                Home, Kitchen, Pets
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category6"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category6">
                                                Beauty, Health, Grocery
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="category7"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="category7">
                                                Books
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hs-accordion active mt-4"
                                 id="hs-basic-with-title-and-arrow-stretched-heading-four">
                                <button aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-four"
                                        aria-expanded="true"
                                        class="hs-accordion-toggle underline inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-default-800 rounded-lg disabled:opacity-50 text-sm disabled:pointer-events-none">
                                    Rating
                                    <i class="iconify lucide--chevron-down text-base hs-accordion-active:hidden block"></i>
                                    <i class="iconify lucide--chevron-up text-base hs-accordion-active:block hidden"></i>
                                </button>
                                <div aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-four"
                                     class="hs-accordion-content w-full overflow-hidden transition-[height] duration-300"
                                     id="hs-basic-with-title-and-arrow-stretched-collapse-four" role="region">
                                    <div class="mt-4 flex gap-2 flex-col">
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="ratingAll"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="ratingAll">
                                                All
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating5"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating5">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                5 Rating
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating4"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating4">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                4 Rating and Up
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating3"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating3">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                3 Rating and Up
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating2"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating2">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                2 Rating and Up
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating1"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating1">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                1 Rating and Up
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="rating0"
                                                   type="checkbox"/>
                                            <label
                                                class="text-sm flex items-center gap-1 text-default-800 align-middle cursor-pointer"
                                                for="rating0">
                                                <i class="text-yellow-500 size-4 ms-1" data-lucide="star"></i>
                                                0 Rating
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="hs-accordion mt-4" id="hs-basic-with-title-and-arrow-stretched-heading-five">
                                <button aria-controls="hs-basic-with-title-and-arrow-stretched-collapse-five"
                                        aria-expanded="true"
                                        class="hs-accordion-toggle underline inline-flex items-center justify-between gap-x-3 w-full font-semibold text-start text-default-800 rounded-lg disabled:opacity-50 text-sm disabled:pointer-events-none">
                                    Gender
                                    <i class="iconify lucide--chevron-down text-base hs-accordion-active:hidden block"></i>
                                    <i class="iconify lucide--chevron-up text-base hs-accordion-active:block hidden"></i>
                                </button>
                                <div aria-labelledby="hs-basic-with-title-and-arrow-stretched-heading-five"
                                     class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                                     id="hs-basic-with-title-and-arrow-stretched-collapse-five" role="region">
                                    <div class="mt-4 flex gap-2 flex-col">
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="genderAll"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="genderAll">
                                                All
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="gendermal"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="gendermal">
                                                Male
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="genderFemal"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="genderFemal">
                                                Female
                                            </label>
                                        </div>
                                        <div class="flex gap-2 items-center">
                                            <input class="form-checkbox checked:bg-primary" id="genderOthers"
                                                   type="checkbox"/>
                                            <label class="text-sm text-default-800 align-middle cursor-pointer"
                                                   for="genderOthers">
                                                Other
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 col-span-1">
            <div class="flex justify-between gap-2 flex-wrap items-center">
                <p class="text-default-700 text-sm">Showing all <b>7,410</b> items results</p>
                <div class="flex gap-2 items-center">
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                class="hs-dropdown-toggle inline-flex items-center btn btn-sm bg-transparent border border-primary text-primary transition-all duration-300 hover:bg-primary hover:text-white"
                                hs-dropdown-placement="bottom-end" type="button">
                            Sort by:<b class="font-medium">Highest Price</b>
                            <i class="size-4 ms-2" data-lucide="chevron-down"></i>
                        </button>
                        <div
                            class="hs-dropdown-menu transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-40 card z-30 mt-2 p-2 text-sm"
                            role="menu">
                            <a class="flex items-center gap-x-3.5 py-2 font-medium px-4 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                Lowest Price
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 font-medium px-4 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                Highest Price
                            </a>
                            <a class="flex items-center gap-x-3.5 py-2 font-medium px-4 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                High to Low
                            </a>
                            <hr class="border-t border-default-200 my-2 -mx-2"/>
                            <a class="flex items-center gap-x-3.5 py-2 font-medium px-4 text-default-600 hover:bg-default-150 rounded"
                               href="#">
                                Low to High
                            </a>
                        </div>
                    </div>
                    <nav aria-label="Tabs" aria-orientation="horizontal" class="flex gap-x-1" role="tablist">
                        <button aria-controls="item-1" aria-selected="false"
                                class="hs-tab-active:font-semibold hs-tab-active:bg-sky-600 hs-tab-active:text-white btn size-7.5 bg-sky-100 text-sky-500 hover:text-white hover:bg-sky-600"
                                data-hs-tab="#item-1" id="items-1" role="tab" type="button">
                            <i class="size-4" data-lucide="list"></i>
                        </button>
                        <button aria-controls="item-2" aria-selected="true"
                                class="hs-tab-active:font-semibold hs-tab-active:bg-sky-600 hs-tab-active:text-white btn size-7.5 bg-sky-100 text-sky-500 hover:text-white hover:bg-sky-600 active"
                                data-hs-tab="#item-2" id="items-2" role="tab" type="button">
                            <i class="size-4" data-lucide="layout-grid"></i>
                        </button>
                    </nav>
                </div>
            </div>
            <div class="flex items-center mt-3 gap-3">
<span class="flex items-center gap-1 rounded-full px-2.5 py-0.75 border border-default-200 text-xs">
                                High to Low
                                <a class="align-middle transition-al duration-300" href="#">
<i class="size-3" data-lucide="x"></i>
</a>
</span>
                <span class="flex items-center gap-1 rounded-full px-2.5 py-0.75 border border-default-200 text-xs">
                                New
                                <a class="align-middle transition-al duration-300" href="#">
<i class="size-3" data-lucide="x"></i>
</a>
</span>
                <a class="py-0.75 px-2.5 text-xs rounded-md transition-all duration-300 hover:bg-default-150" href="#">
                    All Clear
                </a>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mt-5">
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-02.png"/>
                        <i class="size-5 text-danger fill-danger/15 absolute top-6 end-6" data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Mesh Ergonomic Black Chair</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star-half"></i>
                            </div>
                            <span class="text-default-500">(198)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$674.12
                            <small class="line-through font-medium text-default-500">784.09</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-03.png"/>
                        <i class="size-5 text-default-500 fill-default-100 absolute top-6 end-6"
                           data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Fastcolors Typography Men</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star-half"></i>
                            </div>
                            <span class="text-default-500">(1,150)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$341.99
                            <small class="line-through font-medium text-default-500">784.09</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-04.png"/>
                        <i class="size-5 text-default-500 fill-default-100 absolute top-6 end-6"
                           data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Mesh Ergonomic Green Chair</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star-half"></i>
                                <i class="size-4" data-lucide="star"></i>
                            </div>
                            <span class="text-default-500">(29)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$362.2
                            <small class="line-through font-medium text-default-500"> 599.99</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-05.png"/>
                        <i class="size-5 text-danger fill-danger/15 absolute top-6 end-6" data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Techel Black Bluetooth Sound.</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="start-half"></i>
                            </div>
                            <span class="text-default-500">(1,324)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$249.99
                            <small class="line-through font-medium text-default-500"> 399.99</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-06.png"/>
                        <i class="size-5 text-default-500 fill-default-100 absolute top-6 end-6"
                           data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Bovet Fleurier AIFSQ029</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="start-half"></i>
                            </div>
                            <span class="text-default-500">(1,324)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$496.16
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-08.png"/>
                        <i class="size-5 text-danger fill-danger/15 absolute top-6 end-6" data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Roar Twill Blue Baseball Cap</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="start-half"></i>
                                <i class="size-4" data-lucide="star"></i>
                                <i class="size-4" data-lucide="start"></i>
                            </div>
                            <span class="text-default-500">(485)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$674.12
                            <small class="line-through font-medium text-default-500"> 784.99</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-01.png"/>
                        <i class="size-5 text-default-500 fill-default-100 absolute top-6 end-6"
                           data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Smartest Printed T-shirt</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="start-half"></i>
                                <i class="size-4" data-lucide="start"></i>
                            </div>
                            <span class="text-default-500">(5,321)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$89.99
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body relative">
                        <img alt="" src="/images/product/img-10.png"/>
                        <i class="size-5 text-danger fill-danger/15 absolute top-6 end-6" data-lucide="heart"></i>
                    </div>
                    <div class="pb-5 px-5">
                        <h6 class="text-base text-default-800 font-semibold hover:text-primary transition-all mb-2">
                            <a href="#">Crop tops for Women western.</a>
                        </h6>
                        <div class="flex items-center gap-1">
                            <div class="flex items-center gap-0.25 text-yellow-500">
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="star"></i>
                                <i class="size-4 fill-yellow-500" data-lucide="start-half"></i>
                            </div>
                            <span class="text-default-500">(1551)</span>
                        </div>
                        <h5 class="mt-4 text-base font-semibold text-default-800">$145
                            <small class="line-through font-medium text-default-500"> 299.99</small>
                        </h5>
                        <div class="flex items-center gap-2 mt-4">
                            <button class="border border-default-600 w-full text-default-500 border-dashed btn">
                                <i class="size-3" data-lucide="shopping-cart"></i>
                                Add to Cart
                            </button>
                            <div class="hs-dropdown relative inline-flex">
                                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                        class="hs-dropdown-toggle btn size-9 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
                                        hs-dropdown-placement="bottom-end" type="button">
                                    <i class="iconify lucide--ellipsis size-4"></i>
                                </button>
                                <div class="hs-dropdown-menu" role="menu">
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="eye"></i>
                                        Overview
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="edit"></i>
                                        Edit
                                    </a>
                                    <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded"
                                       href="#">
                                        <i class="size-3" data-lucide="trash-2"></i>
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap md:justify-between justify-center md:gap-0 gap-4 mt-5">
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
@endsection

@section('scripts')

@endsection
