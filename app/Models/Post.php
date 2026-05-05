<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'category_id',
        'user_id',
        'status'
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if ($this->image && !str_contains($this->image, 'placeholder')) {
            if (str_starts_with($this->image, 'http')) {
                return $this->image;
            }
            
            $path = public_path('images/' . $this->image);
            if (file_exists($path)) {
                return asset('images/' . $this->image);
            }
            
            return asset('storage/' . $this->image);
        }

        // Fallback to high-quality relevant images based on category and title
        $categoryName = $this->category->name ?? 'cyber';
        
        // Use a 100% unique seed based on ID and Slug to guarantee no duplicates
        $uniqueSeed = $this->id . md5($this->slug);
        
        // Create a unique offset based on title hash to pick from a pool of related keywords
        $hash = md5($this->title);
        $offset = hexdec(substr($hash, 0, 2)) % 15;
        $pool = [
            'security', 'network', 'circuit', 'code', 'server', 
            'digital', 'encryption', 'tech', 'ai', 'data',
            'matrix', 'hacker', 'chip', 'cyber', 'mainframe'
        ];
        $subKeyword = $pool[$offset];
        
        $keywords = urlencode($categoryName . ',' . $subKeyword . ',it');
        
        // Use LoremFlickr with a unique lock to ensure absolute variety
        return "https://loremflickr.com/800/600/{$keywords}/all?lock={$uniqueSeed}";
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'publish');
    }
}
