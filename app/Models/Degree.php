<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Degree extends Model
{
    use HasFactory;

    public $incrementing = true;

    /**
     * @var string
     */
    private string $code;
    /**
     * @var string
     */
    private string $friendly_name;
    /**
     * Returns relation of modules that exist on this degree
     * @return BelongsToMany
     */
    public function modules(): BelongsToMany
    {
        return $this->belongsToMany(Module::class, 'degree_module', 'degree_id', 'module_id')->with('timeslots');
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
