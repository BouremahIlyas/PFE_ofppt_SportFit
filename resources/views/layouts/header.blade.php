<header class="bg-white shadow sticky top-0 z-50">
    <nav class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div>
                <a href="{{ route('home') }}" class="text-xl font-semibold text-gray-700 dark:text-white">SportFit</a>
            </div>
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">Home</a>
                <a href="{{ route('products.index') }}" class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">Products</a>
                <a href="{{ route('about.us') }}" class="px-3 py-2 text-gray-700 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white">About</a> {{-- UPDATED --}}
                <a href="#" class="px-3 py-2 text-gray-700 hover:text-gray-900">Contact</a> {{-- Update route later --}}

                @guest
                    <a href="{{ route('login') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900">Login</a>
                    <a href="{{ route('register') }}" class="px-3 py-2 text-gray-700 hover:text-gray-900">Register</a>
                @endguest
                @auth
                <span>is_admin: {{ Auth::user()->is_admin ==1 ? 'yes' : 'no' }}</span>
                    @if(Auth::user()->is_admin == 1)
                        <a href="{{ route('dashboard') }}">Dashboard</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           class="px-3 py-2 text-gray-700 hover:text-gray-900">
                            Logout
                        </a>
                    </form>
                @endauth

                <!-- Theme toggle button -->
                <button @click="toggle()"
                        class="ml-4 p-2 rounded-md text-gray-600 hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg x-show="!darkMode" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg x-show="darkMode" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m8.66-12.66l-.707.707M4.04 19.96l-.707.707M21 12h-1M4 12H3m15.354-8.354l-.707-.707M5.757 5.757l-.707-.707" />
                    </svg>
                </button>
            </div>
        </div>
    </nav>
</header>