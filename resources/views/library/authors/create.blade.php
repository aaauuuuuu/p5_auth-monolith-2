<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Penulis Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
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

                    <form action="{{ route('library.authors.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Penulis</label>
                            <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('nama') border-red-500 @enderror">
                            @error('nama')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Penulis</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('email') border-red-500 @enderror">
                            @error('email')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700">Biografi (Opsional)</label>
                            <textarea name="bio" id="bio" rows="4"
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                            @error('bio')
                                <p style="color: #ef4444; font-size: 13px; margin-top: 4px;">{{ $message }}</p>
                            @enderror
                        </div>

                        <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 24px;">
                            <a href="{{ route('library.authors.index') }}" 
                               style="display: inline-flex; align-items: center; padding: 8px 16px; border: 1px solid #d1d5db; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; color: #374151; background-color: #ffffff; text-decoration: none;">
                                Batal
                            </a>
                            <button type="submit" 
                                    style="display: inline-flex; align-items: center; padding: 8px 20px; background-color: #2563eb; color: #ffffff; border: none; border-radius: 6px; font-weight: 600; font-size: 12px; text-transform: uppercase; cursor: pointer;">
                                Simpan Penulis
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
