<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Produk') }}
            </h2>
            <a href="{{ route('products.create') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 shadow-sm"
               style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                + Tambah Produk
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Menampilkan Flash Message Sukses --}}
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" 
                     style="background-color: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;" role="alert">
                    <span class="block sm:inline">{{ session('success') }}</span>
                </div>
            @endif

            {{-- Menampilkan Flash Message Error / Exception --}}
            @if (session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" 
                     style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;" role="alert">
                    <span class="block sm:inline">{{ session('error') }}</span>
                </div>
            @endif

            @if ($errors->has('stock'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" 
                     style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;" role="alert">
                    <strong style="font-weight: 700;">Custom Exception Terpicu:</strong>
                    <span class="block sm:inline"> {{ $errors->first('stock') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Nama Produk</th>
                                <th class="py-3 px-6 text-left">Slug</th>
                                <th class="py-3 px-6 text-right">Harga</th>
                                <th class="py-3 px-6 text-center">Stok</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($products as $index => $product)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left">{{ $products->firstItem() + $index }}</td>
                                    <td class="py-3 px-6 text-left font-medium text-gray-900">{{ $product->name }}</td>
                                    <td class="py-3 px-6 text-left">{{ $product->slug }}</td>
                                    <td class="py-3 px-6 text-right">Rp {{ number_format($product->price, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $product->stock }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        <div class="flex items-center justify-center space-x-3" style="display: flex; gap: 8px; justify-content: center; align-items: center;">
                                            {{-- Tombol Detail --}}
                                            <a href="{{ route('products.show', $product->id) }}" 
                                               style="color: #16a34a; font-weight: 600; text-decoration: none;">Detail</a>

                                            {{-- Tombol Edit --}}
                                            <a href="{{ route('products.edit', $product->id) }}" 
                                               style="color: #2563eb; font-weight: 600; text-decoration: none;">Edit</a>

                                            {{-- Tombol Tes Kurangi Stok (Custom Exception) --}}
                                            <a href="{{ route('products.reduceStock', [$product->id, 999]) }}" 
                                               title="Tes Custom Exception (Kurangi 999 Stok)"
                                               style="color: #d97706; font-weight: 600; text-decoration: none; font-size: 11px; background: #fef3c7; border: 1px solid #fde68a; padding: 2px 6px; border-radius: 4px;">
                                                Tes Exception
                                            </a>

                                            {{-- Form Hapus --}}
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" 
                                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" style="display: inline; margin: 0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" style="color: #dc2626; font-weight: 600; background: none; border: none; cursor: pointer; padding: 0;">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">
                                        Belum ada data produk. Silakan tambah produk terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    {{-- Pagination Links --}}
                    <div class="mt-4">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
