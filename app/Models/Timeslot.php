<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timeslot extends Model
{
    use HasFactory;


    protected $table = 'module_timeslot';

    /**
     * Return a relationship instance with associated Module for this Timeslot
     * @return BelongsTo
     */
    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'id');
    }

    /**
     * Return a relationship instance with associated Room for this Timeslot
     * @return BelongsTo
     */
    public function room(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'id', 'room_id');
    }
}
