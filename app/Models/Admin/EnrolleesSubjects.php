<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class EnrolleesSubjects extends Model
{
    protected $table = 'enrollees_subjects';
    public $timestamps = false;

    protected $attributes = [

        'student_id' => 0,
        'subject_id' => '',
        'grade' => 0,
        'sy' => 0,


    ];
}