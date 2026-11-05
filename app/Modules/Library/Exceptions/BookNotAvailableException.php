<?php

namespace Modules\Library\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class BookNotAvailableException extends Exception
{
    protected string $bookTitle;

    public function __construct(string $bookTitle)
    {
        $this->bookTitle = $bookTitle;
        parent::__construct("Buku '{$bookTitle}' saat ini tidak tersedia (stok habis).");
    }

    public function report(): void
    {
        Log::error("[Custom Exception] Peminjaman gagal: {$this->getMessage()}");
    }

    public function render($request)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'book_not_available',
                'message' => $this->getMessage(),
            ], 422);
        }

        return back()->with('error', $this->getMessage());
    }
}
