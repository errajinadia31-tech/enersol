<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    public function panel()
    {
        return $this->belongsTo(Panel::class);
    }
    protected $fillable = [
    'name', 
    'type', 
    'panel_id', 
    'status'
];
    public function energyData()
    {
        return $this->hasMany(EnergyData::class);
    }
}
