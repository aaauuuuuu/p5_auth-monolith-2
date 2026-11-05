<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Buku Perpustakaan') }}
            </h2>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('library.authors.index') }}" 
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #4b5563; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    ✍️ Kelola Penulis
                </a>
                <a href="{{ route('library.books.create') }}" 
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    + Tambah Buku
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Flash Message Sukses --}}
            @if (session('success'))
                <div style="background-color: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            {{-- Flash Message Error / Exception --}}
            @if (session('error'))
                <div style="background-color: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 12px 16px; border-radius: 6px; margin-bottom: 16px;" role="alert">
                    <strong style="font-weight: 700;">Custom Exception Terpicu (BookNotAvailableException):</strong>
                    <p style="margin-top: 4px;">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Judul Buku</th>
                                <th class="py-3 px-6 text-left">ISBN</th>
                                <th class="py-3 px-6 text-left">Penulis</th>
                                <th class="py-3 px-6 text-center">Tahun</th>
                                <th class="py-3 px-6 text-right">Harga</th>
                                <th class="py-3 px-6 text-center">Stok</th>
                                <th class="py-3 px-6 text-center">Aksi Peminjaman</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($books as $index => $book)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left">{{ $books->firstItem() + $index }}</td>
                                    <td class="py-3 px-6 text-left font-medium text-gray-900">{{ $book->judul }}</td>
                                    <td class="py-3 px-6 text-left font-mono text-xs">{{ $book->isbn }}</td>
                                    <td class="py-3 px-6 text-left">{{ $book->author->nama ?? '-' }}</td>
                                    <td class="py-3 px-6 text-center">{{ $book->tahun_terbit }}</td>
                                    <td class="py-3 px-6 text-right">Rp {{ number_format($book->harga, 2, ',', '.') }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $book->stok > 0 ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $book->stok }}
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-center">
                                        {{-- Tombol Pinjam Buku --}}
                                        <form action="{{ route('library.books.borrow', $book->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" 
                                                    style="display: inline-flex; align-items: center; padding: 4px 12px; background-color: {{ $book->stok > 0 ? '#16a34a' : '#dc2626' }}; color: #ffffff; border: none; border-radius: 4px; font-weight: 600; font-size: 12px; cursor: pointer;">
                                                📖 {{ $book->stok > 0 ? 'Pinjam' : 'Tes Pinjam (Stok 0)' }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="py-6 px-6 text-center text-gray-500">
                                        Belum ada buku di perpustakaan. Silakan tambah data penulis dan buku terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
