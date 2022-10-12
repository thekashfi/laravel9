<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fillable extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'rules', 'type', 'options'];

    protected $casts = [
        'options' => 'json',
    ];

    // public function contract()
    // {
    //     return $this->belongsto(Contract::class);
    // }
}
