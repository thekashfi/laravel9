<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'description', 'slug', 'image', 'slogan1', 'slogan2' ,'price' ,'old_price' , 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function categories()
    {
        return $this->morphToMany(Category::class, 'item' , 'category_items');
    }
    public function category()
    {
        return $this->categories()->orderBy('hidden')->first();
    }
    public function contracts(){
        return $this->morphedByMany(Contract::class , 'item' ,'package_items');
    }
    public function files(){
        return $this->morphedByMany(File::class , 'item' ,'package_items');
    }
}
