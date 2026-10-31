@csrf

<div class="mb-4">
    <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk</label>
    <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('name') border-red-500 @enderror">
    @error('name')
        <p class="text-red-500 text-sm mt-1" style="color: #ef4444;">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
    <input type="text" name="slug" id="slug" value="{{ old('slug', $product->slug ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('slug') border-red-500 @enderror">
    @error('slug')
        <p class="text-red-500 text-sm mt-1" style="color: #ef4444;">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="price" class="block text-sm font-medium text-gray-700">Harga</label>
    <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('price') border-red-500 @enderror">
    @error('price')
        <p class="text-red-500 text-sm mt-1" style="color: #ef4444;">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="stock" class="block text-sm font-medium text-gray-700">Stok</label>
    <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}"
           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('stock') border-red-500 @enderror">
    @error('stock')
        <p class="text-red-500 text-sm mt-1" style="color: #ef4444;">{{ $message }}</p>
    @enderror
</div>

<div class="mb-4">
    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
    <textarea name="description" id="description" rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 @error('description') border-red-500 @enderror">{{ old('description', $product->description ?? '') }}</textarea>
    @error('description')
        <p class="text-red-500 text-sm mt-1" style="color: #ef4444;">{{ $message }}</p>
    @enderror
</div>

<div class="flex items-center justify-end space-x-3 mt-6">
    <a href="{{ route('products.index') }}" 
       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md font-semibold text-xs uppercase tracking-widest text-gray-700 bg-white hover:bg-gray-50 focus:outline-none shadow-sm"
       style="display: inline-flex; align-items: center; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #374151; background-color: #ffffff; text-decoration: none; margin-right: 12px;">
        Batal
    </a>
    <button type="submit" 
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:outline-none shadow-sm cursor-pointer"
            style="display: inline-flex; align-items: center; padding: 8px 20px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; cursor: pointer;">
        {{ isset($product) ? 'Perbarui Produk' : 'Simpan Produk' }}
    </button>
</div>
