<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class StudentFamily extends Model{

  

    protected $table = 'student_family';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;





    protected $attributes = [

        'student_id' => '',
        'last_name' => '', 
        'first_name' => '', 
        'middle_name' => '',
        'birthday' => null,
        'occupation' => '',
        'relationship' => '',
        'salary' => '',
        'educ_att' => '',
        'phone' => '',
        'email' => '',


    ];





    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\Admin','user_id','user_id');
   	// }

    public function student(){
        return $this->belongsTo('App\Models\Admin\Student', 'id', 'student_id');
    }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
   	// }

    





}
