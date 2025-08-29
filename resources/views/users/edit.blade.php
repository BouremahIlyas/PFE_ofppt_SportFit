<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <form action="{{ route('users.update', $user) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Name</label>
                    <input type="text" name="name" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" value="{{ old('name', $user->name) }}" required>
                    @error('name') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div>
                    <label class="block text-gray-700 dark:text-gray-200 font-semibold mb-2">Email</label>
                    <input type="email" name="email" class="w-full px-4 py-2 border rounded focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:bg-gray-700 dark:text-white" value="{{ old('email', $user->email) }}" required>
                    @error('email') <div class="text-red-500 text-sm mt-1">{{ $message }}</div> @enderror
                </div>
                <div class="flex justify-between">
                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-2 rounded">Update</button>
                    <a href="{{ route('users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>