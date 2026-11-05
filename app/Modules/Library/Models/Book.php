<?php

namespace Modules\Library\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isbn',
        'tahun_terbit',
        'harga',
        'stok',
        'author_id',
    ];

    protected $casts = [
        'harga' => 'decimal:2',
        'tahun_terbit' => 'integer',
        'stok' => 'integer',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_id');
    }
}
