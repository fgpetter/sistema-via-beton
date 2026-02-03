@extends('layouts.vertical', ['title' => 'Product Create'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Product Create'] )
    <div class="grid lg:grid-cols-12 grid-cols-1 gap-6">
        <div class="lg:col-span-9 col-span-1">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-4 card-title">Create Product</h6>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5 mb-5">
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="productNameInput">Product Title</label>
                            <input class="form-input" id="productNameInput" placeholder="Product Title" required=""
                                   type="text"/>
                            <p class="mt-1 text-default-400">Do not exceed 20 characters when entering the product
                                name.</p>
                        </div>
                        <div class="col-span-1">
                            <label class="bg-transparent inline-block mb-2 font-medium" for="productCodeInput">Product
                                Code</label>
                            <input class="form-input" disabled="" id="productCodeInput" placeholder="Product Code"
                                   required="" type="text" value="TWT145015"/>
                            <p class="mt-1 text-default-400">Code will be generated automatically</p>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="qualityInput">Quantity</label>
                            <input class="form-input" id="qualityInput" placeholder="Quantity" required=""
                                   type="number"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="skuInput">SKU</label>
                            <input class="form-input" id="skuInput" placeholder="TWT-LP-ALU-08" required=""
                                   type="text"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="brandInput">Brand</label>
                            <input class="form-input" id="brandInput" placeholder="Brand" required="" type="text"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">Category</label>
                            <select class="form-input" placeholder="Select Category">
                                <option value="Beauty,Health,Grocery">Beauty,Health,Grocery</option>
                                <option value="Books">Books</option>
                                <option value="Home,kichen,Pets">Home,kichen,Pets</option>
                                <option value="Men's Fashion">Men's Fashion</option>
                                <option value="Mobile,Computers">Mobile,Computers</option>
                                <option value="TV,Appliances,Electronics">TV,Appliances,Electronics</option>
                                <option value="Women's Fashion">Women's Fashion</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">Product
                                Type</label>
                            <select class="form-input" placeholder="Select Type">
                                <option value="Boxed">Boxed</option>
                                <option value="Single">Single</option>
                                <option value="Unit">Unit</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">Gender </label>
                            <select class="form-input" placeholder="Select Gender">
                                <option value="Feamle">Feamle</option>
                                <option value="Male">Male</option>
                                <option value="Unisex">Unisex</option>
                            </select>
                        </div>
                    </div>
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-5 mb-5">
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="qualityInput">Colors
                                Variant</label>
                            <div class="flex gap-2 items-center flex-wrap">
                                <input class="form-checkbox text-primary" type="checkbox"/>
                                <input class="form-checkbox text-success" type="checkbox"/>
                                <input class="form-checkbox text-info" type="checkbox"/>
                                <input class="form-checkbox text-warning" type="checkbox"/>
                                <input class="form-checkbox text-danger" type="checkbox"/>
                                <input class="form-checkbox text-black" type="checkbox"/>
                                <input class="form-checkbox text-default-500" type="checkbox"/>
                            </div>
                        </div>
                        <div>
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="qualityInput">Size</label>
                            <div class="flex gap-2 items-center">
                                <button
                                    class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    XS
                                </button>
                                <button
                                    class="active size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    S
                                </button>
                                <button
                                    class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    M
                                </button>
                                <button
                                    class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    L
                                </button>
                                <button
                                    class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    XL
                                </button>
                                <button
                                    class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                    2XL
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 mb-5">
                        <h6 class="mb-2 font-semibold text-sm text-default-800">Product Images</h6>
                        <div
                            class="flex items-center justify-center bg-transparent border border-dashed rounded-md cursor-pointer dropzone border-default-300 dropzone2">
                            <div class="fallback">
                                <i data-lucide="file" multiple="multiple" type="file"></i>
                            </div>
                            <div class="w-full py-5 text-lg text-center dz-message needsclick">
                                <div class="mb-3 flex justify-center">
                                    <i class="size-12 fill-default-200 text-default-500" data-lucide="upload-cloud"></i>
                                </div>
                                <h5 class="mb-0 font-normal text-base text-default-500">Drag and drop your files or <a
                                        href="#">browse</a> your files</h5>
                            </div>
                        </div>
                        <ul class="flex flex-wrap mb-0 gap-x-5" id="dropzone-preview2">
                            <li class="mt-5" id="dropzone-preview-list">
                                <!-- This is used as the file preview template -->
                                <div class="border rounded border-default-200 dark:border-zink-500">
                                    <div class="py-3 px-4 text-center">
                                        <div>
                                            <div class="p-2 mx-auto rounded-md size-14 bg-default-200">
                                                <i class="block size-7 w-full h-full rounded-md" data-dz-thumbnail=""
                                                   data-lucide="file"></i>
                                            </div>
                                        </div>
                                        <div class="pt-3">
                                            <h5 class="mb-1 text-15" data-dz-name=""> </h5>
                                            <p class="mb-0 text-default-500 dark:text-zink-200" data-dz-size=""></p>
                                            <strong class="error text-danger" data-dz-errormessage=""></strong>
                                        </div>
                                        <div class="mt-2">
                                            <button
                                                class="px-2 py-1.5 text-xs text-white bg-danger border-danger btn hover:text-white hover:bg-red-600 hover:border-red-600 focus:text-white focus:bg-red-600 focus:border-red-600 focus:ring focus:ring-red-100 active:text-white active:bg-red-600 active:border-red-600 active:ring active:ring-red-100 dark:ring-custom-400/20"
                                                data-dz-remove="">Delete
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="grid grid-cols-1 gap-2 mb-5">
                        <h6 class="font-semibold text-default-800 text-sm">Description</h6>
                        <textarea class="form-input" placeholder="Enter Description" rows="5"></textarea>
                    </div>
                    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="productPrice">Price</label>
                            <input class="form-input" id="productPrice" placeholder="$0.00" required="" type="number"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium"
                                   for="productDiscounts">Discounts</label>
                            <input class="form-input" id="productDiscounts" placeholder="0%" required="" type="number"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">TAX
                                Applicable</label>
                            <select class="form-input" placeholder="Select TAX Applicable">
                                <option value="Entertainment">Entertainment</option>
                                <option value="Exclusive">Exclusive</option>
                                <option value="none">none</option>
                                <option value="Professional">Professional</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="publishDateTime">Publish
                                Date &amp; Time</label>
                            <input class="form-input" data-date-format="d M, Y" data-enable-time=""
                                   data-provider="flatpickr" id="publishDateTime" placeholder="Select date &amp; time"
                                   readonly="readonly" required="" type="text"/>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">Status</label>
                            <select class="form-input">
                                <option value="Draft">Draft</option>
                                <option value="Entertainment">Entertainment</option>
                                <option value="Published">Published</option>
                                <option value="Scheduled"> Scheduled</option>
                            </select>
                        </div>
                        <div class="col-span-1">
                            <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="brandInput">Visibility</label>
                            <select class="form-input" placeholder="Public">
                                <option value="Hidden">Hidden</option>
                                <option value="Publice">Publice</option>
                            </select>
                        </div>
                        <div>
                            <div>
                                <label class="inline-block mb-2 text-sm text-default-800 font-medium" for="productTag">Product
                                    Tag</label>
                                <input class="form-input" data-choices="" data-choices-text-unique-true=""
                                       id="productTag" type="text" value="Fashion, Clothes, Headphones"/>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 flex gap-2 md:justify-end">
                        <button class="bg-transparent text-danger btn border-0 hover:bg-danger/15">Reset</button>
                        <button class="text-white btn bg-primary">Create Product</button>
                        <button class="bg-teal-600 text-white btn hover:bg-teal-700">Draft &amp; Preview</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="lg:col-span-3 col-span-1">
            <div class="sticky top-20">
                <div class="card">
                    <div class="card-body">
                        <h6 class="mb-4 card-title">Product Card Preview</h6>
                        <div class="px-5 py-8 rounded-md bg-info/10">
                            <img alt="" class="block mx-auto h-44" src="/images/product/img-03.png"/>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-2 text-lg text-default-800 font-medium">$145.99 <small
                                    class="font-normal line-through text-default-600">299.99</small></h5>
                            <h6 class="mb-1 text-[15px] font-semibold text-default-800">Fastcolors Typography Men</h6>
                            <p class="text-default-600">Men's Fashion</p>
                        </div>
                        <h6 class="mt-3 mb-2 card-title">Colors</h6>
                        <div class="flex gap-2 flex-wrap items-center">
                            <input class="form-checkbox rounded-full text-primary" id="color1" type="checkbox">
                            <input class="form-checkbox rounded-full text-danger" id="color2" type="checkbox">
                            <input class="form-checkbox rounded-full text-success" id="color3" type="checkbox">
                            <input class="form-checkbox rounded-full text-secondary" id="color5" type="checkbox">
                            </input></input></input></input></div>
                        <h6 class="mt-3 mb-2 card-title">Sizes</h6>
                        <div class="flex gap-2 flex-wrap items-center">
                            <button
                                class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                XS
                            </button>
                            <button
                                class="active size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                S
                            </button>
                            <button
                                class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                M
                            </button>
                            <button
                                class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                L
                            </button>
                            <button
                                class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                XL
                            </button>
                            <button
                                class="size-7.5 text-xs text-default-500 btn border border-default-200 hover:bg-primary/10 hover:border-primary focus:bg-primary/10 focus:border-primary">
                                2XL
                            </button>
                        </div>
                        <div class="grid md:grid-cols-2 grid-cols-1 gap-2 mt-4">
                            <button
                                class="border border-dashed border-primary bg-transparent btn text-primary hover:bg-primary/10">
                                Create Product
                            </button>
                            <button class="bg-purple-500 text-white btn hover:bg-purple-600">Draft</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/components/timepicker.js'])
    @vite(['resources/js/components/dropzone.js'])
@endsection
