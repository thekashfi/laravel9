<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name','summary','description', 'file', 'slug' ,'price' , 'is_active'];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function package()
    {
        return $this->morphToMany(Package::class, 'item' , 'package_items');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }

}
