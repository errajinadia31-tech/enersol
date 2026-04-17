<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnergyData extends Model
{
    protected $fillable = ['sensor_id', 'panel_id', 'voltage', 'current', 'power', 'energy_kwh'];

    public function sensor() {
        return $this->belongsTo(Sensor::class);
    }

    public function panel() {
        return $this->belongsTo(Panel::class);
    }
}

