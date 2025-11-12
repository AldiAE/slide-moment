<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use SoftDeletes;

    protected $fillable = ['parent_id', 'title', 'slug'];

    public function parent()
    {
        return $this->belongsTo(Header::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Header::class, 'parent_id');
    }
}
