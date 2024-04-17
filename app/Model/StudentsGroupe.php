<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class StudentsGroupe  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'group_name',
    ];


    public $table = 'students_groupe';

}