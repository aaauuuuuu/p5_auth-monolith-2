<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use Modules\Library\Models\Book;
use Modules\Library\Models\Author;
use Modules\Library\Requests\StoreBookRequest;
use Modules\Library\Exceptions\BookNotAvailableException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('author')->latest()->paginate(10);
        return view('library.books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::orderBy('nama')->get();
        return view('library.books.create', compact('authors'));
    }

    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());

        return redirect()
            ->route('library.books.index')
            ->with('success', 'Buku berhasil ditambahkan ke perpustakaan.');
    }

    // Aksi Pinjam Buku (Menguji Validasi Stok & Custom Exception BookNotAvailableException)
    public function borrow(Book $book)
    {
        // Validasi stok sebelum peminjaman (Fitur Tambahan Nilai Plus)
        if ($book->stok <= 0) {
            throw new BookNotAvailableException($book->judul);
        }

        $book->decrement('stok', 1);
        Log::info("Peminjaman berhasil: Buku '{$book->judul}' dipinjam. Sisa stok: {$book->stok}");

        return redirect()
            ->route('library.books.index')
            ->with('success', "Buku '{$book->judul}' berhasil dipinjam! Sisa stok: {$book->stok}");
    }
}
