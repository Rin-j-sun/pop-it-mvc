<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Src\Auth\IdentityInterface;

class Student  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'firs_name',
        'last_name',
        'patronymic',
        'gender',
        'date',
        'address',
        ];

    public function group() {

        return $this->belongsTo(Group::class, 'id_group');
    }
}