<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\StudentService;
class EnrolleeController extends Controller
{
    protected $student_service;
    public function __construct(StudentService $student_service)
    {
        $this->student_service = $student_service;
    }

    public function index(){
        return 'inmdex';
    }

    public function create(){

//        if(request()->ajax()){
//            $request = request();
//
//            if($request->type == 'search_by_id'){
//                $s = $this->student_service->find($request->id);
//                return $s;
//            }
//        }

        if(empty(request()->s) || empty(request()->g) || empty(request()->sy)){
            abort(404);
        }

        $s = $this->student_service->find(request()->s);
        if(empty($s)){
            abort(404);
        }



        return view('admin.enrollees.create')->with(['s' => $s, 'r'=> request()]);
    }
}