<?php

namespace App\Models;

use App\Policies\DigestPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

class Digest extends Model implements Sitemapable
{
    use HasFactory;

    protected $fillable = [
        'title',
        'meta_description',
        'keywords',
        'body',
        'category_id',
        'image'
    ];

    public function toSitemapTag(): Url|string|array
    {
        return route('digest.show', $this);
    }

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

    public static function queryDigests($category = null)
    {
        return  Digest::with(['category:id,name'])
            ->when($category, function ($query) use ($category) {
                $query->whereHas('category', function ($query) use ($category) {
                    $query->where('name', $category);
                });
            })
            ->forAdmin()
            ->latest('created_at')
            ->paginate(12, ['title', 'body', 'image', 'slug', 'keywords', 'created_at', 'id', 'category_id', 'meta_description', 'is_published']);
    }

    public static function published()
    {
        return Digest::where('is_published', 1);
    }
}
