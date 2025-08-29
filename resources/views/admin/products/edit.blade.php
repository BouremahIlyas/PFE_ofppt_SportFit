<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product') }}
        </h2>
    </x-slot>
    <div class="py-8 max-w-2xl mx-auto sm:px-6 lg:px-8">
        <form action="{{ route('products.update', $product) }}" method="POST" class="bg-white shadow rounded-lg p-8 space-y-6">
            @csrf
            @method('PUT')
            <div>
                <label class="block font-semibold mb-2">Name</label>
                <input type="text" name="name" class="w-full border rounded px-4 py-2" value="{{ old('name', $product->name) }}" required>
                @error('name') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Slug</label>
                <input type="text" name="slug" class="w-full border rounded px-4 py-2" value="{{ old('slug', $product->slug) }}" required>
                @error('slug') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Category</label>
                <select name="category_id" class="w-full border rounded px-4 py-2" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id', $product->category_id)==$category->id) selected @endif>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Price</label>
                <input type="number" name="price" step="0.01" class="w-full border rounded px-4 py-2" value="{{ old('price', $product->price) }}" required>
                @error('price') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Stock Quantity</label>
                <input type="number" name="stock_quantity" class="w-full border rounded px-4 py-2" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                @error('stock_quantity') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Image URL</label>
                <input type="text" name="image_url" class="w-full border rounded px-4 py-2" value="{{ old('image_url', $product->image_url) }}">
                @error('image_url') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div>
                <label class="block font-semibold mb-2">Description</label>
                <textarea name="description" class="w-full border rounded px-4 py-2">{{ old('description', $product->description) }}</textarea>
                @error('description') <div class="text-red-500 text-sm">{{ $message }}</div> @enderror
            </div>
            <div class="flex items-center space-x-4">
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_featured" class="form-checkbox" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                    <span class="ml-2">Featured</span>
                </label>
                <label class="inline-flex items-center">
                    <input type="checkbox" name="is_popular" class="form-checkbox" {{ old('is_popular', $product->is_popular) ? 'checked' : '' }}>
                    <span class="ml-2">Popular</span>
                </label>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update Product</button>
            </div>
        </form>
    </div>
</x-app-layout>