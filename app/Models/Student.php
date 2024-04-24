<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    //Disable Auto Incrementing due to student ID being set by the Uni
    public $incrementing = false;

    private int $id;
    private string $first_name;
    private string $last_name;
    private string $degree_id;

    /**
     * Return a relationship instance with associated Degree for this Student
     * @return HasOne
     */
    public function degree(): HasOne
    {
        return $this->hasOne(Degree::class, 'id', 'degree_id');
    }
}
