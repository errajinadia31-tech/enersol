<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

class Report extends Model
{

    public function zone(): BelongsTo
    {

        
        return $this->belongsTo(Zone::class);
    }
    protected $fillable = [
    'zone_id', 
    'total_energy', 
    'date_from', 
    'date_to', 
    'period_days'
];
}
