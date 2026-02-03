<!-- Theme Settings Offcanvas -->
<div>
    <div class="hs-overlay hs-overlay-open:translate-x-0 hidden bg-card dark:bg-default-100 hs-overlay-open:flex flex-col translate-x-full rtl:-translate-x-full fixed inset-y-0 end-0 bottom-0 transition-all duration-300 transform max-w-sm w-full z-80 overflow-hidden"
        id="theme-customization">
        <div class="min-h-16 flex items-center text-default-600 border-b border-dashed border-default-900/10 px-6 gap-3">
            <h5 class="text-base grow">Theme Settings</h5>
            <button aria-label="Full Screen" class="btn size-9 rounded-full btn-sm hover:bg-default-150 group"
                data-toggle="fullscreen" id="fullscreenBtn">
                <i class="iconify lucide--fullscreen size-5 group-[.fullscreen-active]:hidden"></i>
                <i class="iconify lucide--minimize size-5 hidden group-[.fullscreen-active]:inline-block"></i>
            </button>
            <button class="btn size-9 rounded-full btn-sm hover:bg-default-150" data-hs-overlay="#theme-customization"
                type="button">
                <i class="iconify tabler--x text-xl"></i>
            </button>
        </div>
        <div class="h-full flex-grow overflow-y-auto" data-simplebar="">
            <div class="divide-y divide-dashed divide-default-200">
                <div class="p-6">
                    <h5 class="font-semibold text-sm mb-3">Sidenav View</h5>
                    <div class="grid grid-cols-3 gap-3">
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-default" name="data-sidenav-size" type="radio"
                                value="default" />
                            <label class="form-label" for="sidenav-view-default">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="block w-8 bg-default-100">
                                        <span class="mt-1.5 mx-1.5 block space-y-1">
                                            <span class="h-1 block rounded-sm mb-2.5 bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                        </span>
                                    </span>
                                    <span class="flex flex-col flex-auto border-s border-default-200">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center justify-end h-full mr-1.5">
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Default</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-hover" name="data-sidenav-size" type="radio"
                                value="hover" />
                            <label class="form-label" for="sidenav-view-hover">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="w-3 bg-default-100">
                                        <span class="w-1.5 h-1.5 mt-1 mx-auto rounded-sm bg-default-300"></span>
                                        <span class="flex flex-col items-center w-full mt-1.5 space-y-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                        </span>
                                    </span>
                                    <span class="flex flex-col flex-auto border-s border-default-200">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center justify-end h-full mr-1.5">
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Hover</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-hover-active" name="data-sidenav-size" type="radio"
                                value="hover-active" />
                            <label class="form-label" for="sidenav-view-hover-active">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="w-8 bg-default-100">
                                        <span class="mt-1.5 mx-1.5 block space-y-1">
                                            <span class="flex mb-2.5 gap-1">
                                                <span class="h-1 block w-full rounded-sm bg-default-300"></span>
                                                <span class="h-1 block w-2 rounded-full bg-default-300"></span>
                                            </span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                            <span class="h-1 block rounded-sm bg-default-300"></span>
                                        </span>
                                    </span>
                                    <span class="flex flex-col flex-auto border-s border-default-200">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center justify-end h-full mr-1.5">
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Hover Active</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-sm" name="data-sidenav-size" type="radio"
                                value="sm" />
                            <label class="form-label" for="sidenav-view-sm">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="w-3 bg-default-100">
                                        <span class="w-1.5 h-1.5 mt-1 mx-auto rounded-sm bg-default-300"></span>
                                        <span class="flex flex-col items-center w-full mt-1.5 space-y-1">
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-default-300"></span>
                                        </span>
                                    </span>
                                    <span class="flex flex-col flex-auto border-s border-default-200">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center h-full mr-1.5">
                                                <span class="grow">
                                                    <span
                                                        class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                </span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Small</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-md" name="data-sidenav-size" type="radio"
                                value="md" />
                            <label class="form-label" for="sidenav-view-md">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="w-4 bg-default-100">
                                        <span class="w-2 h-2 mt-2 mx-auto rounded-sm bg-default-300"></span>
                                        <span class="flex flex-col items-center w-full mt-2 space-y-1">
                                            <span class="w-2 h-2 rounded-sm bg-default-300"></span>
                                            <span class="w-2 h-2 rounded-sm bg-default-300"></span>
                                            <span class="w-2 h-2 rounded-sm bg-default-300"></span>
                                        </span>
                                    </span>
                                    <span class="flex flex-col flex-auto border-s border-default-200">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center h-full mr-1.5">
                                                <span class="grow">
                                                    <span
                                                        class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                </span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ml-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Compact</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-mobile" name="data-sidenav-size" type="radio"
                                value="offcanvas" />
                            <label class="form-label" for="sidenav-view-mobile">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="flex flex-col flex-auto">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex items-center h-full mr-1.5">
                                                <span class="w-1.5 h-1.5 ms-1 rounded-sm bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-auto rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Mobile</div>
                        </div>
                        <div class="card-radio">
                            <input class="hidden" id="sidenav-view-hidden" name="data-sidenav-size" type="radio"
                                value="hidden" />
                            <label class="form-label" for="sidenav-view-hidden">
                                <span class="flex h-16 overflow-hidden border border-default-200 rounded-md">
                                    <span class="flex flex-col flex-auto">
                                        <span class="h-3 bg-default-100">
                                            <span class="flex flex-auto items-center h-full me-1.5">
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-auto rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                                <span class="w-1 h-1 block ms-1 rounded-full bg-default-300"></span>
                                            </span>
                                        </span>
                                        <span class="flex flex-auto border-t border-default-200 bg-default-50"></span>
                                    </span>
                                </span>
                            </label>
                            <div class="mt-1 text-md font-medium text-center text-default-600"> Hidden</div>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h5 class="font-semibold text-sm mb-3">Theme Mode</h5>
                    <div class="flex gap-2">
                        <div>
                            <input class="hidden" id="layout-color-light" name="data-theme" type="radio"
                                value="light" />
                            <label class="form-label btn bg-default-150" for="layout-color-light">Light</label>
                        </div>
                        <div>
                            <input class="hidden" id="layout-color-dark" name="data-theme" type="radio"
                                value="dark" />
                            <label class="form-label btn bg-default-150" for="layout-color-dark">Dark</label>
                        </div>
                        <div>
                            <input class="hidden" id="layout-color-system" name="data-theme" type="radio"
                                value="system" />
                            <label class="form-label btn bg-default-150" for="layout-color-system">System</label>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h5 class="font-semibold text-sm mb-3">Direction</h5>
                    <div class="flex gap-2">
                        <div>
                            <input class="hidden" id="direction-ltr" name="dir" type="radio"
                                value="ltr" />
                            <label class="form-label btn bg-default-150" for="direction-ltr">LTR Mode</label>
                        </div>
                        <div>
                            <input class="hidden" id="direction-rtl" name="dir" type="radio"
                                value="rtl" />
                            <label class="form-label btn bg-default-150" for="direction-rtl">RTL Mode</label>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <h5 class="font-semibold text-sm mb-3">Sidenav Color</h5>
                    <div class="flex gap-2">
                        <div>
                            <input class="hidden" id="menu-color-light" name="data-sidenav-color" type="radio"
                                value="light" />
                            <label class="form-label btn bg-default-150" for="menu-color-light">Light</label>
                        </div>
                        <div>
                            <input class="hidden" id="menu-color-dark" name="data-sidenav-color" type="radio"
                                value="dark" />
                            <label class="form-label btn bg-default-150" for="menu-color-dark">Dark</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-4 flex border-t border-dashed border-default-900/10">
            <div class="flex w-full gap-4">
                <button class="btn bg-default-150 grow" id="reset-layout" type="button">Reset</button>
                <a class="btn bg-primary text-white grow" href="https://1.envato.market/tailwick-tailwind"
                    target="_blank">Buy Now</a>
            </div>
        </div>
    </div>
</div>
