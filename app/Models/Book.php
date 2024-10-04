<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    use HasFactory;

    protected $table = "books";

    protected $fillable = [
        "title",
        "category_id",
        "author_id",
        "year"
    ];

    public function category(): BelongsTo{
        return $this->belongsTo(\App\Models\Category::class, "category_id", "id");
    }

    public function author(): BelongsTo{
        return $this->belongsTo(\App\Models\Author::class, "author_id", "id");
    }
}
