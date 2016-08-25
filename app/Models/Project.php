<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kyslik\ColumnSortable\Sortable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class Project extends InfinityCacheModel implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, Sortable, SearchTrait;

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
        $this->hasManyThrough(Image::class, ProjectImage::class, 'id', 'project_id');
    }
}