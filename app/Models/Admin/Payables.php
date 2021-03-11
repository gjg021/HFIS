<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class Payables extends Model{



    protected $table = 'su_payables';

    //protected $dates = ['created_at', 'updated_at'];

    public $timestamps = false;





    protected $attributes = [

        'payable' => '',
        'amount' => 0,
        'order' => 0,

    ];





    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\Admin','user_id','user_id');
    // }

    public function families(){
        return $this->hasMany('App\Models\Admin\StudentFamily', 'student_id', 'id');
    }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
    // }







}
