<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'subtitle', 'thumbnail', 'background', 'slug', 'order', 'date', 'is_active'];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_events');
    }

    public function galleryGroups()
    {
        return $this->hasMany(EventGalleryGroup::class);
    }
}
