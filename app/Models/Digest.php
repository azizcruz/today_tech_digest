<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
