<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;
use Spatie\SchemalessAttributes\SchemalessAttributesTrait;


class Menu extends Model
{
    use HasFactory;
    use RevisionableTrait;
    use SchemalessAttributesTrait;

    protected $guarded = [];

    public $timestamps = false;

    protected $schemalessAttributes = [
        'items',
    ];

    public $casts = [
        'items' => 'array',
    ];

    public function scopeWithItems(): Builder
    {
        return $this->items->modelScope();
    }


}
