<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Swep\Services\Admin\StudentService;
use App\Http\Requests\Admin\StudentFormRequest;
use DataTables;
use Carbon;
class StudentController extends Controller
{
    protected $student_service;
    public function __construct(StudentService $student_service){

        $this->student_service = $student_service;

    }
    public function index()
    {
        if(request()->ajax()){
            $data = request();

            return Datatables::of($this->student_service->fetchTable($data))
                ->addColumn('action', function($data){
                    $button = '<div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm show_student_btn" data="'.$data->slug.'" data-toggle="modal" data-target ="#show_student_modal" title="Functions" data-placement="left">
                                        <i class="fa fa-list"></i>
                                    </button>
                                    <button type="button" data="'.$data->id.'" class="btn btn-default btn-sm edit_student_btn" data-toggle="modal" data-target="#edit_student_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <button type="button" data="'.$data->id.'" class="btn btn-sm btn-danger delete_student_btn" data-toggle="tooltip" title="Delete" data-placement="top">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>';
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
        //
    }

  
    public function edit($id)
    {
        $student = $this->student_service->edit($id);
        return view('admin.students.edit')->with(['student'=> $student]);
    }

    
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
