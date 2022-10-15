<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'contract_id', 'contract_name', 'uuid', 'contract_text', 'is_paid', 'trans1', 'trans2', 'result', 'amount', 'ip'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}
