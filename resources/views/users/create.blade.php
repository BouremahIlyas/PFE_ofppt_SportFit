<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" value="{{ old('name') }}" required>
                    @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" value="{{ old('email') }}" required>
                    @error('email') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                    @error('password') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" required>
                </div>
                <div class="flex justify-between">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded">Create</button>
                    <a href="{{ route('users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>