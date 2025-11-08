<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'image',
    ];

    // 🧩 Relasi
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function rows()
    {
        return $this->hasMany(Row::class);
    }
}
