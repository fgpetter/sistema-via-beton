/*
Template Name: Tailwik - TailwindCSS Admin & Dashboard Template
Author: Themesdesign
Version: 2.0.0
Website: https://themesdesign.in/
Contact: themesdesign.in@gmail.com
File: App.js
*/



// App js for Sidenav Page Active and Fullscreen
class App {

    initSidenav() {
        var self = this;
        var pageUrl = window.location.href.split(/[?#]/)[0];
        document.querySelectorAll("ul.side-nav .menu-item > a").forEach((element) => {
            if (element.href === pageUrl) {
                // Add active to the clicked link
                element.classList.add("active");
                // Add active to its parent .menu-item
                let parentLi = element.closest(".menu-item");
                if (parentLi) {
                    parentLi.classList.add("active");
                }
                let parentAccordion = element.closest(".hs-accordion");
                while (parentAccordion) {
                    parentAccordion.classList.add("active");
                    const toggle = parentAccordion.querySelector(":scope > .hs-accordion-toggle");
                    if (toggle) {
                        toggle.classList.add("active");
                        toggle.setAttribute('aria-expanded', 'true');
                    }
                    const submenu = parentAccordion.querySelector(":scope > .hs-accordion-content");
                    if (submenu) {
                        submenu.classList.remove("hidden");
                    }
                    parentAccordion = parentAccordion.parentElement?.closest(".hs-accordion");
                }
            }
        });

        setTimeout(function () {
            var activatedItem = document.querySelector("ul.side-nav .menu-item.active a.active");
            if (activatedItem != null) {
                var simplebarContent = document.querySelector("#app-menu .simplebar-content-wrapper",);
                var offset = activatedItem.offsetTop - 300;
                if (simplebarContent && offset > 100) {
                    scrollTo(simplebarContent, offset, 600);
                }
            }
        }, 200);

        // scrollTo (Sidenav Active Menu)
        function easeInOutQuad(t, b, c, d) {
            t /= d / 2;
            if (t < 1) return (c / 2) * t * t + b;
            t--;
            return (-c / 2) * (t * (t - 2) - 1) + b;
        }
        function scrollTo(element, to, duration) {
            var start = element.scrollTop,
                change = to - start,
                currentTime = 0,
                increment = 20;
            var animateScroll = function () {
                currentTime += increment;
                var val = easeInOutQuad(currentTime, start, change, duration);
                element.scrollTop = val;
                if (currentTime < duration) {
                    setTimeout(animateScroll, increment);
                }
            };
            animateScroll();
        }
    }

    reverseQuery(element, query) {
        while (element) {
            if (element.parentElement) {
                if (element.parentElement.querySelector(query) === element) return element
            }
            element = element.parentElement;
        }
        return null;
    }

    initFullSreen() {

        // helper functions
        function getFsElement() {
            return document.fullscreenElement || document.webkitFullscreenElement;
        }

        function enterFullscreen(el) {
            if (el.requestFullscreen) {
                return el.requestFullscreen();
            } else if (el.webkitRequestFullscreen) { // Safari
                return el.webkitRequestFullscreen();
            }
        }

        function exitFullscreen() {
            if (document.exitFullscreen) {
                return document.exitFullscreen();
            } else if (document.webkitExitFullscreen) { // Safari
                return document.webkitExitFullscreen();
            }
        }

        function toggleFullscreen(el) {
            if (getFsElement()) {
                exitFullscreen();
            } else {
                enterFullscreen(el);
            }
        }

        // attach click handler to any element with data-toggle="fullscreen"
        document.addEventListener("click", function (e) {
            const trigger = e.target.closest('[data-toggle="fullscreen"]');
            const btn = document.querySelector("[data-toggle='fullscreen']");

            if (trigger) {
                e.preventDefault();
                btn.classList.toggle("fullscreen-active");
                toggleFullscreen(document.documentElement);
            }
        });
    }

    init() {
        this.initSidenav();
        this.initFullSreen();
    }
}

// Layout Customizer
class LayoutCustomizer {
    constructor() {
        this.html = document.documentElement;
        this.config = {};
    }

    init() {
        this.initConfig();
        this.initSwitchListener();
        this.initWindowSize();
        this._adjustLayout();
        this.setSwitchFromConfig();
    }

    initConfig() {
        this.defaultConfig = JSON.parse(JSON.stringify(window.defaultConfig));
        this.config = JSON.parse(JSON.stringify(window.config));
        this.setSwitchFromConfig();
    }

    changeDir(dir) {
        this.config.dir = dir;
        this.html.setAttribute('dir', dir);
        this.setSwitchFromConfig();
    }

    changeMenuColor(color) {
        this.config.sidenav.color = color;
        this.html.setAttribute('data-sidenav-color', color);
        this.setSwitchFromConfig();
    }

    changeLeftbarSize(size, save = true) {
        this.html.setAttribute('data-sidenav-size', size);
        if (save) {
            this.config.sidenav.size = size;
            this.setSwitchFromConfig();
        }
    }

    changeTheme(color) {
        this.config.theme = color;
        this.html.setAttribute('data-theme', color);
        this.setSwitchFromConfig();
    }

    getSystemTheme() {
        return window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
    }

    changeTheme(color) {
        const nColor = color === 'system' ? this.getSystemTheme() : color;
        this.config.theme = color
        this.html.setAttribute("data-theme", color === 'system' ? this.getSystemTheme() : color);
        this.setSwitchFromConfig();
    }

    resetTheme() {
        this.config = JSON.parse(JSON.stringify(window.defaultConfig));
        this.changeDir(this.config.dir);
        this.changeMenuColor(this.config.sidenav.color);
        this.changeLeftbarSize(this.config.sidenav.size);
        this.changeTheme(this.config.theme);
        this._adjustLayout();
    }

    setSwitchFromConfig() {
        const config = this.config;

        sessionStorage.setItem('__TAILWICK_CONFIG__', JSON.stringify(config));

        document.querySelectorAll('#theme-customization input[type=radio]').forEach(cb => cb.checked = false);

        const select = (name, val) => document.querySelector(`input[name="${name}"][value="${val}"]`);
        const toggle = (sel, state) => { const el = document.querySelector(sel); if (el) el.checked = state; };

        [['dir', config.dir],
        ['data-theme', config.theme],
        ['data-sidenav-color', config.sidenav.color],
        ['data-sidenav-size', config.sidenav.size]
        ].forEach(([name, val]) => { const el = select(name, val); if (el) el.checked = true; });
    }

    initSwitchListener() {
        const bindChange = (selector, handler) => {
            document.querySelectorAll(selector).forEach(input =>
                input.addEventListener('change', () => handler(input))
            );
        };

        bindChange('input[name="dir"]', input => this.changeDir(input.value));
        bindChange('input[name="data-theme"]', input => this.changeTheme(input.value));
        bindChange('input[name="data-sidenav-color"]', input => this.changeMenuColor(input.value));
        bindChange('input[name="data-sidenav-size"]', input => this.changeLeftbarSize(input.value));

        const themeToggle = document.getElementById('light-dark-mode');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const newTheme = this.config.theme === 'light' ? 'dark' : 'light';
                this.changeTheme(newTheme);
            });
        }

