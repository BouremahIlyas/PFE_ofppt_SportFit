<x-app-layout>
    <div class="py-12">
        <div class="container mx-auto px-6">
            <h1 class="text-3xl font-bold text-center text-gray-800 dark:text-white mb-10">My Wishlist</h1>
            @if($wishlistProducts->isEmpty())
                <p class="text-center text-gray-600 dark:text-gray-300 text-xl">Your wishlist is empty.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                    @foreach($wishlistProducts as $product)
                        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden flex flex-col relative">
                            <!-- Remove from Wishlist Button (Heart Icon) -->
                            <form action="{{ route('wishlist.remove', $product->id) }}" method="POST" class="absolute top-3 right-3 z-20">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 focus:outline-none bg-white bg-opacity-80 rounded-full p-1 shadow" title="Remove from Wishlist">
                                    <!-- Filled Heart SVG -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-7 h-7" viewBox="0 0 20 20"><path d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"/></svg>
                                </button>
                            </form>
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
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>