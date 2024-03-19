<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Database\Eloquent;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Eloquent\
 */
class Degree extends Model
{
    use HasFactory;

    public $incrementing = false;

    /**
     * @var string
     */
    private string $id;
    /**
     * @var string
     */
    private string $friendly_name;
    /**
     * Returns relation of modules that exist on this degree
     * @return void
     */
    public function getModules()
    {
        //Relation goes here
    }

    /**
     * Returns relation of all students on this degree
     * @return void
     */
    public function getStudents()
    {
        //Relation goes here
    }
}
