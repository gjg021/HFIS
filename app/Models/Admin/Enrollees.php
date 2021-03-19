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


    public function student(){
        return $this->belongsTo('App\Models\Admin\Student','student_id','id');
    }

    public function account_payables(){
        return $this->hasMany('App\Models\Admin\EnrolleesAccounts','enrollment_id','id');
    }

    public function payments(){
        return $this->hasMany('App\Models\Admin\EnrolleesPayments','enrollee_id','id');
    }

    public function subjects(){
        return $this->hasMany('App\Models\Admin\EnrolleesSubjects','enrollment_id','id');
    }

    public function getSubjects(){
        return $this->belongsToMany('App\Models\Admin\Subjects', 'enrollees_subjects','enrollment_id','subject_id','id','subject_id')
            ->withPivot(['qfirst','qsecond','qthird','qfourth']);
    }

    public function getPaymentDetails(){
        return $this->hasManyThrough('App\Models\Admin\EnrolleesPaymentsDetails','App\Models\Admin\EnrolleesPayments','enrollee_id','payment_id');
    }
}