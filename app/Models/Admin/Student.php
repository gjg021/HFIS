<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;


class Student extends Model{

  

    protected $table = 'students';

    protected $dates = ['created_at', 'updated_at'];
    
	public $timestamps = false;





    protected $attributes = [

        'last_name' => '', 
        'first_name' => '', 
        'middle_name' => '', 
        'birthday' => null, 
        'grade_level_applied' => '', 
        'sy' => 0, 
        'region' => '', 
        'province' => '', 
        'municipality' => '', 
        'barangay' => '', 
        'address' => '', 
        'phone' => '', 
        'email' => '', 
        'created_at' => null,
        'updated_at' => null,
        'user_created' => '',
        'user_updated' => '',

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
