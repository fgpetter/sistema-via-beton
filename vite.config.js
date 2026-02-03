import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';
import { viteStaticCopy } from 'vite-plugin-static-copy';

export default defineConfig({
    plugins: [
        laravel({
            input: [
            'resources/js/app.js',
            'resources/js/components/dropzone.js',
            'resources/js/components/input-spin.js',
            'resources/js/components/timepicker.js',
            'resources/js/pages/apps-calendar.js',
            'resources/js/pages/apps-ecommerce-orders.js',
            'resources/js/pages/apps-mailbox.js',
            'resources/js/pages/dashboard-analytics.js',
            'resources/js/pages/dashboard-ecommerce.js',
            'resources/js/pages/dashboard-email.js',
            'resources/js/pages/dashboard-hr.js',
            'resources/js/pages/landing.js',
            'resources/js/pages/pages-coming-soon.js',
            'resources/js/vendor.js'
        ],
            refresh: true,
        }),
        tailwindcss(),
        viteStaticCopy({
            targets: [
                { src: 'resources/images/**/*', dest: 'images' }
            ]
        }),
    ],
});
