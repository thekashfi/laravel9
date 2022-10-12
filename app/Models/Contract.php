<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name', 'summary', 'slug', 'description', 'text', 'price'];
    protected $with = ['category'];

    // public function fillables()
    // {
    //     return $this->hasMany(Fillable::class);
    // }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
