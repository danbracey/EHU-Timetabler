<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Student extends Model
{
    use HasFactory;

    private int $id;
    private string $first_name;
    private string $last_name;

    public function getDegree(): HasOne
    {
        return $this->hasOne(Degree::class, 'id', 'degree');
    }

    public function getStudentModules()
    {
        //TODO: Put relation to Modules in Students
    }
}
