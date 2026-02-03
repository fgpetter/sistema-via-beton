@yield('css')

<script>
    (function() {
        const html = document.documentElement;
        const storageKey = "__TAILWICK_CONFIG__";
        const savedConfig = sessionStorage.getItem(storageKey);

        // Default config
        const defaultConfig = {
            dir: "ltr",
            theme: "light",
            sidenav: {
                color: "light",
                size: "default",
            },
        };

        // Build config from HTML attributes
        function getSystemTheme() {
            return window.matchMedia('(prefers-color-scheme: dark)').matches ? "dark" : "light";
        }

        // Build config from HTML attributes
        const htmlConfig = {
            dir: html.getAttribute("dir") || defaultConfig.dir,

            theme: html.getAttribute("data-theme") === 'system' ?
                getSystemTheme() :
                html.getAttribute("data-theme") || (defaultConfig.theme === 'system' ? getSystemTheme() :
                    defaultConfig.theme),
            sidenav: {
                color: html.getAttribute("data-sidenav-color") || defaultConfig.sidenav.color,
                size: html.getAttribute("data-sidenav-size") || defaultConfig.sidenav.size,
            },
        };

        // Save merged config as defaults globally
        window.defaultConfig = structuredClone(htmlConfig);

        // Load from session if exists
        let config = savedConfig ? JSON.parse(savedConfig) : htmlConfig;
        window.config = config;

        // Apply layout attributes immediately
        html.setAttribute("dir", config.dir);
        html.setAttribute("data-theme", config.theme);
        html.setAttribute("data-sidenav-color", config.sidenav.color);

        if (config.sidenav.size) {
            let size = config.sidenav.size;

            if (window.innerWidth <= 1140) {
                size = "offcanvas";
            }

            html.setAttribute("data-sidenav-size", size);
        }
    })();
</script>

@vite(['resources/js/vendor.js'])
@vite(['resources/js/app.js'])

@yield('scripts')