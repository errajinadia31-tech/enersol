<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnergyData extends Model
{
    public function panel()
{
    return $this->belongsTo(Panel::class);
}
protected $fillable = [
    'sensor_id', 
    'panel_id', 
    'voltage', 
    'current', 
    'power', 
    'energy_kwh'
];
}
