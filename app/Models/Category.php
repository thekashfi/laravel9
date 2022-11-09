<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'name', 'slug', 'color', 'description', 'image', 'order', 'in_menu' , 'hidden'];

    public function scopeInMenu($query)
    {
        return $query->where('in_menu', 1);
    }
    public function scopeVisible($query)
    {
        return $query->where('hidden', 0);
    }
    public function packages()
    {
        return $this->morphedByMany(Package::class , 'item' ,'category_items')->where('is_active' , 1 );
    }
    public function allPackages()
    {
        return $this->morphedByMany(Package::class , 'item' ,'category_items');
    }
    public function contracts(){
        return $this->morphedByMany(Contract::class , 'item' ,'category_items')->where('is_active' , 1 );
    }
    public function allContracts(){
        return $this->morphedByMany(Contract::class , 'item' ,'category_items');
    }
    public function files(){
        return $this->morphedByMany(File::class , 'item' ,'category_items')->where('is_active' , 1 );
    }
    public function allFiles(){
        return $this->morphedByMany(File::class , 'item' ,'category_items');
    }
}
