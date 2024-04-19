<?php

namespace Model;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeDisciplines  extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'group_id',
        'discipline_id',
        'type_of_control_id',
        'number_of_hours',
        'course',
        'semester'
    ];

    public $table = 'groupe_disciplines';

    public function discipline() {
        return $this->belongsTo(Disciplines::class, 'discipline_id');
    }

    public function info_group() {
        return $this->belongsTo(StudentsGroupe::class, 'group_id');
    }

    public function control() {
        return $this->belongsTo(TypeOfControl::class, 'type_of_control_id');
    }

    protected $primaryKey = 'discipline_grope_id';

}