<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Row extends Model
{
    use HasFactory;

    protected $fillable = [
        'page_id',
        'section_id',
        'title',
        'description',
        'order',
        'image',
    ];

    // 🧩 Relasi
    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}
