<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_id','item_id','item_Type', 'item_name', 'item_text'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function item()
    {
        return $this->morphTo();
    }
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
