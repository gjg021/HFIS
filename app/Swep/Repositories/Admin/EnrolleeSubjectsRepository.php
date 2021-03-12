<?php


namespace App\Swep\Repositories\Admin;


use App\Models\Admin\EnrolleesSubjects;
use App\Swep\BaseClasses\Admin\BaseRepository;

class EnrolleeSubjectsRepository extends BaseRepository
{
    protected $enrollees_subjects;
    public function __construct(EnrolleesSubjects $enrollees_subjects)
    {
        $this->enrollees_subjects = $enrollees_subjects;
    }

    public function store($request){
        $r = $request;
        $e_subjs = New EnrolleesSubjects;
        $e_subjs->student_id = $r->student_id;
        $e_subjs->enrollment_id = $r->enrollment_id;
        $e_subjs->subject_id = $r->subject_id;
        $e_subjs->sy = $r->sy;
        $e_subjs->grade = $r->grade;

        $e_subjs->save();
    }
}