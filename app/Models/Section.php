<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'title',
        'description',
        'image',
        'link_title',
        'link_url',
    ];

    // 🧩 Relasi
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function rows()
    {
        return $this->hasMany(Row::class);
    }
}
