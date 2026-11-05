<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Alert jika validasi gagal --}}
                    @if ($errors->any())
                        <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;">
                            <strong style="font-weight: 700;">Validasi Gagal:</strong>
                            <ul style="list-style-type: disc; margin-left: 20px; margin-top: 6px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('library.books.store') }}" method="POST">
                        @csrf

                        {{-- Judul --}}
                        <div class="mb-4">
                            <label for="judul" class="block text-sm font-medium text-gray-700">Judul Buku</label>
                            <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('judul') border-red-500 @enderror">
                            @error('judul')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- ISBN --}}
                        <div class="mb-4">
                            <label for="isbn" class="block text-sm font-medium text-gray-700">Nomor ISBN (Contoh: 978-602-03-8822-1)</label>
                            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('isbn') border-red-500 @enderror">
                            @error('isbn')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Penulis (Author ID) --}}
                        <div class="mb-4">
                            <label for="author_id" class="block text-sm font-medium text-gray-700">Penulis (Author)</label>
                            <select name="author_id" id="author_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('author_id') border-red-500 @enderror">
                                <option value="">-- Pilih Penulis --</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                        {{ $author->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('author_id')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Tahun Terbit --}}
                        <div class="mb-4">
                            <label for="tahun_terbit" class="block text-sm font-medium text-gray-700">Tahun Terbit (Min 1900 - Max Sekarang)</label>
                            <input type="number" name="tahun_terbit" id="tahun_terbit" value="{{ old('tahun_terbit') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('tahun_terbit') border-red-500 @enderror">
                            @error('tahun_terbit')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Harga --}}
                        <div class="mb-4">
                            <label for="harga" class="block text-sm font-medium text-gray-700">Harga (Rp)</label>
                            <input type="number" step="0.01" name="harga" id="harga" value="{{ old('harga') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('harga') border-red-500 @enderror">
                            @error('harga')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Stok --}}
                        <div class="mb-4">
                            <label for="stok" class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                            <input type="number" name="stok" id="stok" value="{{ old('stok', 0) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('stok') border-red-500 @enderror">
                            @error('stok')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                            <a href="{{ route('library.books.index') }}" 
                               style="display: inline-flex; align-items: center; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #374151; background-color: #ffffff; text-decoration: none;">
                                Batal
                            </a>
                            <button type="submit" 
                                    style="display: inline-flex; align-items: center; padding: 8px 20px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; cursor: pointer;">
                                Simpan Buku
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
