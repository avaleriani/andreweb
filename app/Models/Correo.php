<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Correo extends Model
{
    protected $table = 'cronmail';

    public $timestamps = true;


    protected $fillable = [
        'voluntario_id',
        'tipo_mail',
        'arr_sender',
        'arr_to',
        'arr_replyto',
        'arr_subject',
        'arr_emailvars',
        'hash',
        'colecta_id',
        'status',
        'user_id'
    ];
    
    public function voluntario(){
        return $this->hasOne(Voluntario::class, 'voluntario_id');
    }

    protected $guarded = [];

}