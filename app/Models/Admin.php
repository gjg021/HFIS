<?php

namespace App\Models;

use Kyslik\ColumnSortable\Sortable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Admin extends Authenticatable{


    use Notifiable, Sortable;

    protected $guard = 'admin';

    protected $dates = ['created_at', 'updated_at', 'last_login_time'];
    public $sortable = ['username', 'firstname', 'is_online', 'is_active'];
    public $timestamps = false;
    protected $hidden = ['password', 'remember_token',];
    protected $fillable = ['slug'];


    protected $attributes = [

        // 'slug' => '',
        'email' => '', 
        'username' => '', 
        'password' => '', 
        'slug' => '',
        'last_name' => '', 
        'middle_name' => '', 
        'first_name' => '', 
        'position' => '', 
        'is_activated' => 0,
        // 'is_online' => false, 
        // 'is_active' => false,
        'color' => 'skin-green sidebar-mini', 
        'created_at' => null, 
        'updated_at' => null,
        'ip_created' => '',
        'ip_updated' => '',
        'user_created' => '',
        'user_updated' => '',
        // 'last_login_time' => null,
        // 'last_login_machine' => '',
        // 'last_login_ip' => '',

    ];


    public function admin_functions(){
        return $this->hasMany('App\Models\Admin\AdminFunctions','admin_slug','slug');
    }

    public function getFunction(){
        return $this->belongsToMany('App\Models\Admin\Functions', 'admin_functions','admin_slug','function_slug','slug','slug');
    }



}
