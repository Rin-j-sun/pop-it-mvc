<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeGrade  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'groupe_discipline_id',
        'evaluations_id',
        'data',
        'student_id',
    ];

    public $table = 'groupe_grade';

}