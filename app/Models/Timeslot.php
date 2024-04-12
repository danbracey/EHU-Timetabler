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

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class, 'id');
    }
    public function room(): BelongsTo
    {
        return $this->belongsTo(Building::class, 'id', 'room_id');
    }
}
