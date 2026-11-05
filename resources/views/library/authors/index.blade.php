<x-app-layout>
    <x-slot name="header">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Daftar Penulis (Authors)') }}
            </h2>
            <div style="display: flex; gap: 8px;">
                <a href="{{ route('library.books.index') }}" 
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #4b5563; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    📚 Kelola Buku
                </a>
                <a href="{{ route('library.authors.create') }}" 
                   style="display: inline-flex; align-items: center; padding: 8px 16px; background-color: #2563eb; color: #ffffff; text-decoration: none; border-radius: 6px; font-weight: 600; font-size: 13px;">
                    + Tambah Penulis
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
                    <strong style="font-weight: 700;">Custom Exception Terpicu (AuthorHasBooksException):</strong>
                    <p style="margin-top: 4px;">{{ session('error') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">No</th>
                                <th class="py-3 px-6 text-left">Nama Penulis</th>
                                <th class="py-3 px-6 text-left">Email</th>
                                <th class="py-3 px-6 text-center">Jumlah Buku</th>
                                <th class="py-3 px-6 text-left">Bio</th>
                                <th class="py-3 px-6 text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 text-sm font-light">
                            @forelse ($authors as $index => $author)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="py-3 px-6 text-left">{{ $authors->firstItem() + $index }}</td>
                                    <td class="py-3 px-6 text-left font-medium text-gray-900">{{ $author->nama }}</td>
                                    <td class="py-3 px-6 text-left">{{ $author->email }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <span class="px-2 py-1 rounded text-xs font-semibold {{ $author->books_count > 0 ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600' }}">
                                            {{ $author->books_count }} buku
                                        </span>
                                    </td>
                                    <td class="py-3 px-6 text-left">{{ Str::limit($author->bio ?: '-', 40) }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <form action="{{ route('library.authors.destroy', $author->id) }}" method="POST" 
                                              onsubmit="return confirm('Hapus penulis ini?');" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    style="color: #dc2626; font-weight: 600; background: none; border: none; cursor: pointer;">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-6 px-6 text-center text-gray-500">
                                        Belum ada data penulis. Silakan tambah penulis terlebih dahulu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
