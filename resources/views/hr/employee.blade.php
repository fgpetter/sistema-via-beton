@extends('layouts.vertical', ['title' => 'Employee'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Menu', 'title' => 'Employee List'] )

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Employee (12)</h6>
            <button class="btn btn-sm bg-primary text-white">
                <i class="size-4 me-1" data-lucide="plus"></i>Add Employee
            </button>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-100 font-normal whitespace-nowrap">
                            <tr class="text-sm text-default-800">
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Employee ID</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Name</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Designation</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Email Id</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Phone Number</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Location</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Experience</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Joining Date</th>
                                <th class="px-3.5 py-3 font-medium text-start" scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">
                                    #TWE1001528
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-1.jpg"/>
                                        <h6 class="text-heading font-medium">Willie Torres</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">Nuxt JS Developer
                                </td>
                                <td class="px-3.5 py-3 text-sm">
                                    willie@tailwick.com
                                </td>
                                <td class="px-3.5 py-3 text-sm">070 3715 3689
                                </td>
                                <td class="px-3.5 py-3 text-sm">United States
                                </td>
                                <td class="px-3.5 py-3 text-sm">3 Year
                                </td>
                                <td class="px-3.5 py-3 text-sm">05 Feb, 2020
                                </td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001524</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-2.jpg"/>
                                        <h6 class="text-heading font-medium">Patricia Garcia</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">ASP.Net Developer</td>
                                <td class="px-3.5 py-3 text-sm">PatriciaJGarcia@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">077 7317 7572</td>
                                <td class="px-3.5 py-3 text-sm">Brazil</td>
                                <td class="px-3.5 py-3 text-sm">0.5 Year</td>
                                <td class="px-3.5 py-3 text-sm">12 Aug, 2023</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001506</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-3.jpg"/>
                                        <h6 class="text-heading font-medium">Tonya Johnson</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">Project Manager</td>
                                <td class="px-3.5 py-3 text-sm">TonyaEJohnson@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">079 2383 2340</td>
                                <td class="px-3.5 py-3 text-sm">Denmark</td>
                                <td class="px-3.5 py-3 text-sm">0 Year</td>
                                <td class="px-3.5 py-3 text-sm">11 Nov, 2023</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001502</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-4.jpg"/>
                                        <h6 class="text-heading font-medium">Jose White</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">React Developer</td>
                                <td class="px-3.5 py-3 text-sm">ameida@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">03476 56 14 12</td>
                                <td class="px-3.5 py-3 text-sm">Philippines</td>
                                <td class="px-3.5 py-3 text-sm">1.5 Year</td>
                                <td class="px-3.5 py-3 text-sm">09 Jun, 2022</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001503</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-1.jpg"/>
                                        <h6 class="text-heading font-medium">Juliette Fecteau</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">Sr. Angular Developer</td>
                                <td class="px-3.5 py-3 text-sm">JulietteFecteau@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">07231 96 25 88</td>
                                <td class="px-3.5 py-3 text-sm">Belgium</td>
                                <td class="px-3.5 py-3 text-sm">1.9 Year</td>
                                <td class="px-3.5 py-3 text-sm">11 May, 2021</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001504</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-2.jpg"/>
                                        <h6 class="text-heading font-medium">Jonas Frederiksen</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">Team Leader</td>
                                <td class="px-3.5 py-3 text-sm">jonas@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">61 53 62 05</td>
                                <td class="px-3.5 py-3 text-sm">France</td>
                                <td class="px-3.5 py-3 text-sm">2.9 Year</td>
                                <td class="px-3.5 py-3 text-sm">18 Jan, 2019</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <tr class="text-default-800 font-normal whitespace-nowrap">
                                <td class="px-3.5 py-3 text-sm text-primary">#TWE1001505</td>
                                <td class="px-3.5 py-3 text-sm">
                                    <a class="flex gap-3 items-center" href="#">
                                        <img alt="" class="h-6 rounded-full" src="/images/user/user-4.jpg"/>
                                        <h6 class="text-heading font-medium">Kim Broberg</h6>
                                    </a>
                                </td>
                                <td class="px-3.5 py-3 text-sm">UI / UX Designer</td>
                                <td class="px-3.5 py-3 text-sm">KimBroberg@tailwick.com</td>
                                <td class="px-3.5 py-3 text-sm">040 382 2096</td>
                                <td class="px-3.5 py-3 text-sm">Finland</td>
                                <td class="px-3.5 py-3 text-sm">1.2 Year</td>
                                <td class="px-3.5 py-3 text-sm">23 April, 2021</td>
                                <td class="px-3.5 py-3">
                                    <div class="flex items-center gap-2">
                                        <a class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           href="#">
                                            <i class="size-3" data-lucide="eye"></i>
                                        </a>
                                        <a aria-controls="employeeEdit" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeEdit" href="#">
                                            <i class="size-4" data-lucide="pencil"></i>
                                        </a>
                                        <a aria-controls="employeeDelete" aria-expanded="false" aria-haspopup="dialog"
                                           class="flex size-8 bg-default-200 rounded-md items-center justify-center hover:bg-primary/10 hover:text-primary transition-all text-default-600"
                                           data-hs-overlay="#employeeDelete" href="#">
                                            <i class="size-4" data-lucide="trash-2"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>10</b> of <b>38</b> Results</p>
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
