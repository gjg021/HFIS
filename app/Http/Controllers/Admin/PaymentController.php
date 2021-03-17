<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Admin\Enrollees;
use App\Models\Admin\EnrolleesPayments;
use App\Models\Admin\EnrolleesPaymentsDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class PaymentController extends Controller
{

    public function assessed_index(){

        if(request()->ajax()){

            //IF REQUEST IS DATATABLE
            if(request()->draw>0){
                $enrollees = Enrollees::with(['student','account_payables'])->doesntHave('payments')->get();

                return DataTables::of($enrollees)
                    ->editColumn('fullname',function ($data){
                        return $data->student->last_name.', '.$data->student->first_name.' '.$data->student->middle_name;
                    })
                    ->editColumn('date_application',function($data){
                        return date('F d, Y',strtotime($data->date_application));
                    })
                    ->editColumn('created_at',function($data){
                        return date('F d, Y',strtotime($data->created_at));
                    })
                    ->editColumn('grade',function ($data){
                        return $data->grade;
                    })
                    ->editColumn('sy',function ($data){
                        return $data->sy.'-'.($data->sy+1);
                    })
                    ->editColumn('total_amt',function ($data){
                        $total =$data->account_payables->sum('amount');

                        return number_format($total,2);
                    })
                    ->addColumn('action',function($data){
                        $button= '';
//                       $button = '<div class="btn-group">';
                        $button = $button . '<button type="button" data="' . $data->id . '" class="btn btn-primary btn-xs add_payment_btn" data-toggle="modal" data-target="#add_payment_modal" title="Edit" data-placement="top">
                                        <i class="fa fa-plus"></i>  Add Payment
                                    </button>';
//                       $button = $button.'</div>';
                        return $button;
                    })
                    ->setRowAttr([])
                    ->escapeColumns([])
                    ->setRowId('id')
                    ->make(true);

            }
        }

        return view('admin.payments.index');

    }

    public function add_payment_show(){
        $id = request()->enrollment_id;
        $enrollee = Enrollees::with('student')->find($id)->first();
        return view('admin.payments.add_payment')->with(['enrollee'=> $enrollee]);
    }


    public function store(Request $request){

        $payment = new EnrolleesPayments;
        $payment->enrollee_id = $request->enrollee_id;
        $payment->student_id = $request->student_id;
        $payment->or_number = $request->or_number;
        $payment->date = $request->date;
        $payment->payee = $request->payee;
        $payment->tin = $request->tin;
        $payment->type = $request->type;
        $payment->check_number = $request->check_number;
        $payment->user_created = Auth::guard('admin')->user()->slug;

        if($payment->save()){
            foreach ($request->payment_for as $key => $payment_for){
                $details = new EnrolleesPaymentsDetails;
                $details->payment_id = $payment->id;
                $details->as_payment_for = $payment_for;
                $details->amount = $request->amount[$key];
                $details->save();
            }
        }

    }

}