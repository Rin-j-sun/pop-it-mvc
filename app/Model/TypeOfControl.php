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


    protected $table = 'type_of_control';


    protected $primaryKey = 'type_of_control_id';
}