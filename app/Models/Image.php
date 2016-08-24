<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class Image extends InfinityCacheModel
{
    use Authenticatable;

    protected $table = 'image';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'heigh',
        'width',
        'path',
        'extension'
    ];


    protected $guarded = [];
}