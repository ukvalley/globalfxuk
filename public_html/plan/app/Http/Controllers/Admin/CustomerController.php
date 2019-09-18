<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use URL;
use Mail;
use Session;
use Sentinel;
use Validator;
use App\Models\UserModel;
use App\Models\CitiesModel;
use App\Models\StatesModel;
use App\Models\CountriesModel;
use App\Models\TransactionModel;
use App\Models\EmailTemplateModel;

class CustomerController extends Controller
{
    public $arr_view_data;
    public $admin_panel_slug;

    public function __construct(UserModel $user_model)
    {
      $this->UserModel          = $user_model;
      $this->arr_view_data      = [];
      $this->admin_panel_slug   = config('app.project.admin_panel_slug');
    }

    public function dashboard()
    { 
      return view('admin.customer_user.dashboard',$this->arr_view_data);
    }

    public function daily_income()
    { 
      return view('admin.customer_user.daily_income',$this->arr_view_data);
    }

    public function work_income()
    { 
     
    $user= Sentinel::check();
                
                 $data = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')
      ->where('transaction.reciver_id','<>','')
      ->where(['transaction.reciver_id'=>$user->email])
      ->where('transaction.generator','<>','sender')
      ->where('transaction.approval','<>','completed')->where('transaction.sender_id','<>','')->where('transaction.approval','<>','failed')
      ->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount')
      ->orderBy('transaction.id','DESC')
      ->get();
 


      $this->arr_view_data['data'] = $data;
      return view('admin.customer_user.work_income',$this->arr_view_data);
    }

    public function support()
    { 
      return view('admin.customer_user.support',$this->arr_view_data);
    }
    
    
    

    public function change_password()
    { 
      return view('admin.customer_user.change_password',$this->arr_view_data);
    }

    public function epin_generate_user()
    { 
      return view('admin.admin_user.generate_epin_user',$this->arr_view_data);
    }
}
