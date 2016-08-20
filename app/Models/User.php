<?php

namespace App\Models;

use App\Traits\SearchTrait;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Kyslik\ColumnSortable\Sortable;
use Morilog\InfinityCache\Model as InfinityCacheModel;

class User extends InfinityCacheModel implements AuthenticatableContract, CanResetPasswordContract
{

    use Authenticatable, CanResetPassword, Sortable, SearchTrait;

    protected $searchable = [
        'nombre',
        'username',
        'email',
    ];


    public $sortable = [
        'nombre',
        'username',
        'password',
        'email',
        'fnac',
        'role',
        'status',
        'remember_token',
    ];


    protected $table = 'user';

    public $timestamps = true;


    protected $fillable = [
        'nombre',
        'username',
        'password',
        'email',
        'fnac',
        'role',
        'status',
        'remember_token',
    ];


    protected $guarded = [];

    public function hasRole($roles)
    {
        if ($this->role == 1) {
            return true;
        }
        if (is_array($roles)) {
            foreach ($roles as $need_role) {
                if ($this->checkIfUserHasRole($need_role)) {
                    return true;
                }
            }
        } else {
            return $this->checkIfUserHasRole($roles);
        }
        return false;
    }

    private function checkIfUserHasRole($need_role)
    {
        return ($need_role == $this->role) ? true : false;
    }

    public function isAdmin()
    {
        return $this->role == 1;
    }
}