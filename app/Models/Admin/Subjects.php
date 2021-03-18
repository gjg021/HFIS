<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Subjects extends Model
{
    protected $table = 'su_subjects';

    protected $attributes = [

        'subject_id' => '',
        'subject_title' => '',
        'for_grade' => 0


    ];


    public function getEnrollments(){
        return $this->belongsToMany('App\Models\Admin\Enrollees', 'enrollees_subjects','subject_id','enrollment_id','id','id');
    }
}