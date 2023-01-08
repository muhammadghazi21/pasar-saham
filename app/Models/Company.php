<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saham_owned()
    {
        return $this->hasMany(Saham_owned::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }

    public function saham_sale()
    {
        return $this->hasMany(Saham_sale::class);
    }
}
