<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\StudentService;
use App\Http\Requests\Admin\StudentFormRequest;
use DataTables;
use Carbon;
use Route;
class StudentController extends Controller
{
    protected $student_service;
    protected $admin_function_repo;
    public function __construct(StudentService $student_service){

        $this->student_service = $student_service;
        $this->route_name = Route::currentRouteName();

    }
    public function index()
    {


        if(request()->ajax()){
            $data = request();
            $students = Student::get();
            $sy = 2021;

            return Datatables::of($students)
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">';
                    if(isset(session('functions')['admin.students.show'])) {
                        $route = route('admin.students.show',$data->id);
                        $route = "window.open('".$route."','_blank')";
                        $button = $button . '<button onclick="'.$route.'" type="button" data="' . $data->id . '" class="btn btn-default btn-sm show_student_btn" data-toggle="modal" data-target="#show_student_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-file-o"></i>
                                    </button>';
                    }
                    if(isset(session('functions')['admin.students.edit'])){
                        $button = $button.'<button type="button" data="'.$data->id.'" class="btn btn-default btn-sm edit_student_btn" data-toggle="modal" data-target="#edit_student_modal" title="Edit" data-placement="top">
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
                ->editColumn('fullname', function($data){
                    return $data->last_name.', '.$data->first_name.' '.$data->middle_name;
                })
                ->editColumn('birthday', function($data){
                    return date("M d, Y",strtotime($data->birthday));
                })
                ->editColumn('age', function($data){
                    return Carbon::parse($data->birthday)->age;
                })
                ->editColumn('status', function($data) use ($sy) {
                    if($data->enrollments()->where('sy', $sy)->exists()){
//
                        $enrollments = $data->enrollments()->orderBy('date_application')->first();
                        if($enrollments->status == 1){
                            return "Enrolled";
                        }
                        if($enrollments->payments()->exists()){
                            $payments = $enrollments->payments()->orderBy('date')->first();

                            $data->remarks = 'Paid: '.$payments->date;
                            return 'Pending Admission : Grade '.$enrollments->grade.' SY: '.$enrollments->sy.'-'.($enrollments->sy+1);
                        }
                        $data->remarks = 'Assesed: '.$enrollments->date_application;
                        return 'Pending Payment : Grade '.$enrollments->grade.' SY: '.$enrollments->sy.'-'.($enrollments->sy+1);;
                    }

                })
                ->editColumn('remarks',function ($data){
                    return $data->remarks;
                })
                ->editColumn('barangay_municipality', function($data){
                    return $data->barangay.', '. $data->municipality;
                })
                ->setRowAttr([])
                ->escapeColumns([])
                ->setRowId('id')
                ->make(true);;
        }
        return view('admin.students.index');
    }

    
    public function create()
    {
        //
    }

    
    public function store(StudentFormRequest $request)
    {
        return $this->student_service->store($request);
    }

    
    public function show($id)
    {
        $student = Student::with(['enrollments', 'enrollments.account_payables', 'enrollments.payments','enrollments.subjects','enrollments.getPaymentDetails','enrollments.getPaymentDetails.payment'])->find($id);
        return view('admin.students.show')->with(['s' => $student]);
    }

  
    public function edit($id)
    {
        $student = $this->student_service->edit($id);
        return view('admin.students.edit')->with(['student'=> $student]);
    }

    
    public function update(StudentFormRequest $request, $id)
    {
        return $this->student_service->update($request,$id);
    }

    
    public function destroy($id)
    {
        return $this->student_service->destroy($id);
    }
}
