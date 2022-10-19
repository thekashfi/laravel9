<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
    ];
    public static function findByPhone($phone): self|null
    {
        return self::wherePhone($phone)->first();
    }
    public function registerNewUser($phone): User
    {
        $this->phone = $phone;
        $this->name = 'user-' . mt_rand(1000000, 9999999);
        $this->save();
        return $this;
    }


    public function items()
    {
        return $this->hasMany(OrderItem::class)->with('order' , 'item')->whereHas('order' , function ($query) {
            $query->where('is_paid' , 1);
        });
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }

}
