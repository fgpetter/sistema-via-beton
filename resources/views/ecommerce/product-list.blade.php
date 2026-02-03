@extends('layouts.vertical', ['title' => 'Product List'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Products', 'title' => 'List View'] )

    <div class="grid grid-cols-1 gap-5 mb-5">
        <div class="card">
            <div class="card-header">
                <div class="md:flex md:space-y-0 space-y-3.5 gap-3 items-center">
                    <div class="relative">
                        <input class="ps-11 form-input form-input-sm w-full" placeholder="Search for...." type="email"/>
                        <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                            <i class="size-3.5 flex items-center text-default-500" data-lucide="search"></i>
                        </div>
                    </div>
                    <input class="form-input form-input-sm w-full" data-date-format="d M, Y" data-provider="flatpickr"
                           data-range-date="true" placeholder="Select Date" readonly="readonly" type="text"/>
                </div>
                <button class="btn btn-sm bg-primary text-white">
                    <i class="size-4 me-1" data-lucide="plus"></i>Add Product
                </button>
            </div>
            <div class="flex flex-col">
                <div class="overflow-x-auto">
                    <div class="min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-default-200">
                                <thead class="bg-default-150">
                                <tr class="text-sm font-normal text-default-700">
                                    <th class="px-3.5 py-3 text-start" scope="col">Product Code</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Product Name</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Category</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Price</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Stock</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Revenue</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                    <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-default-200">
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100071</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-01.png"/>
                                            <h6 class="text-default-800">Smartest Printed T-shirt</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Fashion
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$79.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">500</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$24,365</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">Scheduled</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100074</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-06.png"/>
                                            <h6 class="text-default-800">Techel Black Bluetooth Soundbar</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Electronics
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$452.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">300</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$49,234</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Publish</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100075</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-07.png"/>
                                            <h6 class="text-default-800">Bovet Fleurier AIFSQ029</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Home Decor
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$119.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">240</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$20,784</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Publish</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100077</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-09.png"/>
                                            <h6 class="text-default-800">Roar Twill Blue Baseball Cap</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Fashion
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$49.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">470</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$19,321</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Publish</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100080</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-08.png"/>
                                            <h6 class="text-default-800">Aahwan Solid Women Beige Baggy Shorts</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Fashion
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$64.70</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">150</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$13,987</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Publish</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100072</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-03.png"/>
                                            <h6 class="text-default-800">Mesh Ergonomic Black Chair</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Furniture
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$214.47</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">400</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$1,24,365</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-success/15 text-success">Publish</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                <tr class="text-default-800 font-normal">
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm text-primary">#TAD-232100071</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <a class="flex items-center gap-2" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                            <img alt="Product images" class="h-6" src="/images/product/img-02.png"/>
                                            <h6 class="text-default-800">Smartest Printed T-shirt</h6>
                                        </a>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">
                                        <div
                                            class="inline-flex py-0.5 px-2.5 rounded text-xs font-normal bg-default-100 border border-default-200 text-default-500">
                                            Fashion
                                        </div>
                                    </td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$79.99</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">500</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap text-sm">$24,365</td>
                                    <td class="px-3.5 py-2.5 whitespace-nowrap">
                                        <span
                                            class="inline-flex items-center gap-x-1.5 py-0.5 px-2.5 rounded text-xs font-medium bg-danger/15 text-danger">Scheduled</span>
                                    </td>
                                    <td class="px-3.5 py-2.5">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                    class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500 hover:text-white"
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
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
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
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
@endsection
