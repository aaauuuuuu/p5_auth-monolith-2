<?php

namespace Modules\Library\Controllers;

use App\Http\Controllers\Controller;
use Modules\Library\Models\Author;
use Modules\Library\Requests\StoreAuthorRequest;
use Modules\Library\Exceptions\AuthorHasBooksException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(10);
        return view('library.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('library.authors.create');
    }

    public function store(StoreAuthorRequest $request)
    {
        Author::create($request->validated());

        return redirect()
            ->route('library.authors.index')
            ->with('success', 'Penulis berhasil ditambahkan.');
    }

    // Aksi Hapus Penulis (Menguji Custom Exception AuthorHasBooksException)
    public function destroy(Author $author)
    {
        $bookCount = $author->books()->count();

        if ($bookCount > 0) {
            throw new AuthorHasBooksException($author->nama, $bookCount);
        }

        $author->delete();
        Log::info("Penulis '{$author->nama}' berhasil dihapus.");

        return redirect()
            ->route('library.authors.index')
            ->with('success', 'Penulis berhasil dihapus.');
    }
}
