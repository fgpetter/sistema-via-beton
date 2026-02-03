<!-- Topbar Start -->
<div
    class="app-header min-h-topbar-height flex items-center sticky top-0 z-30 bg-(--topbar-background) border-b border-default-200">
    <div class="w-full flex items-center justify-between px-6">
        <div class="flex items-center gap-5">
            <!-- Sidenav Menu Toggle Button -->
            <button class="btn btn-icon size-8 hover:bg-default-150 rounded" id="button-toggle-menu">
                <i class="iconify lucide--align-left text-xl"></i>
            </button>
            <!-- Topbar Search -->
            <div class="lg:flex hidden items-center relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <i class="iconify tabler--search text-base"></i>
                </div>
                <input class="form-input px-12 text-sm rounded border-transparent focus:border-transparent w-60"
                       id="topbar-search" placeholder="Search something..." type="search"/>
                <button class="absolute inset-y-0 end-0 flex items-center pe-4" type="button">
                    <span class="ms-auto font-medium">⌘ K</span>
                </button>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <!-- Language Dropdown Button -->
            <div class="topbar-item hs-dropdown [--placement:bottom-right] relative inline-flex">
                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn btn-icon size-8 hover:bg-default-150 rounded-full relative"
                        type="button">
                    <img alt="" class="size-4.5 rounded" src="/images/flags/us.jpg"/>
                </button>
                <div aria-labelledby="dropdown-menu" aria-orientation="vertical" class="hs-dropdown-menu" role="menu">
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/us.jpg"/>
                        English
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/spain.jpg"/>
                        Spanish
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/germany.jpg"/>
                        German
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/french.jpg"/>
                        French
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/japanese.svg"/>
                        Japanese
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/italy.jpg"/>
                        Italian
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/russia.jpg"/>
                        Russian
                    </a>
                    <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                       href="#">
                        <img alt="" class="size-4 rounded-full" src="/images/flags/arebian.svg"/>
                        Arabic
                    </a>
                </div>
            </div>
            <!-- Light/Dark Mode Button -->
            <div class="topbar-item">
                <button class="btn btn-icon size-8 hover:bg-default-150 transition-[scale,background] rounded-full"
                        id="light-dark-mode" type="button">
                    <i class="iconify tabler--moon text-xl absolute dark:scale-0 dark:-rotate-90 scale-100 rotate-0 transition-all duration-200"></i>
                    <i class="iconify tabler--sun text-xl absolute dark:scale-100 dark:rotate-0 scale-0 rotate-90 transition-all duration-200"></i>
                </button>
            </div>
            <!-- Notification Button -->
            <div class="topbar-item hs-dropdown [--auto-close:inside] relative inline-flex">
                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="hs-dropdown-toggle btn btn-icon size-8 hover:bg-default-150 rounded-full relative"
                        type="button">
                    <i class="size-4.5" data-lucide="bell-ring"></i>
                    <span class="absolute end-0 top-0 size-1.5 bg-primary/90 rounded-full"></span>
                </button>
                <div class="hs-dropdown-menu max-w-100 p-0" role="menu">
                    <!-- Header -->
                    <div class="p-4 border-b border-default-200">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base text-default-800">Notifications</h3>
                            <span
                                class="size-5 font-semibold bg-orange-500 rounded text-white flex items-center justify-center text-xs">15</span>
                        </div>
                    </div>
                    <!-- Tabs -->
                    <nav aria-label="Tabs" aria-orientation="horizontal"
                         class="flex gap-x-1 bg-default-150 p-2 border-b border-default-200" role="tablist">
                        <button aria-controls="tabsViewall" aria-selected="true"
                                class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500 hover:text-blue-600 active"
                                data-hs-tab="#tabsViewall" role="tab" type="button">
                            View all
                        </button>
                        <button aria-controls="tabsMentions" aria-selected="false"
                                class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500 hover:text-blue-600"
                                data-hs-tab="#tabsMentions" role="tab" type="button">
                            Mentions
                        </button>
                        <button aria-controls="tabsFollowers" aria-selected="false"
                                class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500 hover:text-blue-600"
                                data-hs-tab="#tabsFollowers" role="tab" type="button">
                            Followers
                        </button>
                        <button aria-controls="tabsInvites" aria-selected="false"
                                class="hs-tab-active:bg-card hs-tab-active:text-primary py-0.5 px-4 rounded font-semibold inline-flex items-center gap-x-2 border-b-2 border-transparent text-xs whitespace-nowrap text-default-500 hover:text-blue-600"
                                data-hs-tab="#tabsInvites" role="tab" type="button">
                            Invites
                        </button>
                    </nav>
                    <!-- Tabs content -->
                    <div class="h-80" data-simplebar="">
                        <!-- View all -->
                        <div aria-labelledby="tabsViewall-item" id="tabsViewall" role="tabpanel">
                            <a class="flex gap-3 p-4 items-center hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-default-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-3.png"/>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full text-sm">
                                    <div>
                                        <h6 class="mb-2 font-medium text-default-800"><b>@willie_passem</b> followed you
                                        </h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Wednesday 03:42 PM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            4 sec
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="flex gap-3 p-4 items-start hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-yellow-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-5.png"/>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full">
                                    <div class="text-sm">
                                        <h6 class="mb-2 font-medium text-default-800"><b>@caroline_jessica</b> commented
                                            <br/>on your post</h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Wednesday 03:42 PM</span>
                                        </p>
                                        <p class="p-2 bg-default-50 text-default-500 mt-2 rounded">
                                            Amazing! Fast, to the point, professional and really amazing to work
                                            with them!!!
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div>
                                                <div class="size-1.5 bg-primary rounded-full"></div>
                                            </div>
                                            15 min
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="flex gap-3 p-4 items-start hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-red-100 flex justify-center items-center">
                                        <i class="size-5 text-danger" data-lucide="shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2 w-full">
                                    <div>
                                        <h6 class="mb-1 font-medium text-default-800 text-sm">Successfully purchased a
                                            business plan for
                                            <span class="text-danger">$199.99</span>
                                        </h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Monday 11:26 AM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            yesterday
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="flex gap-3 p-4 items-center hover:bg-default-150" href="#">
                                <div class="relative">
                                    <div class="size-10 rounded-md bg-pink-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-7.png"/>
                                    </div>
                                    <div class="absolute text-orange-500 bottom-0 -end-0.5 text-base">
                                        <i class="size-3.5 fill-orange-500" data-lucide="heart"></i>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full">
                                    <div>
                                        <h6 class="mb-1 font-medium text-default-800 text-sm"><b>@scott</b> liked your
                                            post</h6>
                                        <p class="flex gap-1 items-center text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i><span>Thursday 06:59 AM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            1 Week
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Mentions -->
                        <div aria-labelledby="tabsMentions-item" class="hidden" id="tabsMentions" role="tabpanel">
                            <a class="flex gap-3 p-4 items-start hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-yellow-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-5.png"/>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full">
                                    <div class="text-sm">
                                        <h6 class="mb-2 font-medium text-default-800"><b>@caroline_jessica</b> commented
                                            <br/>on your post</h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Wednesday 03:42 PM</span>
                                        </p>
                                        <p class="p-2 bg-default-50 text-default-500 mt-2 rounded">
                                            Amazing! Fast, to the point, professional and really amazing to work
                                            with them!!!
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div>
                                                <div class="size-1.5 bg-primary rounded-full"></div>
                                            </div>
                                            15 min
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a class="flex gap-3 p-4 items-center hover:bg-default-150" href="#">
                                <div class="relative">
                                    <div class="size-10 rounded-md bg-pink-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-7.png"/>
                                    </div>
                                    <div class="absolute text-orange-500 bottom-0 -end-0.5 text-base">
                                        <i class="size-3.5 fill-orange-500" data-lucide="heart"></i>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full">
                                    <div>
                                        <h6 class="mb-1 font-medium text-default-800 text-sm"><b>@scott</b> liked your
                                            post</h6>
                                        <p class="flex gap-1 items-center text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i><span>Thursday 06:59 AM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            1 Week
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Followers -->
                        <div aria-labelledby="tabsFollowers-item" class="hidden" id="tabsFollowers" role="tabpanel">
                            <a class="flex gap-3 p-4 items-center hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-default-100">
                                        <img alt="" class="rounded-md" src="/images/user/avatar-3.png"/>
                                    </div>
                                </div>
                                <div class="flex justify-between w-full text-sm">
                                    <div>
                                        <h6 class="mb-2 font-medium text-default-800"><b>@willie_passem</b> followed you
                                        </h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Wednesday 03:42 PM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            4 sec
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <!-- Invites -->
                        <div aria-labelledby="tabsInvites-item" class="hidden" id="tabsInvites" role="tabpanel">
                            <a class="flex gap-3 p-4 items-start hover:bg-default-150" href="#">
                                <div>
                                    <div class="size-10 rounded-md bg-red-100 flex justify-center items-center">
                                        <i class="size-5 text-danger" data-lucide="shopping-bag"></i>
                                    </div>
                                </div>
                                <div class="flex justify-between gap-2 w-full">
                                    <div>
                                        <h6 class="mb-1 font-medium text-default-800 text-sm">Successfully purchased a
                                            business plan for
                                            <span class="text-danger">$199.99</span>
                                        </h6>
                                        <p class="flex items-center gap-1 text-default-500 text-xs">
                                            <i class="align-middle size-3.5" data-lucide="clock"></i>
                                            <span>Monday 11:26 AM</span>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2 text-xs text-default-500">
                                            <div class="w-1.5 h-1.5 bg-primary rounded-full"></div>
                                            yesterday
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <!-- Footer -->
                    <div class="flex items-center justify-between p-4 border-t border-default-200">
                        <a class="text-sm font-medium text-default-900" href="#!">Manage Notification</a>
                        <button class="btn btn-sm text-white bg-primary" type="button">
                            View All
                            <i class="size-4" data-lucide="move-right"></i>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Setting Offcanvas Button -->
            <div class="topbar-item">
                <button aria-controls="theme-customization" aria-expanded="false" aria-haspopup="dialog"
                        class="btn btn-icon size-8 hover:bg-default-150 rounded-full"
                        data-hs-overlay="#theme-customization" type="button">
                    <i class="size-4.5" data-lucide="settings"></i>
                </button>
            </div>
            <!-- Profile Dropdown Button -->
            <div class="topbar-item hs-dropdown relative inline-flex">
                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="cursor-pointer bg-pink-100 rounded-full">
                    <img alt="user-image" class="hs-dropdown-toggle rounded-full size-9.5"
                         src="/images/user/avatar-1.png"/>
                </button>
                <div aria-labelledby="hs-dropdown-with-icons" aria-orientation="vertical"
                     class="hs-dropdown-menu min-w-48" role="menu">
                    <div class="p-2">
                        <h6 class="mb-2 text-default-500">Welcome to Tailwick</h6>
                        <a class="flex gap-3" href="#!">
                            <div class="relative inline-block">
                                <div class="rounded bg-default-200">
                                    <img alt="" class="size-12 rounded" src="/images/user/avatar-1.png"/>
                                </div>
                                <span
                                    class="-top-1 -end-1 absolute w-2.5 h-2.5 bg-green-400 border-2 border-white rounded-full"></span>
                            </div>
                            <div>
                                <h6 class="mb-1 text-sm font-semibold text-default-800">Paula Keenan</h6>
                                <p class="text-default-500">CEO &amp; Founder</p>
                            </div>
                        </a>
                    </div>
                    <div class="border-t border-t-default-200 -mx-2 my-2"></div>
                    <div class="flex flex-col gap-y-1">
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                           href="{{ route('second', ['apps', 'mailbox']) }}">
                            <i class="size-4" data-lucide="mail"></i>
                            Inbox
                            <span
                                class="size-4.5 font-semibold bg-danger rounded text-white flex items-center justify-center text-xs">15</span>
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                           href="{{ route('second', ['apps', 'chat']) }}">
                            <i class="size-4" data-lucide="messages-square"></i>
                            Chat
                        </a>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                           href="{{ route('second', ['pages', 'pricing']) }}">
                            <i class="size-4" data-lucide="gem"></i>
                            Upgrade Pro
                        </a>
                        <div class="border-t border-default-200 -mx-2 my-1"></div>
                        <a class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded"
                           href="{{ route('second', ['auth', 'basic-logout']) }}">
                            <i class="size-4" data-lucide="log-out"></i>
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
