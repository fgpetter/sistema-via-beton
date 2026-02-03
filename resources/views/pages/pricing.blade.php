@extends('layouts.vertical', ['title' => 'Pricing'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Pages', 'title' => 'Pricing'] )

    <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-5 mb-6">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-2 flex items-center gap-1.5">
                    <i class="text-success size-5" data-lucide="goal"></i>
                    <span class="text-lg font-semibold text-default-800">Lite</span>
                </h5>
                <p class="mb-4 text-default-500">Perfect plan for Lite</p>
                <h1 class="mb-4 text-4xl text-default-800 font-normal">
                    <span class="text-default-400">$</span>9.99<small
                        class="text-base text-default-500">/Monthly</small>
                </h1>
                <button
                    class="btn border w-full border-dashed border-primary bg-transparent text-primary hover:bg-primary/20"
                    type="button">
                    Purchase Now
                </button>
                <ul class="mt-5 flex flex-col gap-3 text-sm">
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> Projects</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>299 </b>Customers</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Scalable Bandwidth</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>0</b>No Team Account</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">In app messaging</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">5 FTP Login</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Detailed Analytics</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Custom Domain</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Smart Workflow</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">IQ test</del>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-2 flex items-center gap-1.5">
                    <i class="text-secondary size-5" data-lucide="graduation-cap"></i>
                    <span class="text-lg font-semibold text-default-800">Professional</span>
                </h5>
                <p class="mb-4 text-default-500">For users who want to do more.</p>
                <h1 class="mb-4 text-4xl text-default-800 font-normal">
                    <span class="text-default-400">$</span>29.99<small
                        class="text-base text-default-500">/Monthly</small>
                </h1>
                <button
                    class="btn border w-full border-dashed border-primary bg-transparent text-primary hover:bg-primary/20"
                    type="button">Purchase
                    Now
                </button>
                <ul class="mt-5 flex flex-col gap-3 text-sm">
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> Projects</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>299</b>Customers</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Scalable Bandwidth</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> No Team Account</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">In app messaging</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">5 FTP Login</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Detailed Analytics</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Custom Domain</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Smart Workflow</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">IQ test</del>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card relative overflow-hidden">
            <div class="card-body">
                <div class="size-16 absolute top-0 end-0">
                    <div
                        class="absolute bg-primary text-center w-42.5 text-white py-1 transform rotate-45 top-6 -end-12 font-semibold">
                        25% Sale
                    </div>
                </div>
                <h5 class="mb-2 flex items-center gap-1.5">
                    <i class="text-primary size-5" data-lucide="crown"></i>
                    <span class="text-lg font-semibold text-default-800"> Enterprise</span>
                </h5>
                <p class="mb-4 text-default-500">Run your company on your teams</p>
                <h1 class="mb-4 text-4xl text-default-800 font-normal">
                    <span class="text-default-400">$</span>39.99<small
                        class="text-base text-default-500">/Monthly</small>
                </h1>
                <button
                    class="btn border w-full border-dashed border-primary bg-transparent text-primary hover:bg-primary/20"
                    type="button">Purchase
                    Now
                </button>
                <ul class="mt-5 flex flex-col gap-3 text-sm">
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> Projects</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>299</b>Customers</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Scalable Bandwidth</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> No Team Account</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">In app messaging</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">5 FTP Login</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Detailed Analytics</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Custom Domain</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">Smart Workflow</del>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-danger" data-lucide="x"></i>
                        <del class="text-default-500">IQ test</del>
                    </li>
                </ul>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-2 flex items-center gap-1.5">
                    <i class="text-danger size-5" data-lucide="luggage"></i>
                    <span class="text-lg font-semibold text-default-800">Unlimited</span>
                </h5>
                <p class="mb-4 text-default-500">Your entire team in one place</p>
                <h1 class="mb-4 text-4xl text-default-800 font-normal">
                    <span class="text-default-400">$</span>49.99<small
                        class="text-base text-default-500">/Monthly</small>
                </h1>
                <button
                    class="btn border w-full border-dashed border-primary bg-transparent text-primary hover:bg-primary/20"
                    type="button">Purchase
                    Now
                </button>
                <ul class="mt-5 flex flex-col gap-3 text-sm">
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> Projects</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>299</b>Customers</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Scalable Bandwidth</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900"><b>3</b> No Team Account</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">In app messaging</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">5 FTP Login</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Detailed Analytics</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Custom Domain</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">Smart Workflow</span>
                    </li>
                    <li class="flex items-center gap-2.5">
                        <i class="size-4 text-success" data-lucide="check-check"></i>
                        <span class="text-default-900">IQ test</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <h5 class="mt-2 mb-4 underline text-lg font-semibold text-default-700">Horizontal Pricing</h5>
    <div class="grid lg:grid-cols-2 gap-5">
        <div class="card">
            <div class="card-body">
                <h5 class="text-lg mb-2 font-semibold text-default-800">Personal Plan</h5>
                <div class="grid lg:grid-cols-3 gap-5">
                    <div class="lg:col-span-2">
                        <p class="relative before:content-[''] before:absolute before:border-b before:border-default-200 before:bottom-2 before:start-0 before:end-0">
                            <span class="pe-2 bg-card relative text-default-500 text-sm">Everything Includes</span>
                        </p>
                        <div class="grid md:grid-cols-2 md:gap-5">
                            <div>
                                <ul class="mt-5 flex flex-col gap-3 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>3</b> Projects</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>299</b> Customers</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900">Scalable Bandwidth</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>0</b>No Team Account</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <ul class="mt-5 flex flex-col gap-3 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>3</b> Projects</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>299</b> Customers</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-sapn-1">
                        <div class="p-5 bg-primary/10 rounded-lg">
                            <div class="text-white">
                                <p class="text-primary text-sm mb-4">Per Month</p>
                                <p class="text-primary text-2xl font-bold mb-4">$29.99</p>
                                <button class="py-1.5 px-4 w-full bg-blue-600 rounded-md" type="button">Buy
                                    Now
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5 class="text-lg mb-2 font-semibold text-default-800">Enterprise Plan</h5>
                <div class="grid lg:grid-cols-3 gap-5">
                    <div class="lg:col-span-2">
                        <p class="relative before:content-[''] before:absolute before:border-b before:border-default-200 before:bottom-2 before:end-0 before:start-0">
                            <span class="pe-2 bg-card relative text-default-500 text-sm">Everything Includes</span>
                        </p>
                        <div class="grid md:grid-cols-2 md:gap-5">
                            <div>
                                <ul class="mt-5 flex flex-col gap-3 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>3</b> Projects</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>299</b> Customers</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900">Scalable Bandwidth</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>0</b>No Team Account</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <ul class="mt-5 flex flex-col gap-3 text-sm">
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>3</b> Projects</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>299</b> Customers</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900">Scalable Bandwidth</span>
                                    </li>
                                    <li class="flex items-center gap-2">
                                        <i class="size-4 text-success" data-lucide="check-square"></i>
                                        <span class="text-default-900"><b>0</b>No Team Account</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="lg:col-sapn-1">
                        <div class="p-5 bg-purple-500/20 rounded-lg">
                            <div class="kt-card-content">
                                <p class="text-sm mb-4 text-purple-600">Per Month</p>
                                <p class="text-2xl font-bold mb-4 text-default-800">$49.99</p>
                                <button class="py-1.5 px-4 w-full rounded-md bg-purple-600 text-white" type="button">Buy
                                    Now
                                </button>
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
