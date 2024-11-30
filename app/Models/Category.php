<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];
    public function store()
    {
        return $this->hasMany(Category::class, 'category_id');
    }

}
