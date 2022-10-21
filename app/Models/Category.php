<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['icon', 'name', 'slug', 'in_menu', 'description', 'image'];

    public function contracts()
    {
        return $this->hasMany(Contract::class)->where('is_active' , 1 );
    }

    public function files()
    {
        return $this->hasMany(File::class)->where('is_active' , 1 );
    }
    public function allContracts()
    {
        return $this->hasMany(Contract::class);
    }

    public function allFiles()
    {
        return $this->hasMany(File::class);
    }
    public function packages()
    {
        return $this->hasMany(Package::class)->where('is_active' , 1 );
    }
    public function allPackages()
    {
        return $this->hasMany(Package::class);
    }
}
