<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kyslik\ColumnSortable\Sortable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class Project extends InfinityCacheModel
{

    use Sortable, SearchTrait;

    protected $searchable = [
        'name',
        'description',
        'client',
        'dc',
        'year',
    ];


    public $sortable = [
        'name',
        'description',
        'client',
        'dc',
        'year',
        'status',
    ];


    protected $table = 'project';

    public $timestamps = true;


    protected $fillable = [
        'name',
        'description',
        'client',
        'dc',
        'year',
        'status',
    ];


    protected $guarded = [];

    public function images()
    {
       return $this->hasMany(ProjectImage::class, 'project_id');
    }

    public function thumbnails()
    {
        return $this->hasMany(ProjectImage::class, 'project_id')->where('group', "thumbnail");
    }
}