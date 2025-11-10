<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'image',
    ];

    /**
     * Relasi ke Section (1 page bisa punya banyak section)
     */
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    /**
     * Relasi ke Row (1 page bisa punya banyak row)
     */
    public function rows()
    {
        return $this->hasMany(Row::class);
    }
}
