<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class Enrollees extends Model
{
    protected $table = 'enrollees';
    public $timestamps = ['created_at'];

    protected $attributes = [

        'student_id' => 0,
        'date_application' => null,
        'grade' => 0,
        'sy' => 0,
        'created_at' => null,
        'user_created' => '',


    ];
}