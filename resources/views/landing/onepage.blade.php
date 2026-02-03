@extends('layouts.base', ['title' => 'One Page Landing'])

@section('css')
@endsection

@section('content')
    <header>
        <nav class="fixed inset-x-0 top-0 z-50 bg-card py-6 shadow flex justify-between items-center">
            <div class="container">
                <div class="grid lg:grid-cols-12 md:grid-cols-10 grid-cols-2 items-center">
                    <div class="lg:col-span-2 md:col-span-2">
                        <a href="{{ route('second', ['dashboards', 'index']) }}">
                            <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png" />
                            <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png" />
                        </a>
                    </div>
                    <div class="lg:col-span-8 md:col-span-6 md:block hidden">
                        <ul class="flex items-center justify-center lg:gap-8 md:gap-6 font-medium text-sm">
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300"
                                    href="#home">Home</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300" href="#features">Our
                                    Features</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300" href="#about">About
                                    Us</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300"
                                    href="#pricing">Pricing</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300"
                                    href="#contact">Contact</a>
                            </li>
                        </ul>
                    </div>
                    <div class="lg:col-span-2 md:col-span-2 flex items-center justify-end gap-2">
                        <button aria-controls="navbarMenu" aria-expanded="false" aria-haspopup="dialog"
                            class="btn size-9 bg-primary text-white md:hidden" data-hs-overlay="#navbarMenu">
                            <i data-lucide="menu"></i>
                        </button>
                        <a class="flex justify-end" href="#">
                            <button class="btn bg-primary text-white" type="button">
                                Sign In
                                <i class="size-4" data-lucide="log-in"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- hero section -->
    <section class="relative lg:pt-44 lg:pb-36 md:pt-34 md:pb-20 pt-30 pb-16">
        <div
            class="absolute rotate-45 size-125 border border-dashed border-t-default-300 border-l-default-300 border-r-default-300/40 border-b-default-700 rounded-full end-40 -bottom-62.5 z-20 lg:block hidden">
        </div>
        <div
            class="absolute rotate-45 size-175 border border-dashed border-t-default-300 border-l-default-300 border-r-default-300/40 border-b-default-700 rounded-full end-16 -bottom-87.5 z-20 lg:block hidden">
        </div>
        <div class="container">
            <div class="grid lg:grid-cols-2">
                <div>
                    <h1 class="mb-8 leading-relaxed md:text-5xl text-4xl font-semibold text-default-800">Effective
                        Management of
                        Large Projects at
                        <span
                            class="relative inline-block px-2 mx-2 before:block before:absolute before:-inset-1 before:-skew-y-6 before:bg-primary/10 before:rounded-md before:backdrop-blur-xl">
                            <span class="relative text-primary">Tailwick</span></span>
                    </h1>
                    <p class="mb-6 text-lg text-default-500">Effective professional services project management means
                        having a firm grasp on the scope, budget, resources, personnel, and timeline dedicated to a
                        project. An effective project manager is able to manage unplanned issues while keeping the
                        ball rolling on company goals and tasks in progress.
                    </p>
                    <div class="flex items-center gap-2.5">
                        <a href="#">
                            <button class="btn bg-primary text-white" type="button">
                                <i class="size-4" data-lucide="rocket"></i>
                                Get Started
                            </button>
                        </a>
                        <a href="#">
                            <button
                                class="btn hover:bg-danger border border-dashed border-danger hover:text-white bg-transparent text-danger"
                                type="button">
                                <i class="size-4" data-lucide="shopping-cart"></i>
                                Buy Now
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Feature section -->
    <section class="relative py-32 bg-default-900" id="features">
        <div class="container">
            <div class="grid lg:grid-cols-12 grid-cols-1 gap-5">
                <div class="lg:col-span-5 relative z-20 lg:order-1 order-2">
                    <div class="relative z-10 grid lg:grid-cols-2 grid-cols-3 gap-5">
                        <div class="lg:col-span-2">
                            <img alt="" class="rounded-xl ms-auto" src="/images/landing/widgets.jpg" />
                        </div>
                        <div class="lg:col-span-1 lg:mt-5">
                            <img alt="" class="rounded-xl" src="/images/landing/widgets-3.jpg" />
                        </div>
                        <div class="lg:col-span-1 lg:mt-5">
                            <img alt="" class="rounded-xl" src="/images/landing/widgets-2.jpg" />
                        </div>
                    </div>
                </div>
                <div class="lg:col-span-7 relative z-20 lg:-mt-72 lg:order-2 order-1">
                    <img alt="" class="rounded-xl shadow-2xl" src="/images/landing/home.jpg" />
                </div>
            </div>
            <div class="mt-24">
                <h1 class="mb-16 capitalize text-white font-semibold text-4xl leading-normal">Build for anyone who works
                    with Tailwick</h1>
            </div>
        </div>
        <div
            class="absolute rotate-45 size-125 border border-dashed border-default-300/40 rounded-full -start-80 bottom-48 z-10 lg:block hidden md:block">
        </div>
        <div
            class="absolute rotate-45 size-175 border border-dashed border-default-300/40 rounded-full -start-96 bottom-24 z-10 lg:block hidden md:block">
        </div>
    </section>
    <section class="relative z-20 pb-32 bg-default-100 dark:bg-default-950">
        <div class="container">
            <div class="grid lg:grid-cols-3 gap-6">
                <div class="card rounded-md shadow-md transition-all duration-300 hover:-translate-y-2 -mt-36">
                    <div class="card-body">
                        <div class="flex flex-col gap-y-6">
                            <img alt="" class="rounded-md shadow" src="/images/landing/chat.jpg" />
                            <div>
                                <span
                                    class="inline-flex items-center py-0.5 px-2.5 rounded text-xs font-medium border border-primary/30 bg-primary/15 text-primary">Popular
                                    Apps</span>
                                <h6 class="text-lg font-semibold mt-3 mb-2 text-default-800">
                                    <a href="#">Chat with Client &amp; Employee</a>
                                </h6>
                                <p class="mb-3 text-base text-default-500">A chat UI, or user interface, is one of the
                                    first things users see when using a web or mobile application to communicate.
                                </p>
                                <a class="text-primary text-base flex items-center gap-1.5" href="#">
                                    Read More
                                    <i class="size-4" data-lucide="move-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-md shadow-md transition-all duration-300 hover:-translate-y-2 lg:-mt-36">
                    <div class="card-body">
                        <div class="flex flex-col gap-y-6">
                            <img alt="" class="rounded-md shadow" src="/images/landing/email.jpg" />
                            <div>
                                <span
                                    class="inline-flex items-center py-0.5 px-2.5 rounded text-xs font-medium border border-secondary/30 bg-secondary/15 text-secondary">Email
                                    Apps</span>
                                <h6 class="text-lg font-semibold mt-3 mb-2 text-default-800">
                                    <a href="#">Exciting New Features Await You</a>
                                </h6>
                                <p class="mb-3 text-base text-default-500">A chat UI, or user interface, is one of the
                                    first things users see when using a web or mobile application to communicate.
                                </p>
                                <a class="text-primary text-base flex items-center gap-1.5" href="#">
                                    Read More
                                    <i class="size-4" data-lucide="move-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card rounded-md shadow-md transition-all duration-300 hover:-translate-y-2 lg:-mt-36">
                    <div class="card-body">
                        <div class="flex flex-col gap-y-6">
                            <img alt="" class="rounded-md shadow" src="/images/landing/order-overview.jpg" />
                            <div>
                                <span
                                    class="inline-flex items-center py-0.5 px-2.5 rounded text-xs font-medium border border-danger/20 bg-danger/15 text-danger">HR
                                    Management</span>
                                <h6 class="text-lg font-semibold mt-3 mb-2 text-default-800">
                                    <a href="#">Unleash Your Creativity with Our Latest Tools</a>
                                </h6>
                                <p class="mb-3 text-base text-default-500">A chat UI, or user interface, is one of the
                                    first things users see when using a web or mobile application to communicate.
                                </p>
                                <a class="text-primary text-base flex items-center gap-1.5" href="#">
                                    Read More
                                    <i class="size-4" data-lucide="move-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-10 rounded-md mt-20 bg-default-900 dark:bg-default-900">
                <div class="grid lg:grid-cols-5 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <h3 class="mb-2 text-white text-2xl font-semibold">
                            <span class="me-1" data-target="4">4</span>+
                        </h3>
                        <p class="text-base text-default-500">Multiple Layouts</p>
                    </div>
                    <div class="text-center">
                        <h3 class="mb-2 text-white text-2xl font-semibold">
                            <span class="me-1" data-target="12">12</span>+
                        </h3>
                        <p class="text-base text-default-500">Multi Languages </p>
                    </div>
                    <div class="text-center">
                        <h3 class="mb-2 text-white text-2xl font-semibold">
                            <span class="me-1" data-target="7">7</span>+
                        </h3>
                        <p class="text-base text-default-500">Apps &amp; Dashboard</p>
                    </div>
                    <div class="text-center">
                        <h3 class="mb-2 text-white text-2xl font-semibold">
                            <span class="me-1" data-target="4">4</span>+
                        </h3>
                        <p class="text-base text-default-500">Multiple Modes</p>
                    </div>
                    <div class="text-center">
                        <h3 class="mb-2 text-white text-2xl font-semibold">
                            <span class="me-1" data-target="36500">36500</span>+
                        </h3>
                        <p class="text-base text-default-500">Happy Customers</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section -->
    <section class="relative lg:py-24 md:py-12 py-14" id="about">
        <div class="container">
            <div class="flex flex-col lg:gap-y-20 gap-y-12">
                <div class="text-center lg:w-3xl mx-auto">
                    <h1 class="mb-6 leading-relaxed text-4xl font-semibold text-default-800">Why Developers Should
                        Embrace <span
                            class="relative inline-block px-2 mx-2 before:block before:absolute before:-inset-1 before:-skew-y-6 before:bg-primary/10 before:rounded-md before:backdrop-blur-xl"><span
                                class="relative text-primary">Tailwick</span></span></h1>
                    <p class="text-lg text-default-500">The purpose of developer communities is to provide the resources
                        for developers to learn anything they want to.
                    </p>
                </div>
                <div class="grid lg:grid-cols-12 gap-6 items-center">
                    <div class="lg:col-span-5">
                        <h1 class="mb-3 leading-normal capitalize text-4xl font-semibold text-default-800">
                            Craft a Complete Website Quickly with the Help of Design Blocks
                        </h1>
                        <p class="text-lg mb-6 text-default-500">The block design approach basically breaks the design
                            into small parts. These are built independently and then later combine into a
                            customizable page which makes a website more flexible in terms of layout and content.
                        </p>
                        <button class="btn border-primary text-primary hover:bg-primary hover:text-white" type="button">
                            Discover Now
                            <i class="size-4" data-lucide="move-right"></i>
                        </button>
                    </div>
                    <div class="lg:col-span-6">
                        <img alt="" class="shadow-lg lg:ms-auto rounded-xl"
                            src="/images/landing/widgets-4.jpg" />
                        <img alt="" class="shadow-lg -mt-24 rounded-xl ms-auto mr-24"
                            src="/images/landing/widgets-5.jpg" />
                    </div>
                </div>
                <div class="grid lg:grid-cols-12 gap-6 items-center lg:mt-12 mt-8">
                    <div class="lg:col-span-6 lg:order-1 order-2">
                        <img alt="" class="shadow-lg rounded-xl" src="/images/landing/widgets-6.jpg" />
                        <img alt="" class="shadow-lg -mt-24 ms-auto lg:me-24 md:me-40 rounded-xl"
                            src="/images/landing/widgets-7.jpg" />
                    </div>
                    <div class="lg:col-span-5 lg:order-2 order-1">
                        <h1 class="mb-3 leading-normal capitalize text-4xl font-semibold text-default-800">Boost Your
                            Business Using Our Potent Tools</h1>
                        <p class="text-lg mb-6 text-default-500">The block design approach basically breaks the design
                            into small parts. These are built independently and then later combine into a
                            customizable page which makes a website more flexible in terms of layout and content.
                        </p>
                        <button class="btn border-primary text-primary hover:bg-primary hover:text-white" type="button">
                            Discover Now
                            <i class="size-4" data-lucide="move-right"></i>
                        </button>
                    </div>
                </div>
                <div class="grid lg:grid-cols-12 gap-6 items-center lg:mt-12 mt-8">
                    <div class="lg:col-span-5">
                        <h1 class="mb-3 leading-normal capitalize text-4xl font-semibold text-default-800">Building a
                            User-Friendly Website is Effortless</h1>
                        <p class="text-lg mb-4 text-default-500">With a user-friendly interface and easy navigation,
                            the user decreases search time and increases satisfaction, fulfilling his needs in a
                            fast and efficient way.</p>
                        <ul class="flex flex-col gap-y-3 mb-6 text-lg list-disc list-inside text-default-900">
                            <li>
                                6+ Ready touse Dashboard
                            </li>
                            <li>
                                Light, Dark &amp; RTL Mode Support
                            </li>
                            <li>
                                Multiple Layouts Support
                            </li>
                        </ul>
                        <button class="btn border-primary text-primary hover:bg-primary hover:text-white" type="button">
                            Discover Now
                            <i class="size-4" data-lucide="move-right"></i>
                        </button>
                    </div>
                    <div class="lg:col-span-6">
                        <img alt="" class="shadow-lg lg:ms-auto me-auto rounded-xl"
                            src="/images/landing/widgets-8.jpg" />
                        <img alt="" class="shadow-lg -mt-24 rounded-xl ms-auto lg:me-24 mr-40"
                            src="/images/landing/widgets-9.jpg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- pricing section -->
    <section class="relative lg:pb-24 md:pb-18 pb-12" id="pricing">
        <div class="container">
            <div class="flex flex-col gap-y-16">
                <div class="text-center lg:w-3xl mx-auto">
                    <h1 class="mb-4 leading-relaxed text-4xl font-semibold text-default-800">Tailored Website Design
                        Package</h1>
                    <p class="text-lg text-default-500">A good web design package will include designing a
                        logo,ingratiation with local SEO, linking a site to a social media presence, and more.
                    </p>
                </div>
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
            </div>
        </div>
    </section>
    <!-- contact section -->
    <section class="relative py-20 bg-blue-700/80 dark:bg-blue-900" id="contact">
        <div
            class="absolute size-125 border border-dashed rotate-45 border-t-primary border-l-primary border-r-default-700 border-b-default-700 rounded-full right-40 -bottom-62.5 z-10 lg:block hidden">
        </div>
        <div class="container">
            <div class="lg:flex justify-between items-center">
                <div>
                    <h1 class="mb-4 capitalize text-blue-50 leading-normal text-4xl font-semibold">
                        Ready to get started with Tailwick
                    </h1>
                    <p class="text-lg text-blue-200">Tell us which describes you, and we'll get in touch with next
                        steps.
                    </p>
                </div>
                <button class="relative z-20 btn bg-card hover:text-blue-800 text-primary lg:mt-0 md:mt-4" type="button">
                    <i class="size-4" data-lucide="shopping-cart"></i>
                    Purchase Now
                </button>
            </div>
        </div>
    </section>
    <footer class="relative pt-20 pb-12 bg-default-800 dark:bg-default-900">
        <div class="container">
            <div class="relative z-10 grid lg:grid-cols-12 md:grid-cols-2 gap-5">
                <div class="lg:col-span-3">
                    <h5 class="mb-4 font-medium text-white text-lg">Dashboards</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Analytics</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">CRM</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Ecommerce</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Email</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full ore:transition-all before:duration-300 before:ease-linear"
                                href="#">HR</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Social
                                Media</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3">
                    <h5 class="mb-4 font-medium text-white text-lg">Apps Pages</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Ecommerce
                                Apps
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Invoices</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Email
                                App
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Chat
                                App
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full ore:transition-all before:duration-300 before:ease-linear"
                                href="#">
                                Users Apps
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">HR
                                Management
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Social
                                Media
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3">
                    <h5 class="mb-4 font-medium text-white text-lg">Resources</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">All
                                Resources
                            </a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Blog</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">FAQ's</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-400 before:absolute before:border-b before:border-default-400 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Help
                                Center
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3">
                    <div class="flex p-1 lg:w-96 md:w-90 w-86 rounded-md border border-white/14 bg-card/4 relative mb-6">
                        <input class="px-3 text-sm text-white border-none bg-transparent focus:outline-none focus:ring-0"
                            placeholder="tailwick@themesdesign.in" type="email" />
                        <button class="absolute right-2 btn text-white bg-primary hover:bg-primary/90" type="button">
                            Subscribe Now
                        </button>
                    </div>
                    <div>
                        <p class="mb-1 text-sm text-default-400">Support Email</p>
                        <h5 class="text-lg text-white">support@themesdesign.in</h5>
                    </div>
                    <div class="mt-6">
                        <p class="mb-1 text-sm text-default-400">Contact Us</p>
                        <h5 class="text-lg text-white">+(012) 1202 012 4567</h5>
                    </div>
                </div>
            </div>
            <div class="py-5 mt-20 border-y border-default-400/40">
                <div class="md:flex justify-between items-center">
                    <div class="hs-dropdown relative inline-flex">
                        <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                            class="hs-dropdown-toggle py-2 px-4 bg-transparent border border-default-400/40 text-white hover:border-primary rounded hover:text-primary font-semibold gap-2 flex items-center"
                            id="hs-dropdown-with-icons" type="button">
                            <img alt="" class="size-5 rounded-full" src="/images/flags/us.jpg" />
                            English
                        </button>
                        <div aria-labelledby="hs-dropdown-with-icons" aria-orientation="vertical"
                            class="hs-dropdown-menu p-2 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden min-w-38 card z-40 mt-2 divide-y divide-default-200"
                            role="menu">
                            <div class="p-1 space-y-3 text-sm font-normal">
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/us.jpg" />
                                    English
                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/spain.jpg" />
                                    Spanish
                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/germany.jpg" />
                                    German

                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/french.jpg" />
                                    French
                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/japanese.svg" />
                                    Japanese
                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/italy.jpg" />
                                    Italian
                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/russia.jpg" />
                                    Russian

                                </a>
                                <a class="flex items-center gap-x-3.5 px-3 text-default-600 hover:text-primary"
                                    href="#">
                                    <img alt="" class="size-4 rounded-full" src="/images/flags/arebian.svg" />
                                    Arabic
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-3 md:mt-0 mt-5">
                        <button
                            class="size-10 btn border border-default-400/40 bg-transparent rounded-full text-default-400 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="facebook"></i>
                        </button>
                        <button
                            class="size-10 btn border border-default-400/40 bg-transparent rounded-full text-default-400 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="linkedin"></i>
                        </button>
                        <button
                            class="size-10 btn border border-default-400/40 bg-transparent rounded-full text-default-400 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="instagram"></i>
                        </button>
                        <button
                            class="size-10 btn border border-default-400/40 bg-transparent rounded-full text-default-400 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="twitter"></i>
                        </button>
                        <button
                            class="size-10 btn border border-default-400/40 bg-transparent rounded-full text-default-400 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="youtube"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="text-base mt-12 text-center text-default-400">
                <p>2025 © Tailwick. Design &amp; Develop by <a class="underline text-white hover:text-primary"
                        href="#">Themesdesign</a>
                </p>
            </div>
        </div>
    </footer>
    <div aria-labelledby="navbarMenu-label"
        class="hs-overlay hs-overlay-open:translate-y-0 -translate-y-full fixed top-0 inset-x-0 transition-all duration-300 transform max-h-64 p-5 size-full z-80 card border-b border-default-200 hidden"
        id="navbarMenu" role="dialog" tabindex="-1">
        <div class="flex items-center justify-between">
            <a href="#">
                <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png" />
                <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png" />
            </a>
            <button aria-label="Close" class="inline-flex justify-end items-center gap-x-2 rounded-full"
                data-hs-overlay="#navbarMenu">
                <i class="size-4" data-lucide="x"></i>
            </button>
        </div>
        <div class="pt-8">
            <ul class="flex flex-col gap-y-4 lg:gap-8 md:gap-6 font-semibold text-sm">
                <li>
                    <a class="text-secondary-default-400 hover:text-primary transition duration-300"
                        href="#home">Home</a>
                </li>
                <li>
                    <a class="text-secondary-default-400 hover:text-primary transition duration-300" href="#features">Our
                        Features</a>
                </li>
                <li>
                    <a class="text-secondary-default-400 hover:text-primary transition duration-300" href="#about">About
                        Us</a>
                </li>
                <li>
                    <a class="text-secondary-default-400 hover:text-primary transition duration-300"
                        href="#pricing">Pricing</a>
                </li>
                <li>
                    <a class="text-secondary-default-400 hover:text-primary transition duration-300"
                        href="#contact">Contact</a>
                </li>
            </ul>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
