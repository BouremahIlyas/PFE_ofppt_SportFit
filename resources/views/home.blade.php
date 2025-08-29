<x-app-layout>
   

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section - Swiper Carousel -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <!-- Slider main container -->
                <div class="swiper hero-swiper rounded-lg shadow-lg">
                    <!-- Additional required wrapper -->
                    <div class="swiper-wrapper">
                        <!-- Slide 1 -->
                        <div class="swiper-slide relative bg-cover bg-center min-h-[500px] flex flex-col justify-center items-center text-white" style="background-image: url('https://images.unsplash.com/photo-1599058917212-d750089bc07e?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80') ;">
                            <div class="absolute inset-0 bg-black opacity-50"></div>
                            <div class="relative z-10 p-8 md:p-16 text-center max-w-3xl">
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">Welcome to SportFit!</h1>
                                <p class="text-xl sm:text-2xl mb-8">Your one-stop shop for the best fitness gear and apparel.</p>
                                <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 font-semibold py-3 px-10 rounded-lg hover:bg-gray-200 transition duration-300 text-lg md:text-xl">
                                    Shop Now
                                </a>
                            </div>
                        </div>
                        <!-- Slide 2 -->
                        <div class="swiper-slide relative bg-cover bg-center min-h-[500px] flex flex-col justify-center items-center text-white" style="background-image: url('https://i.pinimg.com/736x/41/ea/81/41ea818a751791c960d0c1b822c623fd.jpg');">
                            <div class="absolute inset-0 bg-black opacity-40"></div> {{-- Slightly different opacity for variation --}}
                            <div class="relative z-10 p-8 md:p-16 text-center max-w-3xl">
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">Discover New Arrivals</h1>
                                <p class="text-xl sm:text-2xl mb-8">Fresh gear to elevate your workout.</p>
                                <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 font-semibold py-3 px-10 rounded-lg hover:bg-gray-200 transition duration-300 text-lg md:text-xl">
                                    Explore Collection
                                </a>
                            </div>
                        </div>
                        <!-- Slide 3 -->
                        <div class="swiper-slide relative bg-cover bg-center min-h-[500px] flex flex-col justify-center items-center text-white" style="background-image: url('https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-1.2.1&auto=format&fit=crop&w=1500&q=80');">
                            <div class="absolute inset-0 bg-black opacity-40"></div> 
                            <div class="relative z-10 p-8 md:p-16 text-center max-w-3xl">
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">Achieve Your Goals</h1>
                                <p class="text-xl sm:text-2xl mb-8">Top-quality equipment and apparel.</p>
                                <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 font-semibold py-3 px-10 rounded-lg hover:bg-gray-200 transition duration-300 text-lg md:text-xl">
                                    Get Started
                                </a>
                            </div>
                        </div>
                        <!-- Slide 4 - New -->
                        <div class="swiper-slide relative bg-cover bg-center min-h-[500px] flex flex-col justify-center items-center text-white" style="background-image: url('https://i.pinimg.com/736x/c0/8f/2e/c08f2eb8c93e82c3cec9eec106f6aed8.jpg');">
                            <div class="absolute inset-0 bg-black opacity-50"></div>
                            <div class="relative z-10 p-8 md:p-16 text-center max-w-3xl">
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">Peak Performance Gear</h1>
                                <p class="text-xl sm:text-2xl mb-8">Engineered for athletes, by athletes.</p>
                                <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 font-semibold py-3 px-10 rounded-lg hover:bg-gray-200 transition duration-300 text-lg md:text-xl">
                                    Shop Performance
                                </a>
                            </div>
                        </div>
                        <!-- Slide 5 - New -->
                        <div class="swiper-slide relative bg-cover bg-center min-h-[500px] flex flex-col justify-center items-center text-white" style="background-image: url('https://i.pinimg.com/736x/43/c9/a8/43c9a873f3d66cfd74fe7b2db69c5932.jpg');">
                            <div class="absolute inset-0 bg-black opacity-40"></div>
                            <div class="relative z-10 p-8 md:p-16 text-center max-w-3xl">
                                <h1 class="text-4xl sm:text-5xl md:text-6xl font-bold mb-6">Fitness Lifestyle</h1>
                                <p class="text-xl sm:text-2xl mb-8">Comfort and style for your active life.</p>
                                <a href="{{ route('products.index') }}" class="bg-white text-indigo-700 font-semibold py-3 px-10 rounded-lg hover:bg-gray-200 transition duration-300 text-lg md:text-xl">
                                    View Lifestyle Range
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- If we need pagination -->
                    <div class="swiper-pagination"></div>

                    <!-- If we need navigation buttons -->
                    <div class="swiper-button-prev text-white"></div>
                    <div class="swiper-button-next text-white"></div>
                </div>
            </div>

            <!-- Featured Products Section (Placeholder) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Featured Products</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {{-- Check if $featuredProducts is set and not empty --}}
                        @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                            @foreach ($featuredProducts as $product)
                            <div class="border dark:border-gray-700 rounded-lg p-4 shadow-lg hover:shadow-2xl transition-shadow duration-300 flex flex-col justify-between">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <img src="{{ $product->image_url ?? asset('images/placeholder-product.jpg') }}" alt="{{ $product->name }}" class="w-full h-56 object-cover rounded-md mb-4 hover:opacity-90 transition-opacity">
                                </a>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-700 dark:text-gray-300 font-bold text-lg mb-3">
                                        ${{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('products.show', $product->slug) }}" class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                                        View Details
                                    </a>

                                </div>
                            </div>
                            @endforeach
                        @else
                            {{-- Fallback to placeholders or a message if no featured products are available --}}
                            @for ($i = 0; $i < 3; $i++)
                            <div class="border dark:border-gray-700 rounded-lg p-4 shadow-lg">
                                <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 animate-pulse"></div>
                                <h3 class="text-xl font-semibold mb-2 h-7 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-3/4"></h3>
                                <p class="text-gray-600 dark:text-gray-400 h-5 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-1/2"></p>
                                <div class="mt-4 h-10 bg-indigo-500 rounded animate-pulse w-full"></div>
                            </div>
                            @endfor
                            @if(!isset($featuredProducts) || $featuredProducts->count() === 0)
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400 py-4">No featured products to display at the moment. Check back soon!</p>
                            @endif
                        @endif
                    </div>
                    <div class="text-center mt-8">
                        <a href="{{ route('products.index') }}" class="text-indigo-600 dark:text-indigo-400 hover:underline font-semibold text-lg">
                            View All Products &rarr;
                        </a>
                    </div>
                </div>
            </div>

            <!-- POPULAR RIGHT NOW Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-8">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Popular Right Now</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {{-- Check if $popularProducts is set and not empty --}}
                        @if(isset($popularProducts) && $popularProducts->count() > 0)
                            @foreach ($popularProducts as $product)
                            <div class="border dark:border-gray-700 rounded-lg p-4 shadow-lg hover:shadow-2xl transition-shadow duration-300 flex flex-col justify-between">
                                <a href="{{ route('products.show', $product->slug) }}" class="block">
                                    <img src="{{ $product->image_url ?? asset('images/placeholder-product.jpg') }}" alt="{{ $product->name }}" class="w-full h-56 object-cover rounded-md mb-4 hover:opacity-90 transition-opacity">
                                </a>
                                <div>
                                    <h3 class="text-xl font-semibold mb-2 text-gray-900 dark:text-gray-100">
                                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                            {{ $product->name }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-700 dark:text-gray-300 font-bold text-lg mb-3">
                                        ${{ number_format($product->price, 2) }}
                                    </p>
                                </div>
                                <div class="mt-auto">
                                    <a href="{{ route('products.show', $product->slug) }}" class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                                        View Details
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        @else
                            {{-- Fallback to placeholders or a message if no popular products are available --}}
                            @for ($i = 0; $i < 3; $i++)
                            <div class="border dark:border-gray-700 rounded-lg p-4 shadow-lg">
                                <div class="w-full h-56 bg-gray-200 dark:bg-gray-700 rounded-md mb-4 animate-pulse"></div>
                                <h3 class="text-xl font-semibold mb-2 h-7 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-3/4"></h3>
                                <p class="text-gray-600 dark:text-gray-400 h-5 bg-gray-200 dark:bg-gray-700 rounded animate-pulse w-1/2"></p>
                                <div class="mt-4 h-10 bg-indigo-500 rounded animate-pulse w-full"></div>
                            </div>
                            @endfor
                            <p class="col-span-full text-center text-gray-500 dark:text-gray-400 py-4">No popular products to display at the moment. Check back soon!</p>
                        @endif
                    </div>
                </div>
            </div>
            <!-- End POPULAR RIGHT NOW Section -->

            <!-- Categories Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8">
                    <h2 class="text-3xl font-semibold text-gray-900 dark:text-gray-100 mb-6">Shop by Category</h2>
                    @if(isset($categories) && $categories->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach ($categories as $category)
                            {{-- Assuming your products index can filter by category slug --}}
                            <a href="{{ route('products.index', ['category' => $category->slug]) }}"
                               class="block bg-gray-100 dark:bg-gray-700 p-6 rounded-lg text-center hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors duration-300 shadow hover:shadow-md">
                                <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200">{{ $category->name }}</h3>
                                {{-- You could add an image here too if your Category model has one --}}
                                <img src="{{ $category->image_url ?? asset('images/placeholder-category.jpg') }}" alt="{{ $category->name }}" class="w-16 h-16 mx-auto mb-2 object-cover rounded-full">
                            </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-center text-gray-500 dark:text-gray-400 py-4">No categories to display at the moment.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>