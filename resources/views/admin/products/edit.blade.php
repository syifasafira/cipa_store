<x-admin-layout>
    <x-slot name="header">
        Edit Product
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                <h2 class="text-2xl font-bold mb-6">Edit Product</h2>

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <x-label for="name" :value="__('Product Name')" />
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $product->name)" required autofocus />
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <x-label for="category_id" :value="__('Category')" />
                        <select id="category_id" name="category_id" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                             <x-label for="sku" :value="__('SKU (Code)')" />
                             <x-input id="sku" class="block mt-1 w-full" type="text" name="sku" :value="old('sku', $product->sku)" />
                             @error('sku')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                             @enderror
                        </div>
                        <div>
                             <x-label for="sizes" :value="__('Sizes (e.g. S,M,L,XL)')" />
                             <x-input id="sizes" class="block mt-1 w-full" type="text" name="sizes" :value="old('sizes', $product->sizes)" />
                             @error('sizes')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4">
                        <div>
                            <x-label for="price" :value="__('Price (IDR)')" />
                            <x-input id="price" class="block mt-1 w-full" type="number" name="price" :value="old('price', $product->price)" required />
                            @error('price')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="stock" :value="__('Stock')" />
                            <x-input id="stock" class="block mt-1 w-full" type="number" name="stock" :value="old('stock', $product->stock)" required />
                            @error('stock')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <x-label for="weight" :value="__('Weight (gram)')" />
                            <x-input id="weight" class="block mt-1 w-full" type="number" name="weight" :value="old('weight', $product->weight) ?? 0" required />
                            @error('weight')
                                <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <x-label for="description" :value="__('Description')" />
                        <textarea id="description" name="description" rows="4" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-6">
                        <x-label for="image" :value="__('Product Image')" />
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="Current Image" class="w-32 h-32 object-cover rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-500 mt-1">Current Image</p>
                            </div>
                        @endif
                        <input id="image" type="file" name="image" class="block mt-1 w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 transition-colors" />
                        @error('image')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">Cancel</a>
                        <x-button class="bg-indigo-600 hover:bg-indigo-700">Update Product</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</x-admin-layout>
