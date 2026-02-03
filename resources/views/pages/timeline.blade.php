@extends('layouts.vertical', ['title' => 'Timeline'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Components', 'title' => 'Timeline'] )

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-4 mb-5">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Circle Timeline</h6>
                <div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Invitation Sent</h6>
                        <p class="mb-2 text-default-400">No candidate reply</p>
                        <p class="text-sm text-default-400">02 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Sent to reminder to candidate</h6>
                        <p class="mb-2 text-default-500">Preview message sent</p>
                        <p class="text-sm text-default-500">15 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Scheduled</h6>
                    </div>
                    <div
                        class="relative px-6 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5">
                        <h6 class="mb-4 text-base font-semibold">Interview Done</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Square Timeline</h6>
                <div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Invitation Sent</h6>
                        <p class="mb-2 text-default-400">No candidate reply</p>
                        <p class="text-sm text-default-400">02 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Sent to reminder to candidate</h6>
                        <p class="mb-2 text-default-500">Preview message sent</p>
                        <p class="text-sm text-default-500">15 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Scheduled</h6>
                    </div>
                    <div
                        class="relative px-6 after:absolute after:size-2 after:bg-primary after:start-0 after:end-0 after:top-1.5">
                        <h6 class="mb-4 text-base font-semibold">Interview Done</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Progress Timeline</h6>
                <div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:end-0.75 before:border-primary before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Invitation Sent</h6>
                        <p class="mb-2 text-default-500">No candidate reply</p>
                        <p class="text-sm text-default-500">02 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:end-0.75 before:border-primary before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Sent to reminder to candidate</h6>
                        <p class="mb-2 text-default-500">Preview message sent</p>
                        <p class="text-sm text-default-500">15 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-primary after:rounded-full after:start-0 after:end-0 after:top-1.5 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Scheduled</h6>
                    </div>
                    <div
                        class="relative px-6 after:absolute after:size-2 after:bg-card after:border after:border-default-200 after:rounded-full after:start-0 after:end-0 after:top-1.5">
                        <h6 class="mb-4 text-base font-semibold">Interview Done</h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Outline Timeline</h6>
                <div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-card after:border after:rounded-full after:start-0 after:end-0 after:top-1.5 after:border-default-200 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Invitation Sent</h6>
                        <p class="mb-2 text-default-500">No candidate reply</p>
                        <p class="text-sm text-default-500">02 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-card after:border after:rounded-full after:start-0 after:end-0 after:top-1.5 after:border-default-200 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Sent to reminder to candidate</h6>
                        <p class="mb-2 text-default-500">Preview message sent</p>
                        <p class="text-sm text-default-500">15 Aug, 2023</p>
                    </div>
                    <div
                        class="relative px-6 before:absolute before:border-s before:start-0.75 before:border-default-200 before:end-0.75 before:top-1.5 before:-bottom-1.5 after:absolute after:size-2 after:bg-card after:border after:rounded-full after:start-0 after:end-0 after:top-1.5 after:border-default-200 pb-4">
                        <h6 class="mb-4 text-base font-semibold">Scheduled</h6>
                    </div>
                    <div
                        class="relative px-6 after:absolute after:size-2 after:bg-card after:border-default-200 after:border after:rounded-full after:start-0 after:end-0 after:top-1.5">
                        <h6 class="mb-4 text-base font-semibold">Interview Done</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="mb-5 text-heading font-semibold underline text-lg"></h5>
    <div class="grid lg:grid-cols-2 grid-cols-1 gap-4 mb-5">
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Timeline with Avatar</h6>
                <div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <img alt="" class="size-8 p-0.5 bg-card border rounded-full shrink-0 border-default-200"
                                 src="/images/user/avatar-1.png"/>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Purchased by James Price</h6>
                                <p class="mb-2 text-default-500">Product noise evolve smartwatch</p>
                                <p class="text-sm text-default-500">05:57 AM Today</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <img alt="" class="size-8 p-0.5 bg-card border rounded-full shrink-0 border-default-200"
                                 src="/images/user/avatar-2.png"/>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Natasha Carey have liked the
                                    products</h6>
                                <p class="mb-2 text-default-500">Allow users to like products in your WooCommerce
                                    store.</p>
                                <p class="text-sm text-default-500">25 Dec, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <img alt="" class="size-8 p-0.5 bg-card border rounded-full shrink-0 border-default-200"
                                 src="/images/user/avatar-3.png"/>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Today offers by Digitech Galaxy</h6>
                                <p class="mb-2 text-default-500">Offer is valid on orders of $230 Or above for selected
                                    products only.</p>
                                <p class="text-sm text-default-500">12 Dec, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="relative flex gap-2">
                            <img alt="" class="size-8 p-0.5 bg-card border rounded-full shrink-0 border-default-200"
                                 src="/images/user/avatar-3.png"/>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">New ticket received</h6>
                                <p class="mb-2 text-default-500">User <a class="text-primary" href="#">Erica245</a>
                                    submitted a ticket</p>
                                <p class="text-sm text-default-500">26 Dec, 2023</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h6 class="mb-4 card-title">Timeline with Avatar</h6>
                <div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <div
                                class="size-8 p-0.5 bg-card text-primary flex items-center justify-center border rounded-full shrink-0 border-default-200">
                                <i class="size-4 text-primary" data-lucide="bar-chart-horizontal-big"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Purchased by James Price</h6>
                                <p class="mb-2 text-default-500">Product noise evolve smartwatch</p>
                                <p class="text-sm text-default-500">05:57 AM Today</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <div
                                class="size-8 p-0.5 bg-card text-primary flex items-center justify-center border rounded-full shrink-0 border-default-200">
                                <i class="size-4 text-danger" data-lucide="store"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Natasha Carey have liked the
                                    products</h6>
                                <p class="mb-2 text-default-500">Allow users to like products in your WooCommerce
                                    store.</p>
                                <p class="text-sm text-default-500">25 Dec, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="relative before:absolute before:border-s-2 before:border-default-200 before:start-3.5 before:end-3.5 before:top-1.5 before:-bottom-1.5 pb-4">
                        <div class="relative flex gap-2">
                            <div
                                class="size-8 p-0.5 bg-card text-primary flex items-center justify-center border rounded-full shrink-0 border-default-200">
                                <i class="size-4 text-green-500" data-lucide="shopping-cart"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">Today offers by Digitech Galaxy</h6>
                                <p class="mb-2 text-default-500">Offer is valid on orders of $230 Or above for selected
                                    products only.</p>
                                <p class="text-sm text-default-500">12 Dec, 2023</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="relative flex gap-2">
                            <div
                                class="size-8 p-0.5 bg-card text-primary flex items-center justify-center border rounded-full shrink-0 border-default-200">
                                <i class="size-4 text-purple-500" data-lucide="percent"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 text-sm text-heading font-semibold">New ticket received</h6>
                                <p class="mb-2 text-default-500">User <a class="text-primary" href="#">Erica245</a>
                                    submitted a ticket</p>
                                <p class="text-sm text-default-500">26 Dec, 2023</p>
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
