<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Zone extends Model
{
    protected $fillable = ['name', 'city', 'user_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function panels() {
        return $this->hasMany(Panel::class);
    }
}

