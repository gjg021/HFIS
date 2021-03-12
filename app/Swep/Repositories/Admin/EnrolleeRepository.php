<?php


namespace App\Swep\Repositories\Admin;


use App\Models\Admin\Enrollees;
use App\Swep\BaseClasses\Admin\BaseRepository;

class EnrolleeRepository extends BaseRepository
{
    protected $enrollees;
    public function __construct(Enrollees $enrollees)
    {
        $this->enrollees = $enrollees;
        parent::__construct();
    }

    public function store($request){
        $r = $request;
        $e = New Enrollees;
        $e->student_id = $r->s;
        $e->grade = $r->g;
        $e->sy = $r->sy;
        $e->date_application = $r->date_application;
        $e->created_at = $this->carbon->now();
        $e->user_created = $this->auth->guard('admin')->user()->slug;

        $e->save();

        return $e;
    }

    public function findDuplicateEnrollment($s,$sy){

        $enrollee = $this->enrollees->where('student_id','=',$s)->where('sy','=',$sy)->first();

        return $enrollee;
    }

    public function find($s){

        $enrollee = $this->enrollees->where('student_id','=',$s)->first();

        return $enrollee;
    }
}