<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Room extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;

    public function getBuilding(): HasOne
    {
        return $this->hasOne(Building::class, 'id', 'building');
    }

    public function timeslots(): HasMany
    {
        return $this->hasMany(Timeslot::class, 'room_id', 'id');
    }
}
