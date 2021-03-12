<?php


namespace App\Models\Admin;


use Illuminate\Database\Eloquent\Model;

class EnrolleesAccounts extends Model
{
    protected $table = 'enrollees_accounts';
    public $timestamps = false;
    protected $attributes = [

        'student_id' => 0,
        'sy' => null,
        'payable' => 0,
        'amount' => null,
        'pledge_month' => 0,

    ];
}