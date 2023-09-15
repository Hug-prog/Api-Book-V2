<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookVersion extends Model
{
    use HasFactory;

    public function publisher()
    {
        return $this->belongsTo(Publisher::class);
    }

    public function edition()
    {
        return $this->belongsTo(Edition::class);
    }

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeHasNote($query) {
        return $query->whereHas('comments', fn($q) => $q->whereNotnull('note'));
    }

    public function scopeBestRated($query, $count = 3) {
        return $query
            ->hasNote()
            ->withMax('comments', 'note')
            ->orderByDesc('comments_max_note')
            ->take($count);
    }
}
