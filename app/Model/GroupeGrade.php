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

    public function disciplinesGroup() {
        return $this->belongsTo(GroupeDisciplines::class, 'groupe_discipline_id');
    }

    public function student() {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function evaluations() {
        return $this->belongsTo(Evaluations::class, 'evaluations_id');
    }

}