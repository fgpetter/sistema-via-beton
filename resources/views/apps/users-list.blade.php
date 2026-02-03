@extends('layouts.vertical', ['title' => 'List View'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Users', 'title' => 'List View'] )

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Users List</h6>
            <button class="btn btn-sm bg-primary text-white">
                <i class="size-4 me-1" data-lucide="plus"></i>Add user
            </button>
        </div>
        <div class="card-header">
            <div class="md:flex items-center md:space-y-0 space-y-4 gap-3">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for name,email" type="email"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-3.5 flex items-center text-default-500 fill-default-100"
                           data-lucide="search"></i>
                    </div>
                </div>
                <select class="form-input form-input-sm">
                    <option selected="">select status</option>
                    <option>Hidden</option>
                    <option>Rejected</option>
                    <option>Verified</option>
                    <option>Waiting</option>
                </select>
            </div>
            <div class="flex gap-2 items-center flex-wrap">
                <button
                    class="btn btn-sm bg-transparent border border-dashed border-primary text-primary hover:bg-primary/10"
                    type="button">
                    <i class="size-4" data-lucide="download"></i>
                    Import
                </button>
                <button
                    class="btn btn-sm size-7.5 bg-default-100 text-default-500 hover:bg-default-1500 hover:text-white"
                    type="button">
                    <i class="size-4" data-lucide="sliders-horizontal"></i>
                </button>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                            <tr class="text-sm font-normal text-default-700 whitespace-nowrap">
                                <th class="ps-4 text-start">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </th>
                                <th class="px-3.5 py-3 text-start" scope="col">User ID</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Name</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Location</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Email</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Phone Number</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Joining Date</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Status</th>
                                <th class="px-3.5 py-3 text-start" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="py-3 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-3 text-sm text-primary"> #TW1500001</td>
                                <td class="flex py-3 px-3.5 items-center gap-3">
                                    <div class="size-10 rounded-full bg-default-200">
                                        <img alt="" class="h-10 rounded-full" src="/images/user/avatar-2.png"/>
                                    </div>
                                    <div>
                                        <h6 class="mb-1.5 font-semibold">
                                            <a class="text-default-800" href="#">Marie Prohaska</a>
                                        </h6>
                                        <p class="text-default-500">Graphic Designer</p>
                                    </div>
                                </td>
                                <td class="py-3 px-3.5">United Kingdom</td>
                                <td class="py-3 px-3.5">prohaska@tailwick.com</td>
                                <td class="py-3 px-3.5">853 565 9802</td>
                                <td class="py-3 px-3.5">04 Jan, 2023</td>
                                <td class="px-3.5 py-3">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
<i class="size-3" data-lucide="check-circle-2"></i>
                                                        Verified
                                                    </span>
                                </td>
                                <td class="px-3.5 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="py-3 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-3 whitespace-nowrap text-sm text-primary">#TW1500002</td>
                                <td class="flex py-3 px-3.5 items-center gap-3">
                                    <div class="size-10 rounded-full bg-default-200">
                                        <img alt="" class="h-10 rounded-full" src="/images/user/avatar-1.png"/>
                                    </div>
                                    <div>
                                        <h6 class="mb-1.5 font-semibold"><a class="text-default-800" href="#">Jaqueline
                                                Hammes</a></h6>
                                        <p class="text-default-500">ASP.Net Developer</p>
                                    </div>
                                </td>
                                <td class="py-3 px-3.5">Brazil</td>
                                <td class="py-3 px-3.5">jaqueline@tailwick.com</td>
                                <td class="py-3 px-3.5">546 6334 586</td>
                                <td class="py-3 px-3.5">18 Jan, 2023</td>
                                <td class="px-3.5 py-3 whitespace-nowrap">
<span
    class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-default-200 text-default-600 rounded">
<i class="size-3" data-lucide="loader"></i> Waiting
                                                    </span>
                                </td>
                                <td class="px-3.5 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="py-3 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-3 whitespace-nowrap text-sm text-primary">#TW1500003</td>
                                <td class="flex py-3 px-3.5 items-center gap-3">
                                    <div class="size-10 rounded-full bg-default-200"><img alt=""
                                                                                          class="h-10 rounded-full"
                                                                                          src="/images/user/avatar-2.png"/>
                                    </div>
                                    <div>
                                        <h6 class="mb-1.5 font-semibold"><a class="text-default-800" href="#">Marlene
                                                Hirthe</a></h6>
                                        <p class="text-default-500">Angular Developer</p>
                                    </div>
                                </td>
                                <td class="py-3 px-3.5">Spain</td>
                                <td class="py-3 px-3.5">marlene@tailwick.com</td>
                                <td class="py-3 px-3.5">141 654 9876</td>
                                <td class="py-3 px-3.5">04 Feb, 2023</td>
                                <td class="px-3.5 py-3 whitespace-nowrap">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
<i class="size-3" data-lucide="check-circle-2"></i>
                                                        Verified
                                                    </span>
                                </td>
                                <td class="px-3.5 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="py-3 ps-4">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-3.5 py-3 whitespace-nowrap text-sm text-primary">#TW1500004</td>
                                <td class="flex py-3 px-3.5 items-center gap-3">
                                    <div class="size-10 rounded-full bg-default-200"><img alt=""
                                                                                          class="h-10 rounded-full"
                                                                                          src="/images/user/avatar-3.png"/>
                                    </div>
                                    <div>
                                        <h6 class="mb-1.5 font-semibold"><a class="text-default-800" href="#">Akeem
                                                Paucek</a></h6>
                                        <p class="text-default-500">Jr. Developer</p>
                                    </div>
                                </td>
                                <td class="py-3 px-3.5">Mexico</td>
                                <td class="py-3 px-3.5">akeem.p@tailwick.com</td>
                                <td class="py-3 px-3.5">783 962 3972</td>
                                <td class="py-3 px-3.5">12 Feb, 2023</td>
                                <td class="px-3.5 py-3 whitespace-nowrap"><span
                                        class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/10 text-danger rounded"><i
                                            class="size-3" data-lucide="x-circle"></i> Rejected</span></td>
                                <td class="px-3.5 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500005</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img alt="" class="w-9 h-9 rounded-full" src="/images/user/avatar-1.png"/>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Stephon Trantow</div>
                                        <div class="text-default-500">Full Stack Developer</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Spain</td>
                                <td class="px-4 py-3">akeem.p@tailwick.com</td>
                                <td class="px-4 py-3">032 126 5833</td>
                                <td class="px-4 py-3">31 Feb, 2023</td>
                                <td class="px-4 py-3">
                                    <span
                                        class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/10 text-danger rounded"><i
                                            class="size-3" data-lucide="x-circle"></i> Rejected</span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500006</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 flex items-center justify-center rounded-full bg-default-200 font-semibold">
                                        DT
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Domenic Tromp</div>
                                        <div class="text-default-500">Team Leader</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Germany</td>
                                <td class="px-4 py-3">domenic@tailwick.com</td>
                                <td class="px-4 py-3">612 6088 735</td>
                                <td class="px-4 py-3">27 Oct, 2023</td>
                                <td class="px-4 py-3">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
<i class="size-3" data-lucide="check-circle-2"></i>
                                                        Verified
                                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500007</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img alt="" class="w-9 h-9 rounded-full" src="/images/user/avatar-2.png"/>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Ethel Corwin</div>
                                        <div class="text-default-500">Web Designer</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Italy</td>
                                <td class="px-4 py-3">ecorwin@tailwick.com</td>
                                <td class="px-4 py-3">216 897 4978</td>
                                <td class="px-4 py-3">03 Aug, 2023</td>
                                <td class="px-4 py-3">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
<i class="size-3" data-lucide="check-circle-2"></i>
                                                        Verified
                                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500008</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img alt="" class="w-9 h-9 rounded-full" src="/images/user/avatar-3.png"/>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Rickie Cremin</div>
                                        <div class="text-default-500">Web Designer</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">France</td>
                                <td class="px-4 py-3">ecorwin@tailwick.com</td>
                                <td class="px-4 py-3">388 946 3889</td>
                                <td class="px-4 py-3">01 July, 2023</td>
                                <td class="px-4 py-3">
<span
    class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-default-200 text-default-600 rounded">
<i class="size-3" data-lucide="loader"></i> Waiting
                                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500009</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <div
                                        class="w-9 h-9 flex items-center justify-center rounded-full bg-default-200 font-semibold">
                                        RL
                                    </div>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Reagan Larson</div>
                                        <div class="text-default-500">Team Leader</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Denmark</td>
                                <td class="px-4 py-3">reagan@tailwick.com</td>
                                <td class="px-4 py-3">612 6088 735</td>
                                <td class="px-4 py-3">27 Oct, 2023</td>
                                <td class="px-4 py-3">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
<i class="size-3" data-lucide="check-circle-2"></i>
                                                        Verified
                                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                <td class="px-4 py-3">
                                    <input class="form-checkbox" id="checkbox-all" type="checkbox"/>
                                </td>
                                <td class="px-4 py-3 text-primary">#TW1500010</td>
                                <td class="px-4 py-3 flex items-center gap-3">
                                    <img alt="" class="w-9 h-9 rounded-full" src="/images/user/avatar-4.png"/>
                                    <div class="text-sm">
                                        <div class="font-semibold mb-1">Glennie Langosh</div>
                                        <div class="text-default-500">Project Manager</div>
                                    </div>
                                </td>
                                <td class="px-4 py-3">Germany</td>
                                <td class="px-4 py-3">glennie@tailwick.com</td>
                                <td class="px-4 py-3">357 716 8847</td>
                                <td class="px-4 py-3">11 Dec, 2023</td>
                                <td class="px-4 py-3">
<span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/10 text-danger rounded">
<i class="size-3" data-lucide="x-circle"></i> Rejected
                                                    </span>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="hs-dropdown relative inline-flex">
                                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
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
                <p class="text-default-500 text-sm">Showing <b>10</b> of <b>58</b> Results</p>
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
