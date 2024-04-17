<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class TypeOfControl  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'type_of_control_name',
    ];


    public $table = 'type_of_control';

}