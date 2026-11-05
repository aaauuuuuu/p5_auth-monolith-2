<?php

namespace Modules\Library\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class AuthorHasBooksException extends Exception
{
    protected string $authorName;
    protected int $bookCount;

    public function __construct(string $authorName, int $bookCount)
    {
        $this->authorName = $authorName;
        $this->bookCount = $bookCount;
        parent::__construct("Penulis '{$authorName}' tidak dapat dihapus karena masih memiliki {$bookCount} buku yang terdaftar.");
    }

    public function report(): void
    {
        Log::error("[Custom Exception] Penghapusan gagal: {$this->getMessage()}");
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'author_has_books',
                'message' => $this->getMessage(),
            ], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}
