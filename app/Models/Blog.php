<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'featured_image',
        'status',
        'published_at',
        'created_by'
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];


protected static function booted()
{
static::saving(function ($blog) {

    $blog->slug = Str::slug($blog->title);

    // Reading Time
    $wordCount = str_word_count(strip_tags($blog->content));
    $blog->reading_time = ceil($wordCount / 200);

    // SEO Score
    $score = 0;

    if(strlen($blog->title) >= 30) $score += 30;
    if(strlen($blog->excerpt) >= 80) $score += 30;
    if(strlen(strip_tags($blog->content)) >= 300) $score += 40;

    $blog->seo_score = $score;

});
}

    public function admin()
    {
        return $this->belongsTo(Admin::class,'created_by');
    }

    public function scopePublished($query)
    {
        return $query->where('status','published');
    }
}