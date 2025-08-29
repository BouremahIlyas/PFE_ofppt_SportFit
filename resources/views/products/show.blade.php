<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto px-6">
            <div class="bg-white dark:bg-gray-800 shadow-xl rounded-lg overflow-hidden md:flex">
                <div class="md:w-1/2">
                    {{-- Image Gallery (Simple for now) --}}
                    <img src="{{ $product->image_url ?: 'https://via.placeholder.com/800x600.png?text=No+Image' }}" alt="{{ $product->name }}" class="w-full h-auto object-cover md:h-full">
                    {{-- TODO: Add image gallery functionality if multiple images --}}
                </div>
                <div class="md:w-1/2 p-8">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 dark:text-white mb-3 flex items-center">
                        {{ $product->name }}
                        @auth
                            <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="ml-4 inline">
                                @csrf
                                <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none">
                                    @if(auth()->user()->wishlist->contains($product->id))
                                        <!-- Filled Heart SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-6 h-6 inline" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                    @else
                                        <!-- Outline Heart SVG -->
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" class="w-6 h-6 inline" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 016.364 0L12 7.636l1.318-1.318a4.5 4.5 0 116.364 6.364L12 21.364l-7.682-7.682a4.5 4.5 0 010-6.364z"/></svg>
                                    @endif
                                </button>
                            </form>
                        @endauth
                    </h1>

                    @if($product->category)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Category: <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline">{{ $product->category->name }}</a> {{-- Link to category filter later --}}
                        </p>
                    @endif

                    <p class="text-3xl text-indigo-600 dark:text-indigo-400 font-semibold mb-6">${{ number_format($product->price, 2) }}</p>

                    <div class="mb-6">
                        <h2 class="text-xl font-semibold text-gray-700 dark:text-white mb-2">Description</h2>
                        <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </p>
                    </div>

                    <div class="mb-6">
                        <p class="text-gray-700 dark:text-white">
                            Stock:
                            @if($product->stock_quantity > 0)
                                <span class="text-green-500 font-semibold">In Stock ({{ $product->stock_quantity }} available)</span>
                            @else
                                <span class="text-red-500 font-semibold">Out of Stock</span>
                            @endif
                        </p>
                    </div>

                    {{-- Add to Cart Form --}}
                    <form action="{{ route('cart.add', $product->slug) }}" method="POST">
                        @csrf
                        {{-- No need for product_id hidden input as we pass the product object in the route --}}
                        <div class="flex items-center mb-6">
                            <label for="quantity" class="mr-4 text-gray-700 dark:text-white">Quantity:</label>
                            <input type="number" id="quantity" name="quantity" value="1" min="1" max="{{ $product->stock_quantity > 0 ? $product->stock_quantity : 1 }}" class="w-20 px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500" @if($product->stock_quantity <= 0) disabled @endif>
                        </div>
                        <button type="submit"
                                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-6 rounded-lg transition duration-150 ease-in-out @if($product->stock_quantity <= 0) opacity-50 cursor-not-allowed @endif"
                                @if($product->stock_quantity <= 0) disabled @endif>
                            Add to Cart
                        </button>
                    </form>

                    {{-- Social Share (Optional) --}}
                    {{-- <div class="mt-6">
                        <p class="text-gray-600 dark:text-gray-300">Share this product:</p>
                        Social media icons
                    </div> --}}
                </div>
            </div>

            {{-- Related Products (Optional - Implement Later) --}}
            {{-- <div class="mt-16">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-6">You Might Also Like</h2>
                Product grid for related items
            </div> --}}
        </div>
    </div>
</x-app-layout>