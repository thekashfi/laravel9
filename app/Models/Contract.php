<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'summary', 'slug', 'description', 'text', 'price' ,'old_price' , 'is_active'];
    protected $with = ['category'];

    // public function fillables()
    // {
    //     return $this->hasMany(Fillable::class);
    // }

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
    public function packageCategory()
    {
        return $this->categories()->orderByDesc('hidden')->first();
    }
    public function package()
    {
        return $this->morphToMany(Package::class, 'item' , 'package_items');
    }

    public function isBought(User $user){
        return $user->items()->where('item_id' , $this->id)
            ->where('item_type' , self::class)
            ->exists();
    }
}
