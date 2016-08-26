<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class ProjectImage extends InfinityCacheModel
{
    protected $table = 'project_image';

    public $timestamps = true;

    protected $fillable = [
        'project_id',
        'name',
        'extension',
        'filename',
        'original_path',
        'group',
        'order',
    ];
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}