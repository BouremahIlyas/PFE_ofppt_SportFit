<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('About SportFit') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section with Image -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mb-12">
                <div class="relative">
                    {{-- Replace with your actual image path --}}
                    <img src="https://i.pinimg.com/736x/36/5e/2e/365e2e85bb4df0ab37e39c47fa1a1cb7.jpg" alt="SportFit Banner" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-black opacity-50"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white px-4 text-center">Welcome to SportFit</h1>
                    </div>
                </div>
                <div class="p-8 text-gray-700 dark:text-gray-300">
                    <p class="text-lg mb-4">
                        At SportFit, we are passionate about helping you achieve your fitness goals. We believe that a healthy lifestyle is a journey, and we're here to provide you with the best gear, advice, and motivation along the way.
                    </p>
                    <p>
                        Founded in 2024, our mission has always been to deliver high-quality sporting goods and foster a community of fitness enthusiasts. {{-- Suggested change --}}
                    </p>
                </div>
            </div>

            <!-- Our Mission Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-4">Our Mission</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-2">
                    To inspire and equip individuals to lead active and healthy lives by providing innovative and reliable sports products.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Quality Gear</h4>
                        <p class="text-gray-600 dark:text-gray-400">We source and provide only the best quality sports equipment and apparel.</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Community Focus</h4>
                        <p class="text-gray-600 dark:text-gray-400">Building a supportive community for all fitness levels.</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-700 p-6 rounded-lg shadow">
                        <h4 class="text-xl font-semibold text-indigo-600 dark:text-indigo-400 mb-2">Expert Advice</h4>
                        <p class="text-gray-600 dark:text-gray-400">Offering guidance and support to help you succeed.</p>
                    </div>
                </div>
            </div>

            <!-- Meet the Team Section (Optional) -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8 mb-12">
                <h3 class="text-2xl font-semibold text-gray-900 dark:text-gray-100 mb-6 text-center">Meet Our Team (Optional)</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                    {{-- Team Member 1 --}}
                    <div class="text-center">
                        {{-- Replace with actual image path --}}
                        <img src="{{ asset('images/Bouremah_ilyas.jpg') }}" alt="Team Member 1" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-medium text-gray-800 dark:text-gray-200">Bouremah Ilyas</h4>
                        <p class="text-gray-600 dark:text-gray-400">Founder & CEO</p>
                    </div>
                    {{-- Team Member 2 --}}
                    <div class="text-center">
                        {{-- Replace with actual image path --}}
                        <img src="{{ asset('images/Ouakki_Akram.jpg') }}" alt="Team Member 2" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-medium text-gray-800 dark:text-gray-200">Ouakki Akram</h4>
                        <p class="text-gray-600 dark:text-gray-400">Head of Product</p>
                    </div>
                    {{-- Team Member 3 --}}
                    <div class="text-center">
                        {{-- Replace with actual image path --}}
                        <img src="https://via.placeholder.com/150?text=Team+Member+3" alt="Team Member 3" class="w-32 h-32 rounded-full mx-auto mb-4 object-cover shadow-lg">
                        <h4 class="text-xl font-medium text-gray-800 dark:text-gray-200">Alice Brown</h4>
                        <p class="text-gray-600 dark:text-gray-400">Marketing Lead</p>
                    </div>
                </div>
            </div>

            <!-- Call to Action -->
            <div class="bg-indigo-600 dark:bg-indigo-700 text-white overflow-hidden shadow-xl sm:rounded-lg p-8 text-center">
                <h3 class="text-2xl font-semibold mb-4">Ready to Start Your Fitness Journey?</h3>
                <p class="mb-6">Browse our products or get in touch with our team today!</p>
                <a href="{{ route('products.index') }}" class="bg-white text-indigo-600 font-semibold py-2 px-6 rounded-lg hover:bg-gray-100 transition duration-300 mr-2">
                    Shop Now
                </a>
                <a href="{{ route('contact.us') }}" {{-- Replace with contact route later --}} class="border border-white text-white font-semibold py-2 px-6 rounded-lg hover:bg-white hover:text-indigo-600 transition duration-300">
                    Contact Us
                </a>
            </div>

        </div>
    </div>
</x-app-layout>