<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Disciplines  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'discipline_name',
    ];


    protected $table = 'disciplines';

    protected $primaryKey = 'discipline_id';
}