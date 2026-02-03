@extends('layouts.base', ['title' => 'Offline'])

@section('css')

@endsection

@section('content')
    <div
        class="bg-cover bg-no-repeat bg-[url('/images/auth-bg.jpg')] dark:bg-[url('/images/auth-bg-dark.jpg')] h-screen w-full flex justify-center items-center">
        <div class="relative">
            <div class="bg-default-50 rounded-lg w-lg relative">
                <div class="text-center px-10 py-12">
                    <a class="flex justify-center" href="{{ route('second', ['dashboards', 'index']) }}">
                        <img alt="logo dark" class="h-6 block dark:hidden" src="/images/logo-dark.png"/>
                        <img alt="" class="h-6 hidden dark:block" src="/images/logo-light.png"/>
                    </a>
                    <div class="mt-10">
                        <img alt="" class="h-72 mx-auto" src="/images/offline.png"/>
                    </div>
                    <div class="mt-8 text-center">
                        <h4 class="mb-2 text-purple-500 dark:text-white text-xl font-semibold">We're Temporarily
                            Offline</h4>
                        <p class="mb-6 text-base text-default-500">We can't display these images as you're currently not
                            connected to the internet. Once you're back online, please refresh the page or click the
                            button below.</p>
                        <button
                            class="bg-primary text-white hover:bg-blue-600 rounded text-[13px] py-2 px-4 inline-flex items-center"
                            onclick="window.location.href=window.location.href" type="button">
                            <i class="size-3 me-1" data-lucide="refresh-ccw"></i>
                            Refresh
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('scripts')

@endsection
