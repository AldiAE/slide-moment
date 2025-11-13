<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventGalleryGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['event_id', 'name', 'media_path', 'order'];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function galleries()
    {
        return $this->hasMany(EventGallery::class);
    }
}
