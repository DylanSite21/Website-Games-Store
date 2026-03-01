<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * When you use `Model::create()` the array passed in is checked
     * against this whitelist. Without it Laravel will throw a
     * \"MassAssignmentException\" and the file upload will fail.
     */
    protected $fillable = [
        'title',
        'filename',
    ];
}
