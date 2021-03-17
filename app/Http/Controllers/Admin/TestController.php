<?php


namespace App\Http\Controllers\Admin;


use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TestController
{
    public function test(){
        //return Auth::guard('admin')->user()->slug;
//        $user_roles = Admin::with('getFunctionRelation')->get();
//        foreach ($user_roles as $user){
//            dd($user->getFunctionRelation);
//        }

        $users = Admin::with('getFunction')->get();
        $functions = Admin\Functions::get();
        foreach ($users as $user){
            echo $user->getFunction->count().'</br>';
        }
    }
    
}