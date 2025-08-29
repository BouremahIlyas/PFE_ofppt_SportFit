<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>SportFit</title> {{-- This should already be changed --}}
        <link rel="icon" href="{{ asset('images/sportfit_logo2.jpg') }}" type="image/jpeg"> {{-- Add this line for the favicon --}}

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- SwiperJS CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 flex flex-col">
            {{-- Ensure no footer include is here or within navigation.blade.php --}}
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow">
                {{ $slot }}
            </main>

            {{-- The footer should ONLY be included here, once. --}}
            @include('layouts.footer')
        </div>

        <!-- SwiperJS JS -->
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function () {
            if (typeof Swiper !== 'undefined') {
              new Swiper('.hero-swiper', {
                loop: true,
                autoplay: {
                  delay: 5000,
                  disableOnInteraction: false,
                },
                effect: 'fade',
                fadeEffect: {
                  crossFade: true
                },
                pagination: {
                  el: '.swiper-pagination',
                  clickable: true,
                },
                navigation: {
                  nextEl: '.swiper-button-next',
                  prevEl: '.swiper-button-prev',
                },
              });
            } else {
              console.error('Swiper is not loaded!');
            }
          });
        </script>
        @stack('scripts') {{-- Ensure this is present for page-specific scripts like Swiper initialization --}}
    </body>
</html>
