<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Sensor extends Model
{
    protected $fillable = ['name', 'type', 'panel_id', 'status'];

    public function panel() {
        return $this->belongsTo(Panel::class);
    }

    public function energyData() {
        return $this->hasMany(EnergyData::class);
    }
}

