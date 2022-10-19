<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name','summary','description', 'slug' ,'price' , 'is_active'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function contracts(){
        return $this->morphToMany(Contract::class , 'item' ,'package_items');
    }
    public function files(){
        return $this->morphToMany(File::class , 'item' ,'package_items');
    }


    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
