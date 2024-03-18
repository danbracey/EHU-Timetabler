<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public function getModules()
    {
        //Relation goes here
    }

    public function getStudents()
    {
        //Relation goes here
    }
}
