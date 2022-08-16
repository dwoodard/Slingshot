<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Venturecraft\Revisionable\RevisionableTrait;


class Schema extends Model
{
    use HasFactory;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true; //Remove old revisions (works only when used with $historyLimit)
    protected $historyLimit = 20; //Maintain a maximum of 20 revisions per model

    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'options' => 'array',
        'schema' => 'array',
        'model' => 'array',
    ];


}
