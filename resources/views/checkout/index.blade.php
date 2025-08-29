<x-app-layout>
    {{-- You can define a header slot if your app.blade.php layout expects it --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    @if(session('info'))
                        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <strong class="font-bold">Info:</strong>
                            <span class="block sm:inline">{{ session('info') }}</span>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
                            <strong class="font-bold">Error:</strong>
                            <span class="block sm:inline">{{ session('error') }}</span>
                        </div>
                    @endif

                    @if(!empty($cart) && count($cart) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            {{-- Checkout Form --}}
                            <div class="md:col-span-2">
                                <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-6">Shipping & Payment Information</h2>
                                {{-- Replace # with your actual processing route e.g., route('checkout.process') --}}
                                <form action="{{ route('checkout.process') }}" method="POST" id="checkout-form">
                                    @csrf
                                    {{-- Shipping Address Fields --}}
                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                            <input type="text" name="name" id="name" value="{{ auth()->user()->name ?? old('name') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                                            <input type="email" name="email" id="email" value="{{ auth()->user()->email ?? old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                        </div>
                                        <div>
                                            <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Address</label>
                                            <input type="text" name="address" id="address" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                        </div>
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div>
                                                <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                                                <input type="text" name="city" id="city" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                            </div>
                                            <div>
                                                <label for="postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Postal Code</label>
                                                <input type="text" name="postal_code" id="postal_code" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                            </div>
                                        </div>
                                        <div>
                                            <label for="country" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                            <input type="text" name="country" id="country" value="United States" required class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                        </div>
                                    </div>

                                    {{-- Payment Details (Simplified Placeholder) --}}
                                    <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                        <h3 class="text-lg font-medium text-gray-900 dark:text-white">Payment Details</h3>
                                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">This is a placeholder. Integrate your payment gateway here.</p>
                                        <div class="mt-4">
                                            <label for="card_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Card Number</label>
                                            <input type="text" name="card_number" id="card_number" placeholder="**** **** **** ****" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm dark:bg-gray-700 dark:text-white">
                                        </div>
                                        {{-- Add more fields for expiry, CVV --}}
                                    </div>

                                    <div class="mt-8">
                                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-md focus:outline-none focus:shadow-outline transition duration-150 ease-in-out">
                                            Place Order
                                        </button>
                                    </div>
                                </form>
                            </div>

                            {{-- Order Summary --}}
                            <div class="md:col-span-1 order-first md:order-last">
                                <div class="bg-gray-50 dark:bg-gray-700 shadow-md rounded-lg p-6">
                                    <h2 class="text-2xl font-semibold text-gray-700 dark:text-white mb-4">Order Summary</h2>
                                    @foreach($cart as $id => $details)
                                        <div class="flex justify-between items-center mb-3 pb-3 border-b border-gray-200 dark:border-gray-600">
                                            <div class="flex items-center">
                                                <img src="{{ $details['image_url'] ?? asset('images/placeholder-product.jpg') }}" alt="{{ $details['name'] }}" class="h-12 w-12 object-cover rounded mr-3">
                                                <div>
                                                    <p class="text-gray-800 dark:text-white font-medium">{{ $details['name'] }}</p>
                                                    <p class="text-sm text-gray-500 dark:text-gray-400">Qty: {{ $details['quantity'] }}</p>
                                                </div>
                                            </div>
                                            <p class="text-gray-700 dark:text-white font-medium">${{ number_format($details['price'] * $details['quantity'], 2) }}</p>
                                        </div>
                                    @endforeach
                                    <div class="flex justify-between items-center mt-4 pt-4 border-t border-gray-200 dark:border-gray-600">
                                        <p class="text-xl font-bold text-gray-800 dark:text-white">Total:</p>
                                        <p class="text-xl font-bold text-gray-800 dark:text-white">${{ number_format($total, 2) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center py-10">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <h3 class="mt-2 text-lg font-medium text-gray-900 dark:text-gray-100">Your cart is empty</h3>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                Please add some products to your cart before proceeding to checkout.
                            </p>
                            <div class="mt-6">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Continue Shopping
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>