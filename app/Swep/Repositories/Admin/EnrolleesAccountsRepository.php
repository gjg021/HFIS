<?php


namespace App\Swep\Repositories\Admin;


use App\Models\Admin\EnrolleesAccounts;
use App\Swep\BaseClasses\Admin\BaseRepository;

class EnrolleesAccountsRepository extends BaseRepository
{
    protected $enrollees_acc;
    public function __construct(EnrolleesAccounts $enrollees_acc)
    {
        $this->enrollees_acc = $enrollees_acc;
    }


    public function store($request){

        $r = $request;
        $e_acc = New EnrolleesAccounts;
        $e_acc->payable = $r->payable;
        $e_acc->amount = $r->amount;
        $e_acc->sy = $r->sy;
        $e_acc->student_id = $r->student_id;
        $e_acc->pledge_month = $r->pledge_month;
        $e_acc->save();
    }
}