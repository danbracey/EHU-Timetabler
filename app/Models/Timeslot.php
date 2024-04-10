<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Timeslot extends Model
{
    use HasFactory;

    public int $module_id;
    public int $room_id;
    public int $day_of_week;
    /**
     * @var mixed
     */
    public mixed $start_time;
    public mixed $end_time;
    /**
     * @var bool
     */
    public bool $is_lecture;


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
