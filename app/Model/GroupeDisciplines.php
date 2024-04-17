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

}