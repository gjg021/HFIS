<?php
 
namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\StudentRepository;
use App\Swep\Repositories\Admin\StudentFamilyRepository;
class StudentService extends BaseService{

	protected $student_repo;
	protected $s_family_repo;
	public function __construct(StudentRepository $student_repo,StudentFamilyRepository $s_family_repo){
		$this->student_repo = $student_repo;
		$this->s_family_repo = $s_family_repo;
	}

	public function fetchTable($data){
		return $this->student_repo->fetchTable($data);
	}

	public function store($request){
		

		if(count($request->family_relationship) < 1 ){
			abort(500, 'At least one family member is required');
		}

		if($request->family_relationship[0] == null){
			abort(500, 'At least one family member is required');
		}
		$student = $this->student_repo->store($request);

		if($student){
			$student_id = $student->id;

			foreach($request->family_relationship as $key => $value){
				$req = collect();
				$req->student_id = $student_id;
				$req->last_name = $request->family_last_name[$key];
				$req->first_name = $request->family_first_name[$key];
				$req->middle_name = $request->family_middle_name[$key];
				$req->birthday = $request->family_birthday[$key];
				$req->relationship = $request->family_relationship[$key];
				$req->educ_att = $request->family_educ_att[$key];
				$req->occupation = $request->family_occupation[$key];
				$req->salary = $request->family_salary[$key];
				$req->phone = $request->family_phone[$key];
				$req->email = $request->family_email[$key];
				$this->s_family_repo->store($req);
			}
		}

		return $student;
	}

	public function edit($id){
		return $this->student_repo->find($id);
	}

	public function update($request,$id){

        if(count($request->family_relationship) < 1 ){
            abort(500, 'At least one family member is required');
        }

        if($request->family_relationship[0] == null){
            abort(500, 'At least one family member is required');
        }
        $student = $this->student_repo->update($request,$id);

        if($student){

            $student->families()->delete();
            $student_id = $student->id;

            foreach($request->family_relationship as $key => $value){
                $req = collect();
                $req->student_id = $student_id;
                $req->last_name = $request->family_last_name[$key];
                $req->first_name = $request->family_first_name[$key];
                $req->middle_name = $request->family_middle_name[$key];
                $req->birthday = $request->family_birthday[$key];
                $req->relationship = $request->family_relationship[$key];
                $req->educ_att = $request->family_educ_att[$key];
                $req->occupation = $request->family_occupation[$key];
                $req->salary = $request->family_salary[$key];
                $req->phone = $request->family_phone[$key];
                $req->email = $request->family_email[$key];
                $this->s_family_repo->store($req);
            }
        }

        return $student;
    }

    public function destroy($id){
	    $s = $this->student_repo->destroy($id);

	    if($s){
	        $s->families()->delete();
	        return 1;
        }
    }

    public function find($id){
	    return $this->student_repo->find($id);
    }

    public function findByName($name){
	    return $this->student_repo->findByName($name);
    }
}