<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Enrollees;
use App\Models\Admin\EnrolleesAccounts;
use App\Swep\Services\Admin\EnrolleServicee;
use App\Swep\Services\Admin\StudentService;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use function foo\func;

class EnrolleeController extends Controller
{
    protected $student_service;
    protected $enrollee_service;
    public function __construct(StudentService $student_service, EnrolleServicee $enrollee_service)
    {
        $this->student_service = $student_service;
        $this->enrollee_service = $enrollee_service;
        $this->enrollments = Enrollees::with(['student']);
    }

    public function index(){

        if(request()->ajax()){
            if(request()->draw > 0){
                return DataTables::of($this->enrollments->get())
                    ->editColumn('fullname',function($data){
                        return $data->student->last_name.', '.$data->student->first_name.' '.$data->student->middle_name ;
                    })
                    ->editColumn('date_application',function($data){
                        return date('M d, Y',strtotime($data->date_application));
                    })
                    ->editColumn('created_at',function($data){
                        return date('M d, Y',strtotime($data->created_at));
                    })
                    ->editColumn('sy',function($data){
                        return $data->sy.'-'.($data->sy+1);
                    })
                    ->editColumn('status',function($data){
                        return 'status';
                    })
                    ->addColumn('action',function($data){
                        $button = '<div class="btn-group">';
                        if(isset(session('functions')['admin.enrollees.show'])) {
                            $route = route('admin.students.show',$data->id);
                            $route = "window.open('".$route."','_blank')";
                            $button = $button . '<button type="button" data="' . $data->id . '" class="btn btn-default btn-sm show_enrollment_btn" data-toggle="modal" data-target="#show_enrollment_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-file-o"></i>
                                    </button>';
                        }
                        if(isset(session('functions')['admin.enrollees.edit'])){
                            $button = $button.'<button type="button" data="'.$data->id.'" class="btn btn-default btn-sm edit_enrollment_btn" data-toggle="modal" data-target="#edit_enrollment_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>';
                        }
                        if(isset(session('functions')['admin.students.destroy'])){
                            $button = $button.'<button type="button" data="'.$data->id.'" class="btn btn-sm btn-danger delete_student_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>';
                        }


                        $button = $button.'</div>';


                        return $button;
                    })
                    ->escapeColumns([])
                    ->setRowId('id')
                    ->make(true);;
            }
        }
        return view('admin.enrollees.index');
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

    public function show($id){
        return $id;
    }

    public function edit($id){
        $enrollment = $this->enrollments->find($id);
        return view('admin.enrollees.edit')->with(['enrollment' => $enrollment]);
    }

    public function accounts_payable_table(){
        if(request()->ajax()){

            if(request()->draw > 0){
                $enrollment_id = request()->enrollment_id;
                return DataTables::of(EnrolleesAccounts::where('enrollment_id',$enrollment_id)->get())
                    ->addColumn('action', function($data){
                        $button = '<div class="btn-group">';
                        $button = $button . '<button type="button" data="' . $data->id . '" class="btn btn-default btn-xs show_enrollment_btn" data-toggle="modal" data-target="#show_enrollment_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-file-o"></i> Edit
                                    </button>';
                        $button = $button.'<button type="button" data="'.$data->id.'" class="btn btn-xs btn-danger delete_student_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i> DEL
                                    </button>';
                        $button = $button.'</div>';

                        return $button;
                    })
                    ->escapeColumns([])
                    ->make(true);
            }
        }
    }
}