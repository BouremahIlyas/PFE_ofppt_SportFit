<footer class="bg-gray-800 text-gray-300 dark:bg-gray-900 dark:text-gray-400 border-t border-gray-700 dark:border-gray-600">
    <div class="container mx-auto px-6 py-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- About Section --}}
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-200 mb-4">SportFit</h3>
                <p class="text-sm">
                    Your one-stop shop for the best fitness gear and apparel. We are dedicated to providing high-quality products to help you achieve your fitness goals.
                </p>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-200 mb-4">Quick Links</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-indigo-400 transition-colors">Home</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-indigo-400 transition-colors">Products</a></li>
                    <li><a href="#" class="hover:text-indigo-400 transition-colors">About Us</a></li> {{-- Replace # with actual route --}}
                    <li><a href="#" class="hover:text-indigo-400 transition-colors">Contact</a></li> {{-- Replace # with actual route --}}
                    <li><a href="#" class="hover:text-indigo-400 transition-colors">FAQs</a></li> {{-- Replace # with actual route --}}
                </ul>
            </div>

            {{-- Newsletter Signup --}}
            <div>
                <h3 class="text-lg font-semibold text-white dark:text-gray-200 mb-4">Subscribe to our Newsletter</h3>
                <p class="text-sm mb-3">Get the latest updates on new products and upcoming sales.</p>

                @if (session('success'))
                    <div class="bg-green-500 text-white p-3 rounded-md mb-3 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="bg-red-500 text-white p-3 rounded-md mb-3 text-sm">
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('newsletter.subscribe') }}" method="POST" class="flex flex-col sm:flex-row">
                    @csrf
                    <input type="email" name="email" placeholder="Enter your email" class="w-full sm:flex-grow px-4 py-2.5 border border-gray-600 bg-gray-700 dark:bg-gray-800 text-gray-200 rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 mb-2 sm:mb-0 sm:mr-2 placeholder-gray-500 dark:placeholder-gray-400" required>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2.5 rounded-md transition-colors duration-300">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>

        <div class="mt-10 pt-8 border-t border-gray-700 dark:border-gray-600 flex flex-col items-center sm:flex-row sm:justify-between">
            <p class="text-sm">&copy; {{ date('Y') }} SportFit. All rights reserved.</p>

            <div class="flex mt-4 sm:mt-0 space-x-4">
                {{-- Social Media Icons - Replace # with your actual links and use real icons --}}
                <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors" aria-label="Facebook">
                    {{-- Placeholder for Facebook Icon (e.g., <i class="fab fa-facebook-f"></i> if using Font Awesome) --}}
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" /></svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors" aria-label="Instagram">
                    {{-- Placeholder for Instagram Icon --}}
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path fill-rule="evenodd" d="M12.315 2.014a.828.828 0 01.57 0C14.394 2.115 15.52 2.507 16.43 3.01c.93.513 1.76 1.17 2.48 1.89s1.378 1.55 1.89 2.48c.503.91.895 2.036.996 3.538a.828.828 0 010 .57c-.1 1.502-.493 2.628-.996 3.538-.512.93-1.17 1.76-1.89 2.48s-1.55 1.378-2.48 1.89c-.91.503-2.036.895-3.538.996a.828.828 0 01-.57 0c-1.502-.1-2.628-.493-3.538-.996-.93-.512-1.76-1.17-2.48-1.89s-1.378-1.55-1.89-2.48c-.503-.91-.895-2.036-.996-3.538a.828.828 0 010-.57c.1-1.502.493-2.628.996-3.538.512-.93 1.17 1.76 1.89 2.48s1.55 1.378 2.48 1.89c.91-.503 2.036-.895 3.538-.996zM12 6.004a5.996 5.996 0 100 11.992 5.996 5.996 0 000-11.992zM12 15.75a3.75 3.75 0 110-7.5 3.75 3.75 0 010 7.5zM16.95 7.05a1.125 1.125 0 11-2.25 0 1.125 1.125 0 012.25 0z" clip-rule="evenodd" /></svg>
                </a>
                <a href="#" class="text-gray-400 hover:text-indigo-400 transition-colors" aria-label="Twitter">
                    {{-- Placeholder for Twitter Icon --}}
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" /></svg>
                </a>
                {{-- Add more social media links here --}}
            </div>
        </div>
    </div>
</footer>