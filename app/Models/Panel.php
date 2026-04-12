<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }
protected $fillable = [
    'name',
    'serial_number',
    'power_capacity',
    'status',
    'user_id',
    'zone_id',
];
    public function energyData()
    {
        return $this->hasMany(EnergyData::class);
    }
    public function sensors()
    {
        return $this->hasMany(Sensor::class);
    }
}
