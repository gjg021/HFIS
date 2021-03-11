<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;


use App\Models\Admin\StudentFamily;

use Auth;

class StudentFamilyRepository extends BaseRepository {

	protected $student_family;
	public function __construct(StudentFamily $student_family){
		$this->student_family = $student_family;
		parent::__construct();
	}
	public function store($request){
		$sf = new StudentFamily;
		$sf->student_id = $request->student_id;
		$sf->last_name = $request->last_name;
		$sf->first_name = $request->first_name;
		$sf->middle_name = $request->middle_name;
		$sf->birthday = $request->birthday;
		$sf->educ_att = $request->educ_att;
		$sf->relationship = $request->relationship;
		$sf->occupation = $request->occupation;
		$sf->salary = $request->salary;
		$sf->phone = $request->phone;
		$sf->email = $request->email;
		$sf->save();

	}
}