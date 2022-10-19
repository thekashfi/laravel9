<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'name', 'slug', 'in_menu'];

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
