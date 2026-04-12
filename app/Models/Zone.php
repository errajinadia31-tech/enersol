<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    public function user()
{
    $this->fillable(['name', 'user_id']);
    return $this->belongsTo(User::class);
}
protected $fillable = [
    'name', 
    'user_id'
];
public function panels()
{
    return $this->hasMany(Panel::class);
}
}
