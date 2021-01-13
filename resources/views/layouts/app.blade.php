<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TMBox</title>
    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/images/icons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/icons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/images/icons/favicon-16x16.png">
    <link rel="manifest" href="/images/icons/webmanifest">
    <!-- Styles -->
    <link rel="stylesheet" href="{{env('APP_ENV') == 'production' ? secure_asset('css/vendor/swiper-v.6.4.5/swiper-bundle.min.css') : asset('css/vendor/swiper-v.6.4.5/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{env('APP_ENV') == 'production' ? secure_asset('css/app.css') : asset('css/app.css')}}">
    <!-- Liverwire styles -->
    @livewireStyles
    
    <!-- Scripts -->
    <!-- Alpine.js -->
    <script src="/js/vendor/alpine-v.2.8.0/alpine.min.js" defer></script>
    <!-- Livewire -->
    @livewireScripts
    {{-- <!--Turbolinks(SPA) support scripts for livewire, add after livewireScripts -> initiate in resources/js/app.js--> --}}
    <script src="{{env('APP_ENV') == 'production' ? secure_asset('js/vendor/livewire-turbolinks.v.0.1/livewire-turbolinks.js') : asset('js/vendor/livewire-turbolinks.v.0.1/livewire-turbolinks.js')}}" data-turbolinks-eval="false"></script>
    <!-- infinite-scroll scripts -->
    <script src="{{env('APP_ENV') == 'production' ? secure_asset('js/vendor/infinite-scroll-v.3.0.6/infinite-scroll.pkgd.min.js') : asset('js/vendor/infinite-scroll-v.3.0.6/infinite-scroll.pkgd.min.js')}}"></script>
    <!-- swiper.js -->
    <script src="{{env('APP_ENV') == 'production' ? secure_asset('js/vendor/swiper-v.6.4.5/swiper-bundle.min.js') : asset('js/vendor/swiper-v.6.4.5/swiper-bundle.min.js')}}"></script>
    <!-- swiper.js global setups-->
    <script src="{{env('APP_ENV') == 'production' ? secure_asset('js/swiperSetup.js') : asset('js/swiperSetup.js')}}"></script>
    <!-- app.js -->
    <script src="{{env('APP_ENV') == 'production' ? secure_asset('js/app.js') : asset('js/app.js') }}"></script>
</head>

<body class="min-h-screen flex flex-col font-sans bg-gray-900 text-white">
    {{--<!-- To remove fixed navbar -> remove div below and classes from nav element: fixed z-30 top-0 -->--}}
    <div class="h-18"></div>
    <nav class="block w-full border-b border-gray-800 bg-gray-900  fixed z-30 top-0 ">
        <div
            class="container mx-auto flex items-center justify-between flex-wrap px-4 py-6 "
            x-data="{ isOpen: false }"
            @keydown.escape="isOpen = false"
            :class="{ 'bg-gray-900' : isOpen }"
            >
            <!--Logo -->
            <div class="flex items-center flex-shrink-0 text-lg font-bold mr-6">
                <a href="{{ route('movies.index') }}" class="block hover:opacity-75 transition ease-in-out duration-150 ">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 pb-1 inline-block align-bottom">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                    </svg><span class="inline-block align-bottom">&nbsp;TMBox</span>
                </a>
            </div>

            <!--Toggle button - hidden on large screens -->
            <button
                @click="isOpen = !isOpen"
                type="button"
                class="block lg:hidden px-2 text-gray-500 hover:text-white focus:outline-none focus:text-white transition ease-in-out duration-150"
                :class="{ 'transition transform-180': isOpen }"
            >
                <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" >
                    <path x-show="isOpen" fill-rule="evenodd" clip-rule="evenodd" 
                        d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z" 
                    />
                    <path x-show="!isOpen" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z" />
                </svg>
            </button>

            <!--Menu-->
            <div
                class="w-full flex-grow lg:flex lg:items-center lg:w-auto transform origin-top"
                :class="{ 'block': isOpen, 'hidden': !isOpen }"
                @click.away="isOpen = false"
                x-show.transition="true"
                x-show="!isOpen"
                x-transition:enter="transition-all ease-out duration-100"
                x-transition:enter-start="opacity-0 scale-75"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition-all ease-in duration-100"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-75"
            >
                <ul class="pt-6 lg:pt-0 flex flex-col lg:flex-row lg:justify-end flex-1 items-center">
                    <li class="lg:mr-8 mb-3 lg:mb-0">
                        <a @click="isOpen = false" href="{{ route('movies.index') }}" class="hover:text-gray-300">Movies</a>
                    </li>
                    <li class="lg:mr-8 mb-3 lg:mb-0">
                        <a @click="isOpen = false" href="{{ route('tv.index') }}" class="hover:text-gray-300">TV Shows</a>
                    </li>
                    <li class="lg:mr-8 mb-3 lg:mb-0">
                        <a @click="isOpen = false" href="{{ route('actors.index') }}" class="hover:text-gray-300">Actors</a>
                    </li>
                </ul>
                <div class="flex flex-col lg:flex-row items-center">
                    <livewire:components.search>
                </div>
            </div>
        </div>
    </nav>

    {{-- <!-- Livewire full page components will render in slot automatically / don't need to use @yield  directive--> --}}
        {{ $slot }}

    <footer class="border-t border-gray-800 mb-0 mt-auto">
        <div class="container mx-auto text-sm px-4 py-6 flex flex-col sm:flex-row items-center sm:justify-between"> 
            <a class="block" href="https://www.themoviedb.org/documentation/api" target="_blank">Powered by 
                <img class="h-4 inline-block hover:opacity-75 transition ease-in-out duration-150" src="/images/tmdb.svg" alt="tmdb logo">
            </a>
            <a class="block pt-2 sm:pt-0 hover:text-gray-300" href="https://github.com/mjablonski984" target="_blank">&copy;&nbsp;mjablonski984</a>  
        </div>
    </footer>
</body>

</html>