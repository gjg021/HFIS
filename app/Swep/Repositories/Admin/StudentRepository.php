<?php

namespace App\Swep\Repositories\Admin;
 
use App\Swep\BaseClasses\Admin\BaseRepository;


use App\Models\Admin\Student;

use Auth;

class StudentRepository extends BaseRepository {

	protected $student;
	public function __construct(Student $student){
		$this->student = $student;
		parent::__construct();
	}

	public function fetchTable($data){
		$get = $this->student;


		return $get->get();
	}

	public function store($request){
		$s = new Student;
		$r = $request;
		
		$s->last_name = $r->last_name;
		$s->first_name = $r->first_name;
		$s->middle_name = $r->middle_name;
		$s->grade_level_applied = $r->grade_level_applied;
		$s->sy = $r->sy;
		$s->region = $r->region;
		$s->province = $r->province;
		$s->municipality = $r->municipality;
		$s->barangay = $r->barangay;
		$s->address = $r->address;
		$s->birthday = $r->birthday;
		$s->created_at = $this->carbon->now();
		$s->user_created = $this->auth->guard('admin')->user()->slug;
		if(!$s->save()){
			abort(500,'Error saving in database');
		}
		return $s;
	}

	public function find($id){
		$s = $this->student->where('id','=',$id)->first();
		return $s;
	}
}