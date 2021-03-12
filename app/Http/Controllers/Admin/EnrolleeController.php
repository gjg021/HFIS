<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\EnrolleServicee;
use App\Swep\Services\Admin\StudentService;
use Illuminate\Http\Request;

class EnrolleeController extends Controller
{
    protected $student_service;
    protected $enrollee_service;
    public function __construct(StudentService $student_service, EnrolleServicee $enrollee_service)
    {
        $this->student_service = $student_service;
        $this->enrollee_service = $enrollee_service;
    }

    public function index(){
        return 'inmdex';
    }

    public function create(){

        if(request()->ajax()){
            $request = request();

            if($request->type == 'search_by_id'){
                $s = $this->student_service->find($request->id);
                if(empty($s)){
                    abort(501,"Student does not exist");
                }
                return 1;
            }

            if(!empty($request->query)){
                $q = $request->get('query');
                return $this->student_service->findByName($q);
            }

        }

        if(count(request()->all()) > 0){
            if(empty(request()->s) || empty(request()->g) || empty(request()->sy)){
                return 'empty vars';
            }

            $s = $this->student_service->find(request()->s);
            if(empty($s)){
                return 'no student';
            }

            return view('admin.enrollees.create')->with(['s' => $s, 'r'=> request()]);
        }

        return view('admin.enrollees.search');

    }

    public function store(Request $request){
        $enroll = $this->enrollee_service->store($request);

        return $enroll;
    }
}