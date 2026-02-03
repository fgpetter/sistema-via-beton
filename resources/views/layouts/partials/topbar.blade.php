<!-- Topbar Start -->
<div
    class="app-header min-h-topbar-height flex items-center sticky top-0 z-30 bg-(--topbar-background) border-b border-default-200">
    <div class="w-full flex items-center justify-between px-6">
        <div class="flex items-center gap-5">
            <!-- Sidenav Menu Toggle Button -->
            <button class="btn btn-icon size-8 hover:bg-default-150 rounded" id="button-toggle-menu">
                <i class="iconify lucide--align-left text-xl"></i>
            </button>
        </div>
        <div class="flex items-center gap-3">
            <!-- Light/Dark Mode Button -->
            <div class="topbar-item">
                <button class="btn btn-icon size-8 hover:bg-default-150 transition-[scale,background] rounded-full"
                        id="light-dark-mode" type="button">
                    <i class="iconify tabler--moon text-xl absolute dark:scale-0 dark:-rotate-90 scale-100 rotate-0 transition-all duration-200"></i>
                    <i class="iconify tabler--sun text-xl absolute dark:scale-100 dark:rotate-0 scale-0 rotate-90 transition-all duration-200"></i>
                </button>
            </div>

            <!-- Profile Dropdown Button -->
            <div class="topbar-item hs-dropdown relative inline-flex">
                <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                        class="cursor-pointer  rounded-full">
                    <span class="hs-dropdown-toggle rounded-full size-9.5 bg-zinc-900 text-white flex items-center justify-center font-semibold text-base uppercase">
                        {{ Auth::user()->initials }}
                    </span>
                </button>
                <div aria-labelledby="hs-dropdown-with-icons" aria-orientation="vertical"
                     class="hs-dropdown-menu min-w-48" role="menu">
                    <div class="p-2">
                        <a class="flex gap-3" href="{{ route('profile.edit') }}">
                            <div>
                                <h6 class="mb-1 text-sm font-semibold text-default-800">{{ auth()->user()->name }}</h6>
                                <p class="text-default-500">{{ auth()->user()->role->label() }}</p>
                            </div>
                        </a>
                    </div>
                    <div class="border-t border-t-default-200 -mx-2 my-2"></div>
                    <div class="flex flex-col gap-y-1">
                        <form method="POST" action="{{ route('logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="flex items-center gap-x-3.5 py-1.5 font-medium px-3 text-default-600 hover:bg-default-150 rounded w-full text-left">
                                <i class="size-4" data-lucide="log-out"></i>
                                Sair
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->
