<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Details') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-md mx-auto bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <div class="mb-4">
                <span class="block text-gray-500 dark:text-gray-400 text-sm">Name</span>
                <span class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->name }}</span>
            </div>
            <div class="mb-4">
                <span class="block text-gray-500 dark:text-gray-400 text-sm">Email</span>
                <span class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->email }}</span>
            </div>
            <div class="mb-6">
                <span class="block text-gray-500 dark:text-gray-400 text-sm">Registered</span>
                <span class="text-lg font-semibold text-gray-800 dark:text-white">{{ $user->created_at->format('Y-m-d') }}</span>
            </div>
            <div class="flex justify-between">
                <a href="{{ route('users.edit', $user) }}" class="bg-yellow-400 hover:bg-yellow-500 text-white font-semibold px-6 py-2 rounded">Edit</a>
                <a href="{{ route('users.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>