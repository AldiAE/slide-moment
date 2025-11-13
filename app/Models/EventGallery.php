<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventGallery extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['event_id', 'event_gallery_group_id', 'name', 'media_path', 'order'];

    public function eventGalleryGroup() {
        return $this->belongsTo(EventGalleryGroup::class);
    }
}
