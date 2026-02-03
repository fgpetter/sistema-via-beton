@extends('layouts.base', ['title' => 'Landing'])

@section('css')
@endsection

@section('content')
    <!-- Header -->
    <header>
        <nav class="fixed inset-x-0 top-0 z-50 bg-card py-6 border-b border-default-150 flex justify-between items-center">
            <div class="container">
                <div class="grid lg:grid-cols-12 md:grid-cols-10 grid-cols-3 items-center">
                    <div class="lg:col-span-2 md:col-span-2 col-span-1">
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
                                <a class="text-default-800 hover:text-primary transition duration-300" href="#product">Our
                                    Products
                                </a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300"
                                    href="#Features">Features</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300" href="#About">About
                                    Us</a>
                            </li>
                            <li>
                                <a class="text-default-800 hover:text-primary transition duration-300"
                                    href="#Feedback">Feedback</a>
                            </li>
                        </ul>
                    </div>
                    <div class="lg:col-span-2 md:col-span-2 col-span-2 flex items-center justify-end gap-4">
                        <button aria-controls="navbarMenu" aria-expanded="false" aria-haspopup="dialog"
                            class="flex justify-center items-center size-9 bg-primary/90 hover:bg-primary text-white rounded md:hidden"
                            data-hs-overlay="#navbarMenu">
                            <i data-lucide="menu"></i>
                        </button>
                        <button type="button">
                            <i class="size-4 text-default-500 hover:text-primary transition-all"
                                data-lucide="shopping-bag"></i>
                        </button>
                        <a class="flex justify-end" href="#">
                            <button
                                class="btn border-0 bg-gradient-to-r from-primary to-purple-500 hover:from-purple-500 hover:to-primary text-white">
                                Sign In
                                <i class="size-4" data-lucide="log-in"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Mobile menu -->
    <div aria-labelledby="navbarMenu-label"
        class="hs-overlay hs-overlay-open:translate-y-0 -translate-y-full fixed top-0 inset-x-0 transition-all duration-300 transform max-h-64 p-5 size-full z-80 card border-b border-default-100 hidden"
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
                    <a class="text-default-800 hover:text-primary transition duration-300" href="#home">Home</a>
                </li>
                <li>
                    <a class="text-default-800 hover:text-primary transition duration-300" href="#product">Our
                        Products</a>
                </li>
                <li>
                    <a class="text-default-800 hover:text-primary transition duration-300" href="#Features">Features</a>
                </li>
                <li>
                    <a class="text-default-800 hover:text-primary transition duration-300" href="#About">About Us</a>
                </li>
                <li>
                    <a class="text-default-800 hover:text-primary transition duration-300" href="#Feedback">Feedback</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- hero section -->
    <section class="relative lg:pb-24 md:pt-48 pt-40" id="home">
        <div class="absolute top-0 start-0 size-64 bg-primary/10 blur-3xl"></div>
        <div class="absolute bottom-0 end-0 size-64 bg-purple-500/10 blur-3xl"></div>
        <div class="container">
            <div class="grid lg:grid-cols-12 items-center gap-5">
                <div class="lg:col-span-5">
                    <h1 class="mb-4 leading-relaxed lg:text-6xl md:text-4xl text-4xl font-semibold text-default-800">
                        Exclusive Collections 2024</h1>
                    <p class="mb-6 text-lg text-default-500">In 2024, metallics will be taking over the sneaker world. I
                        love this trend because there are so many different ways to wear it. You can wear sequined
                        sneakers, white sneakers with metallic accents, or all-over silver.</p>
                    <div>
                        <a href="#">
                            <button
                                class="btn border-0 bg-gradient-to-r from-primary to-purple-500 hover:from-purple-500 hover:to-primary text-white rounded-md"
                                type="button">
                                Shop Now<i class="size-4" data-lucide="shopping-cart"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="lg:col-span-6">
                    <div class="relative">
                        <div
                            class="absolute text-center -z-20 -top-20 -end-64 md:text-[10rem] lg:text-[14rem] text-default-100/50 font-normal font-tourney lg:block hidden">
                            Unique Fashion
                        </div>
                        <div class="hs-tooltip [--placement:top] inline-block z-40">
                            <button
                                class="hs-tooltip-toggle size-10 justify-center items-center rounded-full absolute lg:flex hidden bottom-20 bg-card text-black left-60"
                                type="button">
                                <i class="size-5" data-lucide="plus"></i>
                                <span
                                    class="hs-tooltip-content hs-tooltip-shown:opacity-100 hs-tooltip-shown:visible opacity-0 transition-opacity inline-block absolute invisible py-1 px-2 bg-default-900 text-xs font-medium text-white rounded-md shadow-2xs dark:bg-neutral-700"
                                    role="tooltip">
                                    $199.99
                                </span>
                            </button>
                            <img alt="" class="lg:ms-40 md:ms-20 w-xl mx-auto"
                                src="/images/landing/product-home.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product section -->
    <section class="relative lg:py-32 py-20" id="product">
        <div class="container">
            <div class="lg:w-3xl mx-auto text-center">
                <h1 class="leading-normal capitalize text-4xl font-semibold text-default-800">Our Latest Product</h1>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5 mt-12">
                <div class="card bg-gradient-to-b from-default-100 to-default-50/40 shadow-none rounded-md">
                    <div class="card-body">
                        <img alt="" class="mx-auto h-52" src="/images/landing/img-16.png" />
                        <div class="mt-3">
                            <p class="mb-3 flex items-center gap-1">
                                <i class="text-amber-500 size-4" data-lucide="star"></i> (4.8)
                            </p>
                            <h5 class="text-lg font-semibold text-default-800">
                                <a href="#">Green Sneakers Skate</a>
                            </h5>
                            <div class="flex justify-between items-center mt-3">
                                <h6 class="text-base font-semibold text-default-800">$299.99</h6>
                                <div>
                                    <button class="btn btn-sm bg-primary text-white" type="button">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-to-b from-default-100 to-default-50/40 shadow-none rounded-md">
                    <div class="card-body">
                        <img alt="" class="mx-auto h-52" src="/images/landing/img-17.png" />
                        <div class="mt-3">
                            <p class="mb-3 flex items-center gap-1">
                                <i class="text-amber-500 size-4" data-lucide="star"></i> (4.4)
                            </p>
                            <h5 class="text-lg font-semibold text-default-800">
                                <a href="#">Nike Running Shoes</a>
                            </h5>
                            <div class="flex justify-between items-center mt-3">
                                <h6 class="text-base font-semibold text-default-800">$129.49</h6>
                                <div>
                                    <button class="btn btn-sm bg-primary text-white" type="button">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-to-b from-default-100 to-default-50/40 shadow-none rounded-md">
                    <div class="card-body">
                        <img alt="" class="mx-auto h-52" src="/images/landing/img-18.png" />
                        <div class="mt-3">
                            <p class="mb-3 flex items-center gap-1">
                                <i class="text-amber-500 size-4" data-lucide="star"></i> (4.9)
                            </p>
                            <h5 class="text-lg font-semibold text-default-800">
                                <a href="#">Nike Air Max Sneakers Shoe</a>
                            </h5>
                            <div class="flex justify-between items-center mt-3">
                                <h6 class="text-base font-semibold text-default-800">$149.99</h6>
                                <div>
                                    <button class="btn btn-sm bg-primary text-white" type="button">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card bg-gradient-to-b from-default-100 to-default-50/40 shadow-none rounded-md">
                    <div class="card-body">
                        <img alt="" class="mx-auto h-52" src="/images/landing/img-19.png" />
                        <div class="mt-3">
                            <p class="mb-3 flex items-center gap-1">
                                <i class="text-amber-500 size-4" data-lucide="star"></i> (4.6)
                            </p>
                            <h5 class="text-lg font-semibold text-default-800">
                                <a href="#">Dunk Sneakers Skate shoe</a>
                            </h5>
                            <div class="flex justify-between items-center mt-3">
                                <h6 class="text-base font-semibold text-default-800">$174.65</h6>
                                <div>
                                    <button class="btn btn-sm bg-primary text-white" type="button">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features section -->
    <section class="relative lg:pb-28 pb-10" id="Features">
        <div class="absolute top-0 start-0 size-64 bg-purple-500/10 blur-3xl"></div>
        <div>
            <div class="container">
                <div class="grid lg:grid-cols-2 items-center">
                    <div class="lg:w-lg">
                        <h1 class="mb-3 leading-normal capitalize text-4xl font-semibold text-default-800">Explore our
                            flagship product and discover its unique features</h1>
                        <p class="mb-5 text-lg text-default-500">Whatever your running gait, a good pair of running
                            shoes will provide flexibility, durability, and support.</p>
                        <ul class="flex flex-col gap-y-2 mb-6 list-disc list-inside text-sm text-default-800">
                            <li>
                                Matches Your Foot Shape &amp; Type
                            </li>
                            <li>
                                Easy to Wear
                            </li>
                            <li>
                                Heels That You Can Wear
                            </li>
                            <li>
                                Good Quality &amp; Condition
                            </li>
                            <li>
                                Segments of Solid Rubber
                            </li>
                        </ul>
                        <a class="btn text-primary text-base" href="#">Shopping Now<i class="size-4"
                                data-lucide="move-right"></i></a>
                    </div>
                    <div class="relative lg:mt-0 mt-6">
                        <div class="absolute start-0 bg-center bg-cover lg:bottom-40 bottom-20 w-52 h-96 bg-[url('/images/cta-2.png')] rounded-md md:block hidden"
                            data-aos="fade-left" data-aos-delay="400">
                            <div class="absolute inset-0 bg-gradient-to-b from-purple-500/30 to-accent from-30%"></div>
                        </div>
                        <div class="md:ms-20">
                            <img alt="" class="w-lg relative inline-block" src="/images/landing/cta.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- about section -->
    <section class="relative lg:pb-28 md:pb-18 pb-12" id="About">
        <div class="absolute bottom-0 end-0 size-64 bg-primary/10 blur-3xl"></div>
        <div class="container">
            <div class="grid lg:grid-cols-2 items-center lg:gap-40 gap-5 mt-20">
                <div class="relative">
                    <div
                        class="relative before:absolute before:h-full before:w-full before:border-[15px] before:border-double before:border-green-500/10 lg:before:-top-16 lg:before:-end-16 md:before:-top-8 md:before:-end-1 before:-end-1.5 before:-top-8">
                        <img alt="" class="rounded-lg relative z-20" src="/images/landing/about.jpg" />
                    </div>
                </div>
                <div class="lg:ms-auto">
                    <p class="mb-2 text-purple-500 text-base">About Us</p>
                    <h1 class="mb-3 leading-normal capitalize text-4xl font-semibold text-default-800">We Provide high
                        Quality shoes</h1>
                    <p class="mb-5 text-lg text-default-500">Look for a shoe with solid construction that will give your
                        feet
                        the support they need. Next, look for quality materials that will make your feet comfortable and
                        keep them healthy.
                    </p>
                    <p class="mb-5 text-lg text-default-500">Low-quality shoes may skimp on stitching, or use low
                        quality
                        glue that's prone to coming apart. A higher-quality shoe will use advanced construction to
                        ensure
                        that the shoe holds up over time, and also eliminate any spots.
                    </p>
                    <button
                        class="btn border-0 bg-gradient-to-r from-primary to-purple-500 hover:from-purple-500 hover:to-primary text-white"
                        type="button">
                        Explore Now <i class="size-4" data-lucide="move-right"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
    <!-- feedback section -->
    <section class="relative lg:pb-28 md:pb-18 pb-12" id="Feedback">
        <div class="container">
            <div class="mx-auto md:mb-8 text-center lg:w-3xl">
                <h1 class="leading-normal capitalize md:text-4xl text-3xl font-semibold text-default-800">What Our
                    Customer Says</h1>
            </div>
            <div class="swiper mySwiper">
                <div class="swiper-wrapper mb-9">
                    <div class="swiper-slide">
                        <div class="p-5 text-center aos-init aos-animate" data-aos="fade-up" data-aos-easing="linear">
                            <div class="mx-auto rounded-full size-20 bg-purple-500/10">
                                <img alt="" class="rounded-full size-20" src="/images/user/avatar-9.png" />
                            </div>
                            <p class="mt-6 text-default-600 text-base">" ThemesDesign used Anydesk to fix the bug in
                                Flask and django
                                version. I highly recommend
                                this product! "
                            </p>
                            <h6 class="mt-4 mb-2 text-base text-default-900 font-semibold"><a href="#">Anthony
                                    Hobbs</a></h6>
                            <div class="text-yellow-500 flex items-center justify-center gap-1">
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="p-5 text-center aos-init aos-animate" data-aos="fade-up" data-aos-easing="linear">
                            <div class="mx-auto rounded-full size-20 bg-primary/10">
                                <img alt="" class="rounded-full size-20" src="/images/user/avatar-2.png" />
                            </div>
                            <p class="mt-6 text-default-600 text-base">" The best templates which is supported multiple
                                programming languages
                                with beautiful templates. thank you for the valuable template. "</p>
                            <h6 class="mt-4 mb-2 text-base text-default-900 font-semibold"><a href="#">Angela
                                    Ulligan</a></h6>
                            <div class="text-yellow-500 flex items-center justify-center gap-1">
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="p-5 text-center aos-init aos-animate" data-aos="fade-up" data-aos-easing="linear">
                            <div class="mx-auto rounded-full size-20 bg-amber-500/10">
                                <img alt="" class="rounded-full size-20" src="/images/user/avatar-4.png" />
                            </div>
                            <p class="mt-6 text-default-600 text-base">" I encountered a few errors in the design of the
                                product detail page
                                in Angular. I contacted the support team and they established. "</p>
                            <h6 class="mt-4 mb-2 text-base text-default-900 font-semibold"><a
                                    href="#">muratoztrkk01</a>
                            </h6>
                            <div class="text-yellow-500 flex items-center justify-center gap-1">
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="p-5 text-center aos-init aos-animate" data-aos="fade-up" data-aos-easing="linear">
                            <div class="mx-auto rounded-full size-20 bg-danger/10">
                                <img alt="" class="rounded-full size-20" src="/images/user/avatar-7.png" />
                            </div>
                            <p class="mt-6 text-default-600 text-base">" This theme is very good. I really recommend it.
                                It's very good
                                optimized, elegant, well documented, etc. "</p>
                            <h6 class="mt-4 mb-2 text-base text-default-900 font-semibold"><a href="#">Christine
                                    Marbury</a></h6>
                            <div class="text-yellow-500 flex items-center justify-center gap-1">
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                                <i class="fill-yellow-500 size-3.5" data-lucide="star"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>
    <section class="relative md:py-20 py-12 border-t border-default-200">
        <div class="container">
            <div class="lg:flex justify-between items-center">
                <div>
                    <h1 class="mb-4 capitalize text-default-800 leading-normal md:text-4xl text-3xl font-semibold">Sign
                        up for update &amp;
                        newsletter</h1>
                    <p class="text-lg text-default-500">Tell us which describes you, and we'll get in touch with next
                        steps.</p>
                </div>
                <div class="flex p-1 lg:w-96 md:w-112 w-86 rounded-md bg-default-200 relative mb-6 lg:mt-0 mt-4">
                    <input class="px-3 text-sm border-0 ring-0 bg-transparent" placeholder="tailwick@themesdesign.in"
                        type="email" />
                    <button
                        class="absolute end-1 top-1.25 btn text-white bg-gradient-to-r from-primary to-purple-500 hover:from-purple-500 hover:to-primary border-0"
                        type="button">
                        Subscribe Now
                    </button>
                </div>
            </div>
        </div>
    </section>
    <footer class="relative md:pt-20 pt-12 md:pb-0 border-t border-default-200">
        <div class="absolute -top-16 start-0 size-64 bg-purple-500/10 blur-3xl"></div>
        <div class="container">
            <div class="grid grid-cols-12 md:gap-12 gap-6">
                <div class="lg:col-span-4 col-span-12">
                    <div class="mb-5">
                        <a href="#">
                            <img alt="logo dark" class="h-7 block dark:hidden" src="/images/logo-dark.png" />
                            <img alt="" class="h-7 hidden dark:block" src="/images/logo-light.png" />
                        </a>
                    </div>
                    <p class="mb-5 text-sm text-default-500">
                        Premium Multipurpose Admin &amp; Dashboard Template You can build any type of web application
                        like eCommerce, CRM, CMS, Project management apps, Admin Panels, etc using Tailwick.
                    </p>
                    <div class="flex flex-wrap gap-3 md:mt-0 mt-5">
                        <button
                            class="size-10 border btn border-default-200 bg-transparent rounded-full text-default-500 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="facebook"></i>
                        </button>
                        <button
                            class="size-10 border btn border-default-200 bg-transparent rounded-full text-default-500 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="linkedin"></i>
                        </button>
                        <button
                            class="size-10 border btn border-default-200 bg-transparent rounded-full text-default-500 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="instagram"></i>
                        </button>
                        <button
                            class="size-10 border btn border-default-200 bg-transparent rounded-full text-default-500 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="twitter"></i>
                        </button>
                        <button
                            class="size-10 border btn border-default-200 bg-transparent rounded-full text-default-500 hover:text-primary"
                            type="button">
                            <i class="size-4" data-lucide="youtube"></i>
                        </button>
                    </div>
                </div>
                <div class="lg:col-span-3 md:col-span-4 col-span-12">
                    <h5 class="mb-4 font-medium text-lg text-default-700">Dashboards</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear text-default-600 hover:text-default-900 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Analytics</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">CRM</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Ecommerce</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Email</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">HR</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Social Media</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-3 md:col-span-4 col-span-12">
                    <h5 class="mb-4 font-medium text-lg text-default-700">About Us</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">News</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Service</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Our Policy</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Support 24/7</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">FAQ's</a>
                        </li>
                    </ul>
                </div>
                <div class="lg:col-span-2 md:col-span-4 col-span-12">
                    <h5 class="mb-4 font-medium text-lg text-default-700">Get Help</h5>
                    <ul class="flex flex-col gap-y-3 text-sm">
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">About Us</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Contact Us</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Payment Policy</a>
                        </li>
                        <li>
                            <a class="relative inline-block transition-all duration-200 ease-linear hover:text-default-900 text-default-600 before:absolute before:border-b before:border-default-200 before:inset-x-0 before:bottom-0 before:w-0 hover:before:w-full before:transition-all before:duration-300 before:ease-linear"
                                href="#">Return Policy</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="lg:py-10 py-6 mt-12 text-center text-default-500 text-base border-t border-default-200">
            <p>2025 © Tailwick. Design &amp; Develop by <a
                    class="underline text-default-800 font-bold transition-all hover:text-primary"
                    href="https://themesdesign.in/" target="_blank">Themesdesign</a></p>
        </div>
    </footer>
@endsection

@section('scripts')
    @vite(['resources/js/pages/landing.js'])
@endsection
