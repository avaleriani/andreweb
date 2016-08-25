<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class ProjectImage extends InfinityCacheModel
{
    use Authenticatable;

    protected $table = 'project_image';

    public $timestamps = true;

    protected $fillable = [
        'project_id',
        'image_id',
        'group',
        'order',
    ];
    protected $guarded = [];

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
}