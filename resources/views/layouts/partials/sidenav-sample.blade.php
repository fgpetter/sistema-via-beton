<!-- Start Sidebar -->
<aside class="app-menu" id="app-menu">
    <!-- Sidenav Menu Brand Logo -->
    <a class="logo-box sticky top-0 flex min-h-topbar-height items-center justify-start px-6 backdrop-blur-xs"
        href="{{ route('second', ['dashboards', 'index']) }}">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img alt="Light logo" class="logo-lg h-6" src="/images/logo-light.png" />
            <img alt="Small logo" class="logo-sm h-6" src="/images/logo-sm.png" />
        </div>
        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img alt="Dark logo" class="logo-lg h-6" src="/images/logo-dark.png" />
            <img alt="Small logo" class="logo-sm h-6" src="/images/logo-sm.png" />
        </div>
    </a>
    <!-- Sidenav Menu Toggle Button -->
    <div class="absolute top-0 end-5 flex h-topbar items-center justify">
        <button class="" id="button-hover-toggle">
            <i class="iconify tabler--circle size-5"></i>
        </button>
    </div>
    <!-- Sidenav Menu Item Link -->
    <div class="relative min-h-0 flex-grow">
        <div class="size-full" data-simplebar="">
            <ul class="side-nav p-3 hs-accordion-group">
                <li class="menu-title">
                    <span>Overview</span>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="monitor-dot"></i></span>
                        <span class="menu-text"> Dashboards </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['dashboards', 'analytics']) }}">
                                <span class="menu-text"> Analytics </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['dashboards', 'index']) }}">
                                <span class="menu-text"> Ecommerce </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['dashboards', 'email']) }}">
                                <span class="menu-text"> Email </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['dashboards', 'hr']) }}">
                                <span class="menu-text"> HR </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="picture-in-picture-2"></i> </span>
                        <span class="menu-text"> Landing Page </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            
                            <a class="menu-link" href="{{ route('second', ['landing', 'onepage']) }}" target="_blank">
                                <span class="menu-text"> One Page </span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['landing', 'product']) }}" target="_blank">
                                <span class="menu-text"> Product </span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Apps</span>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('second', ['apps', 'chat']) }}">
                        <span class="menu-icon"><i data-lucide="messages-square"></i></span>
                        <div class="menu-text">Chat</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('second', ['apps', 'calendar']) }}">
                        <span class="menu-icon"><i data-lucide="calendar-1"></i></span>
                        <div class="menu-text">Calendar</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('second', ['apps', 'mailbox']) }}">
                        <span class="menu-icon"><i data-lucide="mail"></i></span>
                        <div class="menu-text">Email</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('second', ['apps', 'notes']) }}">
                        <span class="menu-icon"><i data-lucide="clipboard-list"></i></span>
                        <div class="menu-text">Notes</div>
                    </a>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="shopping-bag"></i></span>
                        <span class="menu-text"> Ecommerce </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'product-list'])}}">
                                <span class="menu-text">Products</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'product-grid'])}}">
                                <span class="menu-text">Products Grid</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'product-overview'])}}">
                                <span class="menu-text">Product Details</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'cart'])}}">
                                <span class="menu-text">Shopping Cart</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'checkout'])}}">
                                <span class="menu-text">Checkout</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'product-create'])}}">
                                <span class="menu-text">Add Products</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce', 'orders'])}}">
                                <span class="menu-text">Orders</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce','order-overview'])}}">
                                <span class="menu-text">Order Details</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['ecommerce','sellers'])}}">
                                <span class="menu-text">Sellers</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="circuit-board"></i></span>
                        <span class="menu-text"> HR Management </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hs-accordion-group hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['hr', 'employee'])}}">
                                <span class="menu-text">Employee List</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['hr', 'holidays'])}}">
                                <span class="menu-text">Holidays</span>
                            </a>
                        </li>
                        <li class="menu-item hs-accordion">
                            <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                                <span class="menu-text"> Leave Manage </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="sub-menu hs-accordion-content hidden">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'leave-employee'])}}">
                                        <span class="menu-text">By Employee</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'create-leave-employee'])}}">
                                        <span class="menu-text">Add Leave(Employee)</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'leave'])}}">
                                        <span class="menu-text">By HR</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'create-leave'])}}">
                                        <span class="menu-text">Add Leave(HR)</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item hs-accordion">
                            <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                                <span class="menu-text"> Attendance </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="sub-menu hs-accordion-content hidden">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'attendance'])}}">
                                        <span class="menu-text">Attendance(HR)</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'attendance-main'])}}">
                                        <span class="menu-text">Main Attendance</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['hr', 'department'])}}">
                                <span class="menu-text">Department</span>
                            </a>
                        </li>
                        <li class="menu-item hs-accordion">
                            <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                                <span class="menu-text"> Sales </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="sub-menu hs-accordion-content hidden">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'sales-estimates'])}}">
                                        <span class="menu-text">Estimates</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'sales-payments'])}}">
                                        <span class="menu-text">Payments</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'sales-expenses'])}}">
                                        <span class="menu-text">Expenses</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item hs-accordion">
                            <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                                <span class="menu-text"> Payroll </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <ul class="sub-menu hs-accordion-content hidden">
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'payroll-employee-salary'])}}">
                                        <span class="menu-text">Employee Salary</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'payroll-payslip'])}}">
                                        <span class="menu-text">Payslip</span>
                                    </a>
                                </li>
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('second', ['hr', 'payroll-create-payslip'])}}">
                                        <span class="menu-text">Create Payslip</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="file-text"></i></span>
                        <span class="menu-text"> Invoice </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['apps', 'invoice-overview']) }}">
                                <span class="menu-text">Overview</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['apps', 'invoice-list']) }}">
                                <span class="menu-text">List Invoice</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['apps', 'invoice-add-new']) }}">
                                <span class="menu-text">Add Invoice</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="square-user-round"></i></span>
                        <span class="menu-text"> Users </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['apps', 'users-list']) }}">
                                <span class="menu-text">List View</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['apps', 'users-grid']) }}">
                                <span class="menu-text">Grid View</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Extra</span>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="codesandbox"></i></span>
                        <span class="menu-text"> Pages </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'starter']) }}">
                                <span class="menu-text">Starter Page</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'pricing']) }}">
                                <span class="menu-text">Pricing</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'faqs']) }}">
                                <span class="menu-text">FAQ</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'maintenance']) }}">
                                <span class="menu-text">Maintenance</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'timeline']) }}">
                                <span class="menu-text">Timeline</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'coming-soon']) }}">
                                <span class="menu-text">Coming Soon</span>
                            </a>
                        </li>                        
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'maintenance']) }}">
                                <span class="menu-text">Maintenance</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', '404']) }}">
                                <span class="menu-text">404</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['pages', 'offline']) }}">
                                <span class="menu-text">Offline</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="lock"></i></span>
                        <span class="menu-text"> Basic Auth </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-login']) }}">
                                <span class="menu-text">Login</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-register']) }}">
                                <span class="menu-text">Register</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-verify-email']) }}">
                                <span class="menu-text">Verify Email</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-two-steps']) }}">
                                <span class="menu-text">Two Steps</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-logout']) }}">
                                <span class="menu-text">Logout</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-reset-password']) }}">
                                <span class="menu-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'basic-create-password']) }}">
                                <span class="menu-text">Create Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="shield-check"></i></span>
                        <span class="menu-text"> Cover Auth </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-login']) }}">
                                <span class="menu-text">Login</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-register']) }}">
                                <span class="menu-text">Register</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-verify-email']) }}">
                                <span class="menu-text">Verify Email</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-two-steps']) }}">
                                <span class="menu-text">Two Steps</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-logout']) }}">
                                <span class="menu-text">Logout</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-reset-password']) }}">
                                <span class="menu-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'cover-create-password']) }}">
                                <span class="menu-text">Create Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="package"></i></span>
                        <span class="menu-text"> Boxed Auth </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-login']) }}">
                                <span class="menu-text">Login</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-register']) }}">
                                <span class="menu-text">Register</span>
                            </a>
                        </li>                        
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-two-steps']) }}">
                                <span class="menu-text">Two Steps</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-logout']) }}">
                                <span class="menu-text">Logout</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-reset-password']) }}">
                                <span class="menu-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'boxed-create-password']) }}">
                                <span class="menu-text">Create Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="fingerprint"></i></span>
                        <span class="menu-text"> Modern Auth </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-login']) }}">
                                <span class="menu-text">Login</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-register']) }}">
                                <span class="menu-text">Register</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-verify-email']) }}">
                                <span class="menu-text">Verify Email</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-two-steps']) }}">
                                <span class="menu-text">Two Steps</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-logout']) }}">
                                <span class="menu-text">Logout</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-reset-password']) }}">
                                <span class="menu-text">Reset Password</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['auth', 'modern-create-password']) }}">
                                <span class="menu-text">Create Password</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="layout-panel-left"></i></span>
                        <span class="menu-text"> Layouts </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-hover']) }}"
                                target="_blank">Hover Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-hover-active']) }}"
                                target="_blank">Hover Active Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-small']) }}"
                                target="_blank">Small Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-compact']) }}"
                                target="_blank">Compact Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-offcanvas']) }}"
                                target="_blank">Offcanvas Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-hidden']) }}"
                                target="_blank">Hidden Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'sidenav-dark']) }}"
                                target="_blank">Dark Sidenav</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'dark-mode']) }}"
                                target="_blank">Dark
                                Mode</a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="{{ route('second', ['layouts-eg', 'rtl-mode']) }}"
                                target="_blank">RTL
                                Mode</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item hs-accordion">
                    <a class="hs-accordion-toggle menu-link" href="javascript:void(0)">
                        <span class="menu-icon"><i data-lucide="share-2"></i></span>
                        <span class="menu-text"> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul class="sub-menu hs-accordion-content hidden">
                        <li class="menu-item">
                            <a class="menu-link" href="javascript: void(0)">
                                <span class="menu-text">Item 1</span>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a class="menu-link" href="javascript: void(0)">
                                <span class="menu-text">Item 2</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</aside>
<!-- End Sidebar -->