        const resetBtn = document.querySelector('#reset-layout');
        if (resetBtn) {
            resetBtn.addEventListener('click', () => this.resetTheme());
        }

        const toggleBtn = document.querySelector('#button-toggle-menu');
        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => this._toggleSidebar());
        }

        document.querySelectorAll('#button-hover-toggle').forEach(el => {
            el.addEventListener('click', () => {
                const current = this.html.getAttribute('data-sidenav-size');
                this.changeLeftbarSize(current === 'hover-active' ? 'hover' : 'hover-active', true);
            });
        });
    }

    _toggleSidebar() {
        const current = this.html.getAttribute('data-sidenav-size');
        const isOffcanvas = current === 'offcanvas';
        const configSize = this.config.sidenav.size;

        if (isOffcanvas) {
            this.showBackdrop();
        } else if (configSize === 'md') {
            this.changeLeftbarSize(current === 'sm' ? 'md' : 'sm', false);
        } else if (configSize === 'hidden') {
            this.changeLeftbarSize(current === 'default' ? 'hidden' : 'default', false);
        } else {
            this.changeLeftbarSize(current === 'sm' ? 'default' : 'sm', true);
        }

        this.html.classList.toggle('sidenav-enable');
    }

    showBackdrop() {
        const backdrop = document.createElement('div');
        backdrop.id = 'custom-backdrop';
        backdrop.className = 'transition duration fixed inset-0 bg-default-900/50 z-40';
        document.body.appendChild(backdrop);
        backdrop.addEventListener('click', () => {
            this.html.classList.remove('sidenav-enable');
            this.hideBackdrop();
        });
    }

    hideBackdrop() {
        const backdrop = document.getElementById('custom-backdrop');
        if (backdrop) {
            document.body.removeChild(backdrop);
        }
    }

    _adjustLayout() {
        const width = window.innerWidth;
        const size = this.config.sidenav.size;

        if (width <= 1140) {
            this.changeLeftbarSize('offcanvas', false);
        } else {
            this.changeLeftbarSize(size);
        }
    }

    initWindowSize() {
        window.addEventListener('resize', () => this._adjustLayout());
    }
}

document.addEventListener('DOMContentLoaded', function (e) {
    new App().init();
    new LayoutCustomizer().init();
});