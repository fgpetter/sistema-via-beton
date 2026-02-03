@extends('layouts.vertical', ['title' => 'FAQs'])

@section('css')

@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Pages', 'title' => 'FAQs'] )

    <div class="card relative overflow-hidden mb-6">
        <div class="card-body">
            <div class="grid lg:grid-cols-3 gap-5">
                <div class="lg:col-span-2">
                    <div class="md:w-2xl">
                        <h4 class="mb-3 text-xl font-semibold text-default-800">Explore support options for our
                            products, fundamental knowledge, and beyond</h4>
                        <p class="mb-5 text-default-500 text-sm">Open the door to a wealth of resources and expert
                            guidance, allowing you to gain a deeper understanding of our products and access a treasure
                            trove of additional knowledge.</p>
                        <div class="relative">
                            <input class="form-input form-input-lg" placeholder="Ask a question" type="email"/>
                            <div
                                class="absolute inset-y-0 end-4 flex items-center pointer-events-none ps-4 peer-disabled:opacity-50 peer-disabled:pointer-events-none">
                                <i class="size-4 flex items-center text-default-500" data-lucide="search"></i>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2.5 mt-3">
                        <span class="py-0.5 px-2.5 bg-default-200 text-default-600 text-xs font-semibold rounded">Install Vite</span>
                        <span
                            class="py-0.5 px-2.5 bg-default-200 text-default-600 text-xs font-semibold rounded">React</span>
                        <span class="py-0.5 px-2.5 bg-default-200 text-default-600 text-xs font-semibold rounded">Angular</span>
                        <span
                            class="py-0.5 px-2.5 bg-default-200 text-default-600 text-xs font-semibold rounded">Vue</span>
                    </div>
                </div>
                <div class="lg:col-span-1 lg:block hidden">
                    <img alt="" class="absolute end-8 -top-28 -rotate-45 h-125" src="/images/faq.png"/>
                </div>
            </div>
        </div>
    </div>
    <h5 class="mb-5 underline text-lg font-semibold text-default-800">Popular Ask Questions</h5>
    <div class="grid lg:grid-cols-2 gap-5 mb-6">
        <div class="hs-collapse-group space-y-3">
            <div>
                <button aria-controls="hs-basic-collapse-heading" aria-expanded="false"
                        class="hs-collapse-toggle card px-4 mb-2 py-3 flex flex-row justify-between items-center w-full"
                        data-hs-collapse="#hs-basic-collapse-heading" id="hs-basic-collapse" type="button">
                    How to install Tailwind CSS in a project?
                    <i class="hs-collapse-open:hidden size-4" data-lucide="chevron-down"></i>
                    <i class="hs-collapse-open:block hidden size-4" data-lucide="chevron-up"></i>
                </button>
                <div aria-labelledby="hs-basic-collapse"
                     class="hs-collapse hidden w-full card overflow-hidden transition-[height] duration-300 shadow-md rounded-md"
                     id="hs-basic-collapse-heading">
                    <div class="card-body">
                        <p class="mb-3 text-sm">To install Tailwind CSS, you can use npm or yarn by running the
                            following commands:</p>
                        <ol class="flex flex-col gap-2 list-decimal list-inside">
                            <li class="text-sm text-default-700">
                                <b>Using npm</b>
                                <div class="mt-2">
                                    <code>npm install tailwindcss</code>
                                </div>
                            </li>
                            <div class="text-center">OR</div>
                            <li class="text-sm text-default-700">
                                <b>Using yarn</b>
                                <div class="mt-2">
                                    <code>yarn add tailwindcss</code>
                                </div>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div>
                <button aria-controls="hs-basic-collapse-heading1" aria-expanded="false"
                        class="hs-collapse-toggle card px-4 mb-2 py-3 flex flex-row justify-between items-center w-full"
                        data-hs-collapse="#hs-basic-collapse-heading1" id="hs-basic-collapse" type="button">
                    How to enable dark mode in Tailwind CSS?
                    <i class="hs-collapse-open:hidden size-4" data-lucide="chevron-down"></i>
                    <i class="hs-collapse-open:block hidden size-4" data-lucide="chevron-up"></i>
                </button>
                <div aria-labelledby="hs-basic-collapse"
                     class="hs-collapse hidden w-full card overflow-hidden transition-[height] duration-300 shadow-md rounded-md"
                     id="hs-basic-collapse-heading1">
                    <div class="card-body">
                        <p class="mb-3 text-sm">To enable dark mode in Tailwind CSS, update your <code>tailwind.config.js</code>
                            file with the <code>darkMode</code> option. You can choose between two different dark mode
                            strategies: <code>media</code> or <code>class</code></p>
                        <p class="mb-3 text-sm">Using <code>class</code>, the dark mode is enabled by adding a
                            <code>.dark</code> class to an ancestor element of your components:
                        </p>
                        <code>
                            <p>module.exports = {</p>
                            <p class="ps-4.5">darkMode: 'class', // or 'media'</p>
                            <p class="ps-4.5">// ...</p>
                            <p class="ps-4.5">}</p>
                        </code>
                    </div>
                </div>
            </div>
            <div>
                <button aria-controls="hs-basic-collapse-heading2" aria-expanded="false"
                        class="hs-collapse-toggle card px-4 mb-2 py-3 flex flex-row justify-between items-center w-full"
                        data-hs-collapse="#hs-basic-collapse-heading2" id="hs-basic-collapse" type="button">
                    How to use plugins in Tailwind CSS?
                    <i class="hs-collapse-open:hidden size-4" data-lucide="chevron-down"></i>
                    <i class="hs-collapse-open:block hidden size-4" data-lucide="chevron-up"></i>
                </button>
                <div aria-labelledby="hs-basic-collapse"
                     class="hs-collapse hidden w-full card overflow-hidden transition-[height] duration-300 shadow-md rounded-md"
                     id="hs-basic-collapse-heading2">
                    <div class="card-body">
                        <p class="mb-3 text-sm">To get started with your first plugin, import Tailwind’s
                            <code>plugin</code>
                            function from <code>tailwindcss/plugin</code>. Then inside your <code>plugins</code> array,
                            call the
                            imported <code>plugin</code> function with an anonymous function as the first argument.</p>
                        <code class="text-sm">
                            <p class="mb-4">const plugin = require('tailwindcss/plugin')</p>
                            <p>module.exports = {</p>
                            <p class="ps-4.5">plugins: [</p>
                            <p class="ps-10">plugin(function({ addUtilities, addComponents, e, config }) {</p>
                            <p class="ps-10">// Add your custom styles here</p>
                            <p class="ps-10">}),</p>
                            <p class="ps-4.5">]</p>
                            <p>}</p>
                        </code>
                    </div>
                </div>
            </div>
        </div>
        <div class="hs-collapse-group space-y-3">
            <div>
                <button aria-controls="hs-basic-collapse-heading3" aria-expanded="false"
                        class="hs-collapse-toggle card px-4 mb-2 py-3 flex flex-row justify-between items-center w-full"
                        data-hs-collapse="#hs-basic-collapse-heading3" id="hs-basic-collapse" type="button">
                    How to customize the configuration file in Tailwind CSS?
                    <i class="hs-collapse-open:hidden size-4" data-lucide="chevron-down"></i>
                    <i class="hs-collapse-open:block hidden size-4" data-lucide="chevron-up"></i>
                </button>
                <div aria-labelledby="hs-basic-collapse"
                     class="hs-collapse hidden w-full card overflow-hidden transition-[height] duration-300 shadow-md rounded-md"
                     id="hs-basic-collapse-heading3">
                    <div class="card-body">
                        <p class="mb-3 text-sm">You can customize the <code>tailwind.config.js</code> file to override
                            the
                            default configuration options provided by Tailwind CSS. The configuration file follows the
                            following
                            structure:</p>
                        <code class="text-sm">
                            <p>module.exports = {</p>
                            <p class="ps-4.5">purge: [],</p>
                            <p class="ps-4.5">theme: {</p>
                            <p class="ps-8">extend: {</p>
                            <p class="ps-12">...</p>
                            <p class="ps-8">},</p>
                            <p class="ps-4.5">},</p>
                            <p class="ps-4.5">variants: {},</p>
                            <p class="ps-4.5">plugins: [],</p>
                            <p>}</p>
                        </code>
                    </div>
                </div>
            </div>
            <div>
                <button aria-controls="hs-basic-collapse-heading4" aria-expanded="false"
                        class="hs-collapse-toggle card px-4 mb-2 py-3 flex flex-row justify-between items-center w-full"
                        data-hs-collapse="#hs-basic-collapse-heading4" id="hs-basic-collapse" type="button">
                    How to use responsive variants in Tailwind CSS?
                    <i class="hs-collapse-open:hidden size-4" data-lucide="chevron-down"></i>
                    <i class="hs-collapse-open:block hidden size-4" data-lucide="chevron-up"></i>
                </button>
                <div aria-labelledby="hs-basic-collapse"
                     class="hs-collapse hidden w-full card overflow-hidden transition-[height] duration-300 shadow-md rounded-md"
                     id="hs-basic-collapse-heading4">
                    <div class="card-body">
                        <p class="mb-3 text-sm">Tailwind CSS generates responsive variants for most utilities, allowing
                            you to
                            create responsive designs easily. By default, it includes four breakpoints:</p>
                        <ul class="flex flex-col gap-2 list-disc list-inside mb-2 text-sm">
                            <li><code>sm:</code>640px</li>
                            <li><code>md:</code>768px</li>
                            <li><code>lg:</code>1024px</li>
                            <li><code>xl:</code>1280px</li>
                        </ul>
                        <code class="text-sm mt-2">
                            <p>Your content here</p>
                        </code>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h5 class="mb-5 underline text-lg font-semibold text-default-800">Products Video Tutorial</h5>
    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5">
        <div class="card">
            <div class="card-body">
                <a href="https://www.youtube.com/embed/qYgogv4R8zg?si=_YxUDmc2fDgHyPae" target="_blank">
                    <h6 class="mb-6 text-base text-default-700 font-semibold">Setting Up Tailwind CSS</h6>
                </a>
                <div class="flex justify-center">
                    <iframe class="md:w-full rounded-md md:aspect-video" frameborder="0"
                            src="https://www.youtube.com/embed/qYgogv4R8zg?si=_YxUDmc2fDgHyPae"></iframe>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="https://www.youtube.com/embed/TrftauE2Vyk?si=HRCFmq5956C01yB3" target="_blank">
                    <h6 class="mb-6 text-base text-default-700 font-semibold">Composing Utilities with @apply – Tailwind
                        CSS</h6>
                </a>
                <div class="flex justify-center">
                    <iframe class="md:w-full rounded-md md:aspect-video" frameborder="0"
                            src="https://www.youtube.com/embed/TrftauE2Vyk?si=HRCFmq5956C01yB3"></iframe>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <a href="https://www.youtube.com/embed/_CntOc4hBcg?si=-gNbpwS69E8EmjvI" target="_blank">
                    <h6 class="mb-6 text-base text-default-700 font-semibold">Sorting Tailwind CSS Classes Automatically
                        with Prettier</h6>
                </a>
                <div class="flex justify-center">
                    <iframe class="md:w-full rounded-md md:aspect-video" frameborder="0"
                            src="https://www.youtube.com/embed/_CntOc4hBcg?si=-gNbpwS69E8EmjvI"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection
