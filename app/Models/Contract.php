<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'text', 'price'];

    public function fillables()
    {
        return $this->hasMany(Fillable::class);
    }
}
