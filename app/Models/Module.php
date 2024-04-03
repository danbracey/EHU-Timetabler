<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Module extends Model
{
    use HasFactory;

    public $incrementing = false;

    private int $id;

    public function degrees(): BelongsToMany
    {
        return $this->belongsToMany(Degree::class, 'degree_module', 'module_id', 'degree_id');
    }

    public function timeslots()
    {
        return $this->hasMany(Timeslot::class, 'module_id', 'id');
    }
}
