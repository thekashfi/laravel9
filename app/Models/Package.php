<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'name','summary','description', 'slug' ,'price' ,'old_price' , 'is_active'];

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function contracts(){
        return $this->morphedByMany(Contract::class , 'item' ,'package_items');
    }
    public function files(){
        return $this->morphedByMany(File::class , 'item' ,'package_items');
    }
}
