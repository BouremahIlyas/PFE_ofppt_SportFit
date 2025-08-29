<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-10">Our Products</h1>

            {{-- Filters and Sorting --}}
            <div class="mb-8 p-4 bg-white dark:bg-gray-800 shadow rounded-lg">
                <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-4">Filters & Sort</h2>
                <form action="{{ route('products.index') }}" method="GET">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Category</label>
                            <select id="category" name="category" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="">All Categories</option>
                                @if(isset($categories)) {{-- Ensure $categories is passed from controller --}}
                                    @foreach($categories as $category)
                                        <option value="{{ $category->slug }}" {{ request()->get('category') == $category->slug ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div>
                            <label for="sort" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Sort By</label>
                            <select id="sort" name="sort" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="latest" {{ request()->get('sort') == 'latest' ? 'selected' : '' }}>Latest</option>
                                <option value="price_asc" {{ request()->get('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                <option value="price_desc" {{ request()->get('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                {{-- Add other sort options like name_asc, name_desc if needed --}}
                            </select>
                        </div>
                        <div class="md:col-start-3 md:self-end">
                            <button type="submit" class="w-full mt-1 bg-indigo-600 text-white font-semibold px-4 py-2 rounded-md hover:bg-indigo-700 transition duration-150 ease-in-out">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            @if($products->count())
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach ($products as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col relative">
                            <!-- Heart Icon Wishlist Button -->
                            @auth
                                @php
                                    $inWishlist = auth()->user()->wishlist && auth()->user()->wishlist->contains($product->id);
                                @endphp
                                @if($inWishlist)
                                    <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none bg-white bg-opacity-80 rounded-full p-1 shadow">
                                            <!-- Filled Heart SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-7 h-7" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none bg-white bg-opacity-80 rounded-full p-1 shadow">
                                            <!-- Outline Heart SVG -->
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-7 h-7" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
                                        </button>
                                    </form>
                                @endif
                            @endauth
                            <a href="{{ route('products.show', $product->slug) }}">
                                <img src="{{ $product->image_url ?: 'https://via.placeholder.com/400x300.png?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-56 object-cover">
                            </a>
                           
                           
                            <div class="p-6 flex flex-col flex-grow">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-2">
                                    <a href="{{ route('products.show', $product->slug) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">{{ $product->name }}</a>
                                </h3>
                                <p class="text-gray-600 dark:text-gray-400 text-lg mb-1">${{ number_format($product->price, 2) }}</p>
                                @if($product->category)
                                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-3">
                                        Category: <a href="#" class="hover:underline">{{ $product->category->name }}</a>
                                    </p>
                                @endif
                                <div class="mt-auto flex flex-row gap-6 justify-center items-center">
                                    <!-- View Details Icon -->
                                    <a href="{{ route('products.show', $product->slug) }}" class="text-indigo-600 hover:text-indigo-800 focus:outline-none" title="View Details">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                    <!-- Add to Cart Icon -->
                                    <form action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="text-indigo-600 hover:text-indigo-800 focus:outline-none" title="Add to Cart">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13l-1.35 2.7A1 1 0 007 17h10a1 1 0 00.95-.68l3.24-7.24A1 1 0 0020 7H7m0 6V7m0 6a2 2 0 11-4 0 2 2 0 014 0zm12 0a2 2 0 11-4 0 2 2 0 014 0z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="relative">
                                <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="absolute top-2 right-2">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                                        @auth
                                            @if(auth()->user()->wishlist->contains($product->id))
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                            @else
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-6 h-6" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
                                            @endif
                                        @endauth
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-12">
                    {{ $products->links() }} {{-- Pagination links --}}
                </div>
            @else
                <p class="text-center text-gray-600 dark:text-gray-300 text-xl">No products found at the moment.</p>
            @endif
        </div>
    </div>
</x-app-layout>