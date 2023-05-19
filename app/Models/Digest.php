<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Digest extends Model
{
    use HasFactory;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getPrevious()
    {
        return self::where('id', '<', $this->id)->orderBy('id', 'desc')->first();
    }

    public function getNext()
    {
        return self::where('id', '>', $this->id)->orderBy('id', 'asc')->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeForAdmin($query)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return $query;
        } else {
            return $query->where('is_published', 1);
        }
    }
}
