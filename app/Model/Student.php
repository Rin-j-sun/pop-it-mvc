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
        'surname',
        'name',
        'patronymic',
        'gender',
        'birthdate',
        'adress',
        ];

    public function group() {

        return $this->belongsTo(StudentsGroupe::class, 'users_groupe');
    }
}