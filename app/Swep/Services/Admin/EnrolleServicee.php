<?php


namespace App\Swep\Services\Admin;


use App\Swep\BaseClasses\Admin\BaseService;
use App\Swep\Repositories\Admin\EnrolleeRepository;
use App\Swep\Repositories\Admin\EnrolleesAccountsRepository;
use App\Swep\Repositories\Admin\EnrolleeSubjectsRepository;
use App\Swep\Repositories\Admin\StudentRepository;

class EnrolleServicee extends BaseService
{
    protected $enrollee_repo;
    protected $enrollee_acc_repo;
    protected $enrollee_subjs_repo;
    protected $student_repo;
    public  function __construct(EnrolleeRepository $enrollee_repo,EnrolleesAccountsRepository $enrollee_acc_repo, EnrolleeSubjectsRepository $enrollee_subjs_repo,StudentRepository $student_repo)
    {
        $this->enrollee_repo = $enrollee_repo;
        $this->enrollee_acc_repo = $enrollee_acc_repo;
        $this->enrollee_subjs_repo = $enrollee_subjs_repo;
        $this->student_repo = $student_repo;
        $this->num_months = 10;
    }

    public function store($request){
        //CHECK IF STUDENT EXISTS;
        $enrollee = $this->student_repo->find($request->s);

        if(is_null($enrollee)){
            abort(501,'Student does not exist. Add student first in Master List');
        }

        //CHECK FOR DUPLICATE ENROLLMENT
        $enrollee = $this->enrollee_repo->findDuplicateEnrollment($request->s,$request->sy);
        if(!is_null($enrollee)){
            if($enrollee->count() > 0 ){
                abort(501,'Existing enrollment found for SY: '.$request->sy.'-'.($request->sy+1));
            }
        }


        //STORE ENROLLEE
        $enrollee = $this->enrollee_repo->store($request);

        if($enrollee){
            $enrollment_id = $enrollee->id;
            if(!empty($request->amount) && !empty($request->payables)){
                //STORE ACCOUNTS PAYABLE
                foreach ($request->payables as $key => $payable) {

                    if($payable == 'Pledge (One month)'){
                        $month = 0;
                        $req = collect();
                        $req->payable = 'Pledge';
                        $req->amount = $request->amount[$key];
                        $req->student_id = $request->s;
                        $req->sy = $request->sy;
                        $req->enrollment_id = $enrollment_id;
                        while ($month < $this->num_months){
                            $month++;
                            $req->pledge_month = $month;
                            $this->enrollee_acc_repo->store($req);

                        }

                    }else{
                        $req = collect();
                        $req->payable = $payable;
                        $req->amount = $request->amount[$key];
                        $req->student_id = $request->s;
                        $req->sy = $request->sy;
                        $req->pledge_month = null;
                        $req->enrollment_id = $enrollment_id;
                        $this->enrollee_acc_repo->store($req);
                    }

                }

            }else{
                abort(500,'NO ACCOUNTS PAYABLE STATED');
            }

            if(count($request->subjects) > 0){
                //STORE SUBJECTS
                foreach ($request->subjects as $subject){
                    $req = collect();
                    $req->student_id = $request->s;
                    $req->subject_id = $subject;
                    $req->sy = $request->sy;
                    $req->grade = $request->g;
                    $req->enrollment_id = $enrollment_id;

                    $this->enrollee_subjs_repo->store($req);
                }
            }else{
                abort(500,'NO SUBJECTS STATED');
            }

            return 1;

        }
    }
}