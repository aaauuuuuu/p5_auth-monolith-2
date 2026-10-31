<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center" style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Produk') }}
            </h2>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('products.edit', $product->id) }}" 
                   style="display: inline-flex; align-items: center; padding: 6px 14px; background-color: #eab308; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    Edit
                </a>
                <a href="{{ route('products.index') }}" 
                   style="display: inline-flex; align-items: center; padding: 6px 14px; background-color: #6b7280; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="border-b border-gray-200 pb-4 mb-4" style="border-bottom: 1px solid #e5e7eb; padding-bottom: 16px; margin-bottom: 16px;">
                        <h3 class="text-2xl font-bold text-gray-900" style="font-size: 24px; font-weight: 700;">{{ $product->name }}</h3>
                        <p class="text-sm text-gray-500" style="color: #6b7280; margin-top: 4px;">
                            Slug: <span style="background-color: #f3f4f6; padding: 2px 8px; border-radius: 4px; font-family: monospace;">{{ $product->slug }}</span>
                        </p>
                    </div>

                    <div style="display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; margin-bottom: 24px;">
                        <div style="background-color: #f9fafb; padding: 16px; border-radius: 8px; border: 1px solid #f3f4f6;">
                            <span style="font-size: 12px; text-transform: uppercase; color: #9ca3af; font-weight: 600; display: block;">Harga</span>
                            <p style="font-size: 20px; font-weight: 700; color: #16a34a; margin-top: 4px;">
                                Rp {{ number_format($product->price, 2, ',', '.') }}
                            </p>
                        </div>
                        <div style="background-color: #f9fafb; padding: 16px; border-radius: 8px; border: 1px solid #f3f4f6;">
                            <span style="font-size: 12px; text-transform: uppercase; color: #9ca3af; font-weight: 600; display: block;">Stok Tersedia</span>
                            <p style="font-size: 20px; font-weight: 700; color: {{ $product->stock > 0 ? '#1f2937' : '#dc2626' }}; margin-top: 4px;">
                                {{ $product->stock }} unit {{ $product->stock <= 0 ? '(Habis)' : '' }}
                            </p>
                        </div>
                    </div>

                    <div style="margin-bottom: 24px;">
                        <h4 style="font-size: 13px; font-weight: 600; color: #374151; text-transform: uppercase; margin-bottom: 8px;">Deskripsi</h4>
                        <div style="padding: 16px; background-color: #f9fafb; border-radius: 8px; color: #4b5563; white-space: pre-line; border: 1px solid #f3f4f6; min-height: 80px;">
                            {{ $product->description ?: 'Tidak ada deskripsi produk.' }}
                        </div>
                    </div>

                    <div style="display: flex; justify-content: space-between; font-size: 12px; color: #9ca3af; border-top: 1px solid #e5e7eb; padding-top: 16px;">
                        <span>Dibuat: {{ $product->created_at ? $product->created_at->format('d M Y H:i') : '-' }}</span>
                        <span>Terakhir Diperbarui: {{ $product->updated_at ? $product->updated_at->format('d M Y H:i') : '-' }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
