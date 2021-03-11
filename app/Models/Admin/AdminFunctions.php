<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class AdminFunctions extends Model{





    use Sortable;

    protected $table = 'admin_functions';
    
	public $timestamps = false;





    protected $attributes = [

        'admin_slug' => '',
        'function_slug' => '',

    ];


    public function masterFunction(){
        return $this->hasOne('App\Models\Admin\Functions', 'slug', 'function_slug');
    }
    

    /** RELATIONSHIPS **/
    // public function user() {
    // 	return $this->belongsTo('App\Models\Admin','user_id','user_id');
   	// }

     public function function(){
         return $this->belongsTo('App\Models\Admin\Functions', 'slug', 'function_slug');
     }


    // public function submenu() {
    // 	return $this->hasMany('App\Models\Submenu','menu_id','menu_id');
   	// }

    





}
