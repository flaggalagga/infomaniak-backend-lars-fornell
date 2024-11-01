<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;
    protected $fillable = ['author', 'body', 'movie_id'];

    public function movie(): BelongsTo
    {
        return $this->belongsTo(Movie::class);
    }
}