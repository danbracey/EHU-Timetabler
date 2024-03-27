<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    private int $id;

    public function rooms()
    {
        //TODO: Get relationship between rooms & buildings
    }
}
