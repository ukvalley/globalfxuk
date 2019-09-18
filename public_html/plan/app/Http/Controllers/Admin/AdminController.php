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

class AdminController extends Controller
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
       $user = Sentinel::check();
       if($user->is_admin==1)
       {
          $this->arr_view_data['data'] = $user;
          return view('admin.admin_user.dashboard',$this->arr_view_data);
       }
       else
       {
            $data = \DB::table('transaction')->select('*')->where('generator','<>','reciever')->where(['sender_id'=>$user->email,'approval'=>'payment_done'])->get();

            $wallet_details=$this->wallet_balance();

          $this->arr_view_data['data_trans'] = $data;
          $this->arr_view_data['wallet_details']= $wallet_details;

          /*if($user->epin==null)
          {
            return view('admin.admin_user.unused_pin',$this->arr_view_data);
          }*/

          return view('admin.customer_user.dashboard',$this->arr_view_data);
       }
    }

    public function user_list()
    { 
      $data = \DB::table('users')->where('id','<>','1')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_list',$this->arr_view_data);
    }

  public function block_user_list()
    { 

      $data = \DB::table('users')
      ->where('id','<>','1')->whereIn('is_active',['1','0'])->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.block_user_list',$this->arr_view_data);
    }
    
     public function recommitment_user_list()
    { 
      $data = \DB::table('users')
      ->where('id','<>','1')->where('join_count','>=','10')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.recommitment_user_list',$this->arr_view_data);
    }
    
    
    public function check_sponcer()
    { 
        $data_ = \DB::table('users')->where('email','=',$_GET['sponcer_id'])->first();
        if(!empty($data_))
        {
            $data['status'] = "success";
            $data['name'] = $data_->user_name;
        }
        else
        {
            $data['status'] = "error";
            $data['name'] = 'error';  
        }

     return $data;
    }
    
    public function get_link()
    { 
     //$data = \DB::table('users')->where('id','<>','1')->orderBy('id','DESC')->get();
    

      $this->arr_view_data['data1'] = '';
      return view('admin.admin_user.get_link',$this->arr_view_data);
    }
    
    public function transaction()
    { 
      $data = \DB::table('transaction')->where('sender_id','<>','')->where('generator','=','reciever')->where('reciver_id','<>','')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.transaction',$this->arr_view_data);
    }


    
    public function recommit()
    { 
        //dd('work in process');
        $email = $_GET['email'];
        
        
      $data = \DB::table('users')->where('email','=',$_GET['email'])->first();

      
     /* $increment_count = $count['tree_count'];
      $increment_count++;
      dump($increment_count);
      $this->UserModel->where(['email'=>$request->input('sponcer_id')])->update(['tree_count'=>$increment_count]);*/
    
     /* $arr_data               = [];
      $arr_data['user_name']  = $request->input('username');
      $arr_data['mobile']     = $request->input('mobile');
      $arr_data['email']      = $request->input('user_id');
      $arr_data['password']   = $request->input('password');
      $arr_data['is_active']  = 1;
*/
      $plan = \DB::table('plans')->where(['plan_amount'=>$data->plan]);
      for ($i=0; $i < $plan->upline ; $i++) 
      { 
        if($i==0)
        {
          $parent_under = $data->spencer_id;
        }
        else
        {
          $data  = $this->UserModel->where(['email'=>$parent_under])->first();
          $parent_under = $data['spencer_id'];
        }
        
       
       
      
        $data  = $this->UserModel->where(['email'=>$parent_under])->first();
       
       
        if(!empty($parent_under) && $data->is_active==1 && $data->join_count>=10)
        {
          $arr_transaction                    = [];
          $arr_transaction['reciver_id']      = $parent_under;
          $arr_transaction['sender_id']       = $email;
          $arr_transaction['amount']          = $plan->withdrawl_amt;
          $arr_transaction['activity_reason'] = 'Work';
          $arr_transaction['date']            = date('Y-m-d');
          $arr_transaction['approval']        = 'payment_done';
           $arr_transaction['generator']        = 'system';
           $arr_transaction['recommit']        = 'yes';

          \DB::table('transaction')->insert($arr_transaction);
        }
        elseif($parent_under==null)
        {
          $arr_transaction                    = [];
          $arr_transaction['reciver_id']      = '';
          $arr_transaction['sender_id']       = $email;
          $arr_transaction['amount']          = $plan->withdrawl_amt;
          $arr_transaction['activity_reason'] = 'Work';
          $arr_transaction['date']            = date('Y-m-d');
          $arr_transaction['approval']        = 'payment_done';
           $arr_transaction['generator']        = 'sender';
            $arr_transaction['recommit']        = 'yes';

          \DB::table('transaction')->insert($arr_transaction);
        }
        
        else{
            $i--;
        }
        
        }
        
        
   

      for ($i=0; $i < $plan->other ; $i++)
      { 
        $arr_transaction                    = [];
        $arr_transaction['reciver_id']      = '';
        $arr_transaction['sender_id']       = $email;
        $arr_transaction['amount']          = 500;
        $arr_transaction['activity_reason'] = 'Work';
        $arr_transaction['date']            = date('Y-m-d');
        $arr_transaction['approval']        = 'payment_done';
         $arr_transaction['generator']        = 'sender';
          $arr_transaction['recommit']        = 'yes';

        \DB::table('transaction')->insert($arr_transaction);
      }

    //  $user_status = Sentinel::registerAndActivate($arr_data); 

      /*if(isset($user_status->id) && !empty($user_status->id))
      {*/
        $arr_user_data                 = [];
        $arr_user_data['joining_date']    = null;//date('Y-m-d');
        $arr_user_data['join_count']    = 0;
        
        $arr_user_data['recommitment_at']= date("Y-m-d H:i:s A");
        $this->UserModel->where(['email'=>$_GET['email']])->update($arr_user_data);
      

      $count = $this->UserModel->where(['email'=>$transaction->sender_id])->first();
      $increment_count = $count['recommit_count'];
      $increment_count++;
      $this->UserModel->where(['email'=>$transaction->sender_id])->update(['recommit_count'=>$increment_count]);

        /* $message = "Please do the recommitment on growindian.org for".$_GET['email']." Login and get Links on dashboard";
       $url='http://sms.ukvalley.com/api/sendhttp.php?authkey=27412AKDhLogNp6v5ba207d0&mobiles='.$request->input('mobile').'&message='.$message.'&sender=GROWIN&route=6';
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }*/
          
     
      Session::flash('success', 'Recommitment is proceed.');
      return redirect()->back();
    }
    
    public function user_transaction()
    { 
      $user = Sentinel::check();
      $data = \DB::table('transaction')->where('reciver_id','=',$user->email)->where('generator','=','reciever')->where('activity_reason','=','withdrawl')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_transaction',$this->arr_view_data);
    }
    
    public function user_transaction_()
    { 
      $user = Sentinel::check();
      $data = \DB::table('transaction')->where('sender_id','=',$user->email)->where('generator','=','sender')->where('approval','=','completed')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_transaction',$this->arr_view_data);
    }


 public function user_transaction_daily()
    { 
      $user = Sentinel::check();
      $data = \DB::table('transaction')->where('reciver_id','=',$user->email)->where('activity_reason','=','daily')->orderBy('created_at','ASC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_transaction_daily',$this->arr_view_data);
    }

public function user_transaction_daily_admin()
    { 
      $user = Sentinel::check();
      $data = \DB::table('transaction')->where('activity_reason','=','daily')->orderBy('created_at','ASC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_transaction_daily',$this->arr_view_data);
    }

     public function link_send()
    { 

      $sender = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')
      ->where('transaction.reciver_id','=','')
      ->where('transaction.approval','<>','failed')
      ->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.is_active as user_is_active','transaction.date','transaction.approval','transaction.activity_reason','transaction.amount')
      ->orderBy('transaction.id','DESC')
      ->get();

$data = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')
      ->where('transaction.reciver_id','<>','')->where('transaction.generator','<>','sender')
      ->where('transaction.approval','<>','completed')->where('transaction.sender_id','<>','')->where('transaction.approval','<>','failed')
      ->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.amount')
      ->orderBy('transaction.id','DESC')
      ->get();



     /* $sender = \DB::table('transaction')->where('reciver_id','=','')->where('approval','<>','failed')->orderBy('email','DESC')->get();*/
      
      
      $reciever = \DB::table('transaction')->where('sender_id','=','')->where('activity_reason','<>','level')->orderBy('activity_reason','DESC')->get();

      $this->arr_view_data['reciever'] = $reciever;
      $this->arr_view_data['sender'] = $sender;
      return view('admin.admin_user.link_send',$this->arr_view_data);
    }

 public function reclaim_payment()
    {
      $arr_user_data = [];
      $arr_user_data['approval'] = 'payment_done';
      $arr_user_data['sender_id'] = "";
      
      $arr_sender_data['reciver_id']="";
      $arr_sender_data['approval'] = 'failed';
     
      $transaction = \DB::table('transaction')->where(['id'=>$_GET['id']])->first();

      
      
      \DB::table('transaction')->where(['id'=>$_GET['id']])->update($arr_user_data);
      
      //custome
      $transaction1 = \DB::table('transaction')->where(['opposit_id'=>$transaction->id])->limit(1)->update($arr_sender_data);
      
      
     

      Session::flash('success', 'Applied for reclaim');       
     return redirect()->back();
 echo 'success';
    }



    public function apply_link(Request $request)
    {
       $arr_user_data = [];
       $reciver = $request->input('reciver');
       $sender  = $request->input('sender');
       //dd($sender);
       $reciver_data  = \DB::table('transaction')->where('id','=',$reciver)->first();
       $sender_data  = \DB::table('transaction')->where('id','=',$sender)->first();
      // dd($sender_data);
       \DB::table('transaction')->where(['id'=>$sender])->update(['reciver_id'=>$reciver_data->reciver_id,'opposit_id'=>$reciver_data->id]);
       \DB::table('transaction')->where(['id'=>$reciver])->update(['sender_id'=>$sender_data->sender_id,'opposit_id'=>$sender_data->id]);
       //\DB::table('transaction')->where(['id'=>$reciver])->delete();

       Session::flash('success', 'Link Sent successfully.');
       $data = [];
       $data['status'] = "true";
       return $data;
    }

   public function work_income()
    { 
      $user = Sentinel::check();
    
      $data = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')->where('transaction.reciver_id','<>','')->where('transaction.generator','<>','sender')->where('transaction.approval','<>','completed')->where('transaction.sender_id','<>','')->where('transaction.approval','<>','failed')->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount')->orderBy('transaction.id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.work_income',$this->arr_view_data);
    }
    
     public function user_level_income()
    { 
      $user = Sentinel::check();
    
      $data = \DB::table('transaction')
      ->join('users', 'transaction.reciver_id', '=', 'users.email')->where('transaction.reciver_id','<>','')->where('transaction.generator','=','system')->where('transaction.approval','<>','failed')->where('transaction.activity_reason','<>','level_referal')->where('transaction.reciver_id','=',$user->email)->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount','transaction.level_id','transaction.plan_amt','transaction.percentage','transaction.level')->orderBy('transaction.id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_level_income',$this->arr_view_data);
    }


     public function withdrawl_request()
    { 
      $data = \DB::table('transaction')->where('activity_reason','=','withdrawl')->where('approval','=','payment_done')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.withdrawl_request',$this->arr_view_data);
    }

    public function withdrawl_history()
    { 
      $data = \DB::table('transaction')->where('activity_reason','=','withdrawl')->where('approval','=','completed')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.withdrawl_history',$this->arr_view_data);
    }




    public function referal_bonus_income()
    { 
      $user = Sentinel::check();
    
      /*$data = \DB::table('transaction')
      ->join('users', 'transaction.reciver_id', '=', 'users.email')->where('transaction.reciver_id','<>','')->where('transaction.generator','=','system')->where('transaction.approval','<>','failed')->where('transaction.activity_reason','<>','level_referal')->where('transaction.reciver_id','=',$user->email)->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount','transaction.level_id')->orderBy('transaction.id','DESC')->get();

      $this->arr_view_data['data'] = $data;*/
      return view('admin.admin_user.referal_bonus_income',$this->arr_view_data);
    }

     public function payment_sent()
    {
       $user = Sentinel::check();
       $transaction_id = $_GET['id'];
      

        $arr_transaction                    = [];
        $arr_transaction['approval']      = 'completed';
        

        $user_team= \DB::table('transaction')->where('id','=',$transaction_id)->update($arr_transaction);
        Session::flash('success', 'Withdrawal request mark to completed');       
        return redirect()->back();
    }


    /*public function payment_sent()
    {
      $arr_user_data = [];
      $arr_user_data['approval'] = 'payment_done';
      \DB::table('transaction')->where(['id'=>$_GET['id']])->update($arr_user_data);

      Session::flash('success', 'Payment Sent to User');       
     return redirect()->back();
    }*/


    public function level_income()
    { 
      $user = Sentinel::check();
    
      $data = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')->where('transaction.reciver_id','<>','')->where('transaction.generator','=','system')->where('transaction.approval','<>','completed')->where('transaction.sender_id','<>','')->where('transaction.approval','<>','failed')->where('transaction.approval','<>','payment_done')->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount')->orderBy('transaction.id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.level_income',$this->arr_view_data);
    }

    public function support()
    { 
      $data = \DB::table('support')->orderBy('id','DESC')->get();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.support',$this->arr_view_data);
    }

    public function change_password()
    { 
      return view('admin.admin_user.change_password',$this->arr_view_data);
    }

    public function process_change_pass(Request $request)
    {
      $validator        = Validator::make($request->all(), [
      'old_pass'        => 'required',
      'password'        => 'required',
      'cpassword'       => 'required',
        ]);
      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/change_password')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }

      $user = Sentinel::check();
        
      $credentials = array();
      $password = trim($request->input('old_pass'));
      $credentials['email']    = $user->email;        
      $credentials['password'] = $password;

      if (Sentinel::validateCredentials($user,$credentials)) 
      { 
        $new_credentials = [];
        $new_credentials['password'] = $request->input('password');

        if(Sentinel::update($user,$new_credentials))
        {
          Session::flash('success', 'Password changed successfully.');
        }
        else
        {
          Session::flash('error', 'Problem occured, while changing password.');
        }          
      } 
      else
      {
        Session::flash('error', 'Your current password is invalid.');          
      }       
      
      return redirect()->back(); 
    }

    public function change_trans_password()
    { 
      return view('admin.admin_user.change_trans_password',$this->arr_view_data);
    }

    public function process_change_trans_password(Request $request)
    {
      $validator        = Validator::make($request->all(), [
      'old_pass'        => 'required',
      'password'        => 'required',
      'cpassword'       => 'required',
        ]);
      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/process_change_trans_password')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }

      $user = Sentinel::check();
        
      $password = trim($request->input('old_pass'));

      if ($user->transaction_pin==$password) 
      { 
        $new_credentials = [];
        $new_credentials['transaction_pin'] = $request->input('password');
        $status = \DB::table('users')->where(['email'=>$user->email])->update($new_credentials);
        if($status)
        {
          Session::flash('success', 'Transaction pin changed successfully.');
        }
        else
        {
          Session::flash('error', 'Problem occured, while transaction pin.');
        }          
      } 
      else
      {
        Session::flash('error', 'Your current transaction pin is invalid.');          
      }       
      
      return redirect()->back(); 
    }

    public function edit()
    {
      $data = \DB::table('users')->where(['id'=>$_GET['id']])->orderBy('id','DESC')->first();
      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.edit',$this->arr_view_data);
    }


 public function force_active()
    {

     $arr_user_data                    = [];
    /*$arr_user_data['join_count']       = "8";*/
    $arr_user_data['joining_date']           = date('Y-m-d');
    $arr_user_data['is_active']           = "2";

      $data = \DB::table('users')->where(['id'=>$_GET['id']])->update($arr_user_data);
      
      return redirect()->back(); 
    }

    public function update_user(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_name'   => 'required',
            'email'     => 'required',
            'spencer_id'  => 'required',
            'mobile'      => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/user_list')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }
      $count = $this->UserModel->where(['email' =>$request->input('email')])->count();
      if(!$count) 
      {
        Session::flash('error', 'Sponcer id does not exist.');       
        return redirect()->back();  
      }
   
      $arr_user_data                    = [];
      $arr_user_data['user_name']       = $request->input('user_name');
      //$arr_user_data['email']           = $request->input('user_id');
      //$arr_user_data['spencer_id']      = $request->input('sponcer_id');
      //$arr_user_data['spencer_id']      = $request->input('sponcer_id');
      $arr_user_data['mobile']          = $request->input('mobile');
      $arr_user_data['branch']          = $request->input('branch');
$arr_user_data['banck_name']          = $request->input('bank');
      $arr_user_data['ifsc']            = $request->input('ifsc');
      $arr_user_data['bank_account_no'] = $request->input('bank_account_no');
      $arr_user_data['paytm']           = $request->input('paytm');
      $arr_user_data['phonepe']         = $request->input('phonepe');
      $arr_user_data['tez']             = $request->input('tez');
      $arr_user_data['bhim_upi']        = $request->input('bhim_upi');

      $this->UserModel->where(['email' =>$request->input('email')])->update($arr_user_data);
      Session::flash('success', 'User updated successfully.');      
      return redirect()->back();
    }
    
    public function profile_edit()
    {
         $user = Sentinel::check();
      $data = \DB::table('users')->where(['email'=>$user->email])->orderBy('id','DESC')->first();
      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.profile_edit',$this->arr_view_data);
    }

    public function update_user_profile(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_name'   => 'required',
            'email'     => 'required',
            'spencer_id'  => 'required',
            'mobile'      => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/profile_edit')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }
      
   
      $arr_user_data                    = [];
      //$arr_user_data['user_name']       = $request->input('user_name');
      //$arr_user_data['email']           = $request->input('user_id');
      //$arr_user_data['spencer_id']      = $request->input('sponcer_id');
      $arr_user_data['mobile']          = $request->input('mobile');
       $arr_user_data['ifsc']            = $request->input('ifsc');
      /*$arr_user_data['branch']          = $request->input('branch');
      $arr_user_data['ifsc']            = $request->input('ifsc');
      $arr_user_data['bank_account_no'] = $request->input('bank_account_no');
      $arr_user_data['paytm']           = $request->input('paytm');
      $arr_user_data['phonepe']         = $request->input('phonepe');
      $arr_user_data['tez']             = $request->input('tez');
      $arr_user_data['bhim_upi']        = $request->input('bhim_upi');*/
     $user = Sentinel::check();
      $this->UserModel->where(['id' =>$user->id])->update($arr_user_data);
      Session::flash('success', 'Profile updated successfully.');      
      return redirect()->back();
    }
    
    
    public function bank_edit()
    {
         $user = Sentinel::check();
      $data = \DB::table('users')->where(['email'=>$user->email])->orderBy('id','DESC')->first();
      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.bank_edit',$this->arr_view_data);
    }

    public function update_user_bank(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'branch'   => 'required',
            'ifsc'     => 'required',
            'bank_account_no'  => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/bank_edit')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }
     
   
      $arr_user_data                    = [];
      //$arr_user_data['user_name']       = $request->input('user_name');
      //$arr_user_data['email']           = $request->input('user_id');
      /*$arr_user_data['spencer_id']      = $request->input('sponcer_id');
      $arr_user_data['spencer_id']      = $request->input('sponcer_id');
      $arr_user_data['mobile']          = $request->input('mobile');*/

      $arr_user_data['banck_name']      = $request->input('banck_name');
      $arr_user_data['branch']          = $request->input('branch');
      $arr_user_data['ifsc']            = $request->input('ifsc');
      $arr_user_data['bank_account_no'] = $request->input('bank_account_no');
      $arr_user_data['paytm']           = $request->input('paytm');
      $arr_user_data['phonepe']         = $request->input('phonepe');
      $arr_user_data['tez']             = $request->input('tez');
      $arr_user_data['bhim_upi']        = $request->input('bhim_upi');
        $user = Sentinel::check();
      $this->UserModel->where(['id' =>$user->id])->update($arr_user_data);
      Session::flash('success', 'Bank details updated successfully.');      
      return redirect()->back();
    }
    
    public function btc_change()
    {
      
      $this->arr_view_data['data'] = [];
      return view('admin.admin_user.change_btc',$this->arr_view_data);
    }  
    
    public function change_btc(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'btc'   => 'required',
            
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/btc_change')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }
       $arr_user_data                    = [];
       $arr_user_data['ifsc']      = $request->input('btc');
       $user = Sentinel::check();
      $this->UserModel->where(['id' =>$user->id])->update($arr_user_data);
      Session::flash('success', 'BTC Address updated successfully.');      
      return redirect()->back();
    }

    public function view()
    {
      $data = \DB::table('users')->where(['email'=>$_GET['id']])->orderBy('id','DESC')->first();
      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.view',$this->arr_view_data);
    }  

    public function viewbyreciever()
    {
        $data = \DB::table('users')->where(['email'=>$_GET['id']])->orderBy('id','DESC')->first();
      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.view',$this->arr_view_data);
    }

    public function user_view()
    {
      $data = \DB::table('users')->where(['email'=>$_GET['id']])->orderBy('id','DESC')->first();
  
      $this->arr_view_data['data'] = $data;
      return view('admin.customer_user.view',$this->arr_view_data);
    }    

    public function status_change()
    {
      $arr_user_data = [];
      $usermodel = $this->UserModel->where(['id'=>$_GET['id']])->first();
      if($usermodel->is_active==1)
      {
        $arr_user_data['is_active'] = 2;
        $this->UserModel->where(['id'=>$_GET['id']])->update($arr_user_data);
      }
      else
      {
        $arr_user_data['is_active'] = 1;
        $this->UserModel->where(['id'=>$_GET['id']])->update($arr_user_data);
      }
      Session::flash('success', 'Status has been changed');       
      return redirect()->back();
    }

    public function accept_payment()
    {
      $arr_user_data = [];
      $arr_user_data['approval'] = 'completed';
       $transaction = \DB::table('transaction')->where(['id'=>$_GET['id']])->first();
       
       
       if($transaction->approval != 'completed')
       {
      \DB::table('transaction')->where(['id'=>$_GET['id']])->update($arr_user_data);
      $transaction = \DB::table('transaction')->where(['id'=>$_GET['id']])->first();
      

      //custome
      $transaction1 = \DB::table('transaction')->where(['opposit_id'=>$transaction->id])->limit(1)->update($arr_user_data);
     
      $count = $this->UserModel->where(['email'=>$transaction->sender_id])->first();
      $increment_count = $count['join_count'];
      $increment_count++;
      $this->UserModel->where(['email'=>$transaction->sender_id])->update(['join_count'=>$increment_count]);


      $count = $this->UserModel->where(['email'=>$transaction->sender_id])->first();


      $plan = \DB::table('plans')->where(['plan_amount'=>$count->plan])->first();
     
     

      if($count['join_count']==$plan->active_count)
      {
        $count = $this->UserModel->where(['email'=>$transaction->sender_id])->update(['joining_date'=>date('Y-m-d'),'is_active'=>"2"]);
        $date= date('Y-m-d');
        
      }

       }
      

      Session::flash('success', 'Payment Accepted');       
      $user = Sentinel::check();
      
   return redirect()->back();
      

    }


     public function withdrawl()
    { 
      $wallet_details=$this->wallet_balance();
      $this->arr_view_data                    = [];
      $this->arr_view_data['wallet_details']      = $wallet_details;
      return view('admin.customer_user.withdrawl',$this->arr_view_data);
    }


    public function withdrawal_payment()
    {
        $user = Sentinel::check();
        $arr_transaction                    = [];
        $arr_transaction['reciver_id']      = $user->email;
        $arr_transaction['sender_id']       = '';
        $arr_transaction['amount']          = $_GET['withdrawl_amt'];
        $arr_transaction['activity_reason'] = 'withdrawl';
        $arr_transaction['date']            = date('y-m-d');
        $arr_transaction['approval']        = 'payment_done';
        $arr_transaction['generator']        = 'reciever';
        
      
          \DB::table('transaction')->insert($arr_transaction);
      





         
          Session::flash('success', 'Payment Withdrawal Request Sent.');       
          return redirect()->back();
       
   
      
    }

     public function submit_support_enquiry(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_name'       => 'required',
            'mobile'        => 'required',
            'message'     => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/registration')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }

        $user  = Sentinel::check();
      $arr_support                    = [];
      $arr_support['title']       = $request->input('user_name');
       $arr_support['user_name']       =  $user->email;
      $arr_support['mobile']          = $request->input('mobile');
      $arr_support['message']         = $request->input('message');
      \DB::table('support')->insert($arr_support);
      
      Session::flash('success', 'Message Sent Successfully.');
      return redirect('admin/u_support');
    }

    public function level_view()
  {
    $arr_data         = [];
    $arr_team_data    = [];
    $user_status      = Sentinel::check();
    if($user_status)
    {
      $data = $this->UserModel->where(['spencer_id'=>$user_status->email])->get();
      if(!empty($data))
      {
        $data_1 = $data->toArray();
      }
      $push_arr = [];
      $level    = 0;
      if(!empty($data_1))
      {
        foreach ($data_1 as $key => $value) 
        {
          $temp_arr = [];
          $temp_arr['id']                   = $value['id'];
          $temp_arr['spencer_name']         = $value['spencer_name'];
          $temp_arr['email']                = $value['email'];
          $temp_arr['is_active']                = $value['is_active'];
          $temp_arr['user_name']            = $value['user_name'];
          $temp_arr['level']                = $level+1;
          array_push($push_arr, $temp_arr);
          $data_2 = $this->UserModel->where(['spencer_id'=>$value['email']])->get();
          if(!empty($data_2))
          {
            $data_2 = $data_2->toArray();
            
            if(!empty($data_2))
            { 
              foreach ($data_2 as $key1 => $value1) 
              {
                $temp_arr = [];
                $temp_arr['id']                   = $value1['id'];
                $temp_arr['spencer_name']         = $value1['spencer_name'];
                $temp_arr['email']                = $value1['email'];
                $temp_arr['is_active']                = $value['is_active'];
                $temp_arr['user_name']            = $value1['user_name'];
                $temp_arr['level']                = $level+2;
                array_push($push_arr, $temp_arr);
                $data_3 = $this->UserModel->where(['spencer_id'=>$value1['email']])->get();
                if(!empty($data_3))
                {
                  $data_3 = $data_3->toArray();
                  
                  if(!empty($data_3))
                  { 
                    foreach ($data_3 as $key1 => $value2) 
                    {
                      $temp_arr = [];
                      $temp_arr['id']                   = $value2['id'];
                      $temp_arr['spencer_name']         = $value2['spencer_name'];
                      $temp_arr['email']                = $value2['email'];
                      $temp_arr['user_name']            = $value2['user_name'];
                      $temp_arr['level']                = $level+3;
                      $temp_arr['is_active']                = $value['is_active'];
                      array_push($push_arr, $temp_arr);
                      $data_4 = $this->UserModel->where(['spencer_id'=>$value2['email']])->get();
                      if(!empty($data_4))
                      {
                        $data_4 = $data_4->toArray();
                        
                        if(!empty($data_4))
                        { 
                          foreach ($data_4 as $key1 => $value3) 
                          {
                            $temp_arr = [];
                            $temp_arr['id']                   = $value3['id'];
                            $temp_arr['is_active']                = $value['is_active'];
                            $temp_arr['spencer_name']         = $value3['spencer_name'];
                            $temp_arr['email']                = $value3['email'];
                            $temp_arr['user_name']            = $value3['user_name'];
                            $temp_arr['level']                = $level+4;
                            array_push($push_arr, $temp_arr);
                            $data_5 = $this->UserModel->where(['spencer_id'=>$value3['email']])->get();
                            if(!empty($data_5))
                            {
                              $data_5 = $data_5->toArray();
                              
                              if(!empty($data_5))
                              { 
                                foreach ($data_5 as $key1 => $value4) 
                                {
                                  $temp_arr = [];
                                  $temp_arr['id']                   = $value4['id'];
                                  $temp_arr['is_active']                = $value['is_active'];
                                  $temp_arr['spencer_name']         = $value4['spencer_name'];
                                  $temp_arr['email']                = $value4['email'];
                                  $temp_arr['user_name']            = $value4['user_name'];
                                  $temp_arr['level']                = $level+5;
                                  array_push($push_arr, $temp_arr);
                                  $data_6 = $this->UserModel->where(['spencer_id'=>$value4['email']])->get();
                                  if(!empty($data_6))
                                  {
                                    $data_6 = $data_6->toArray();
                                    
                                    if(!empty($data_6))
                                    { 
                                      foreach ($data_6 as $key1 => $value5) 
                                      {
                                        $temp_arr = [];
                                        $temp_arr['id']                   = $value5['id'];
                                        $temp_arr['spencer_name']         = $value5['spencer_name'];
                                        $temp_arr['is_active']                = $value['is_active'];
                                        $temp_arr['email']                = $value5['email'];
                                        $temp_arr['user_name']            = $value5['user_name'];
                                        $temp_arr['level']                = $level+6;
                                        array_push($push_arr, $temp_arr);
                                        $data_7 = $this->UserModel->where(['spencer_id'=>$value5['email']])->get();
                                        if(!empty($data_7))
                                        {
                                          $data_7 = $data_7->toArray();
                                          
                                          if(!empty($data_7))
                                          { 
                                            foreach ($data_7 as $key1 => $value6) 
                                            {
                                              $temp_arr = [];
                                              $temp_arr['id']                   = $value6['id'];
                                              $temp_arr['spencer_name']         = $value6['spencer_name'];
                                              $temp_arr['email']                = $value6['email'];
                                              $temp_arr['is_active']                = $value['is_active'];
                                              $temp_arr['user_name']            = $value6['user_name'];
                                              $temp_arr['level']                = $level+7;
                                              array_push($push_arr, $temp_arr);
                                            }
                                          }
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
array_multisort($push_arr);
//dd($push_arr);

    $this->arr_view_data['data']             = $push_arr;
    
    return view('admin.admin_user.self_team',$this->arr_view_data);
  }

  function get_parent_data_level($arr_data,$count_index)
  {
    $data1  = [];
    $data   = $this->built_array_level($arr_data,$count_index);
    $count  = count($data);
    if($count>0)
    {
      if(!empty($data))
      {
        foreach ($data as $key => $value) 
        {
          $child_data = $this->get_child_data_level($value,$count);
          $data1      = $this->built_array_level($child_data,$count_index+$count+$key-1);
          $data       = array_merge($data, $data1);
        }
      }
    }
    return $data;
  }

  function get_child_data_level($arr_data_,$previous_count)
  {
    $arr_data  = $child_data = [];
    $count     = 0;
    $data      = $this->UserModel->where(['spencer_id'=>$arr_data_['email']])->get();
    $count     = count($data);
    if($count>=0)
    {
      if(!empty($data))
      {
        $arr_data = $data->toArray();
        if(!empty($arr_data))
        {
          $child_data = $this->get_parent_data_level($arr_data,$count+$previous_count);
          return $child_data;
        }
        else
        {
          return [];
        }
      }
      else
      {
        return [];
      }
    }
    else
    {
      return [];
    }
  }

  function built_array_level($arr_data,$level)
  {
    $temp_arr = [];
    $arr_team_data = [];
    if(!empty($arr_data))
    {
      foreach ($arr_data as $key => $value) 
      {
        $temp_arr['id']                   = $value['id'];
        $temp_arr['spencer_name']         = $value['spencer_name'];
        $temp_arr['email']                = $value['email'];
        $temp_arr['user_name']            = $value['user_name'];
       /* $temp_arr['package']              = $value['package'];
        $temp_arr['joining_date']         = $value['joining_date'];
        $temp_arr['status']               = $value['status'];*/
        $temp_arr['level']                = $level;
        $arr_team_data[$key] = $temp_arr;
      }
    }

    return $arr_team_data;
  }
  
  public function level_tree()
  {
      $user_id = $_GET['id'];
      $data = $this->UserModel->where(['spencer_id'=>$user_id])->get();
      $data1 = $this->UserModel->where(['spencer_id'=>$user_id])->count();
      $user = $this->UserModel->where(['email'=>$user_id])->first();
      $result = $data->toArray();
      $this->arr_view_data['data']           = $result;
      $this->arr_view_data['root_user']      = $user_id;
      $this->arr_view_data['user']      = $user;
       $this->arr_view_data['data1']      = $data1;

    return view('admin.admin_user.level_tree',$this->arr_view_data);
  }

  public function check_pin()
  {
      $pin    = $_GET['pin'];
      $email  = $_GET['email'];
      $data = $this->UserModel->where(['email'=>$email,'transaction_pin'=>$pin])->count();
      if($data)
      {
        echo "true";
      }
      else
      {
        echo "false";
      }
  }
  
  public function generate_link()
  {
      $link = $_GET['link'];
     
      if($link!="")
      {
        for ($i=0; $i < $link ; $i++) 
        { 
        $arr_transaction                    = [];
        $arr_transaction['reciver_id']      = '';
        $arr_transaction['sender_id']       = $_GET['email'];
        $arr_transaction['amount']          = 1000;
        $arr_transaction['activity_reason'] = 'Extra';
        $arr_transaction['date']            = date('Y-m-d');
        $arr_transaction['approval']        = 'payment_done';
        $arr_transaction['generator']        = 'sender';

        \DB::table('transaction')->insert($arr_transaction);
        }   
         Session::flash('success', 'Link has been generated.');
         echo "true";
      }
      else
      {
           echo "false";
      }
  }

 public function view1()
    {
      $data = \DB::table('users')->where(['id'=>$_GET['id']])->orderBy('id','DESC')->first();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.view1',$this->arr_view_data);
    }  
  
  public function generate_link_r()
  {
      $link = $_GET['link'];
     
      if($link!="")
      {
        for ($i=0; $i < $link ; $i++) 
        { 
        $arr_transaction                    = [];
        $arr_transaction['sender_id']       = '';
        $arr_transaction['reciver_id']      = $_GET['email'];
        $arr_transaction['amount']          = 1000;
        $arr_transaction['activity_reason'] = 'Extra';
        $arr_transaction['date']            = date('Y-m-d');
        $arr_transaction['approval']        = 'payment_done';
         $arr_transaction['generator']        = 'reciever';

        \DB::table('transaction')->insert($arr_transaction);
        }   
         Session::flash('success', 'Link has been generated.');
         echo "true";
      }
      else
      {
           echo "false";
      }
  }


 public function user_mobile()
    { 
      $data = \DB::table('users')->distinct()->get(['mobile']);

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.user_mobile',$this->arr_view_data);
    }

public function news_feed()
    {
      $data = \DB::table('newsfeed')->where('id','=','1')->first();

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.news_feed',$this->arr_view_data);
    }

public function update_newsfeed(Request $request)
    {
     $news_feed= $request->input('news');
      $data = \DB::table('newsfeed')->where('id','=','1')->update(['news_feed'=>$news_feed]);
      $this->arr_view_data['data'] = $data;
Session::flash('success', 'News updated succesfully');       
     return redirect()->back();
      
    }


public function process_send_msg(Request $request)
    {
       
      $msg= $request->input('msg');
$data = \DB::table('users')->distinct()->get(['mobile']);

 
    $data_setting = \DB::table('site_setting')->where('id','=','1')->first();
   

foreach ($data as $key => $value) 
{
        $url='http://sms.ukvalley.com/api/sendhttp.php?authkey=29023AD88loX1g5c247ecd&mobiles='.$value->mobile.'&message='.$msg.'&sender='.$data_setting->sms_sender_id.'&route=6';
        $ch = curl_init();
        curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        ));
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        $output = curl_exec($ch);

        if(curl_errno($ch))
        {
            echo 'error:' . curl_error($ch);
        }
 }     
                  
       Session::flash('success', 'Message will be sent in sometime');
      
      return redirect()->back(); 
    }
    
    
    public function create_daily_link()

{
    
     $count = $this->UserModel->where(['id'=>$_GET['id']])->first();


      $plan = \DB::table('plans')->where(['plan_amount'=>$count->plan])->first();
      
     
        $date= date('Y-m-d');
        for ($i=0; $i < $plan->no_of_links ; $i++) 
     {
        $arr_transaction                    = [];
        $arr_transaction['reciver_id']      = $count->email;
        $arr_transaction['sender_id']       = '';
        $arr_transaction['amount']          = $plan->withdrawl_amt;
        $arr_transaction['activity_reason'] = 'daily';
        $date                              =  date('Y-m-d', strtotime("+".$plan->next_link_time." hours", strtotime($date)));
        $arr_transaction['date']            =  $date;
        $arr_transaction['approval']        = 'payment_done';
        $arr_transaction['generator']        = 'reciever';

        \DB::table('transaction')->insert($arr_transaction);
     }
     
      Session::flash('success', 'Message will be sent in sometime');
      
      return redirect()->back(); 
      
}


public function create_return()
    {
      
      return view('admin.admin_user.create_returns',$this->arr_view_data);
    }

    public function add_return()
    {
      $date= $_POST['date'];
      $plan= $_POST['plan'];
      $return= $_POST['return'];

        $arr_transaction                    = [];
        $arr_transaction['date']      = $date;
        $arr_transaction['plan']       = $plan;
        $arr_transaction['returns']          = $return;
       
        \DB::table('returns')->insert($arr_transaction);

         Session::flash('success', 'Return created');
      
          return redirect()->back();

    }

    public function all_return()
    {
      $returns = \DB::table('returns')->get();
      $this->arr_view_data['returns'] = $returns;
       return view('admin.admin_user.all_return',$this->arr_view_data);

    }



//epin code  starts here

public function epin_generate()
    {
      
      return view('admin.admin_user.generate_epin',$this->arr_view_data);
    }

    

public function generate_epin(){

$user = Sentinel::check();

 $count= $_POST['quantity'];

 $issue_to_user =$_POST['issue_to'];

 
  $arr_user_data1 = [];
      $arr_user_data1['reciever'] = '';
      $arr_user_data1['sender'] =$user->email;
      $arr_user_data1['count'] =$count;
      $arr_user_data1['purpose'] ="generate";


for ($i=0; $i < $count ; $i++) 
     {

        $arr_transaction                    = [];
        $arr_transaction['epin_id']      = "RMH".mt_rand(10000000,99999999);
        $arr_transaction['used_by']       = '';
        $arr_transaction['usedfor']          = '';
        $arr_transaction['generated_by'] = $user->email;
        $arr_transaction['transfer_by']            = '';
        $arr_transaction['issue_to']      = $issue_to_user;
       

        \DB::table('epin')->insert($arr_transaction);
     }

       \DB::table('epin_metadata')->insert($arr_user_data1);

     Session::flash('success', 'Epin Generated');
      
     return redirect()->back(); 

}


public function generate_epin_for_user(){

$user = Sentinel::check();

 $count= $_POST['epin_quantity'];

 $issue_to_user =$_POST['issue_to'];

 
      $arr_user_data1 = [];
      $arr_user_data1['reciever'] = '';
      $arr_user_data1['sender'] =$user->email;
      $arr_user_data1['count'] =$count;
      $arr_user_data1['purpose'] ="generate";


for ($i=0; $i < $count ; $i++) 
     {

        $arr_transaction                    = [];
        $arr_transaction['epin_id']      = "RMH".mt_rand(10000000,99999999);
        $arr_transaction['used_by']       = '';
        $arr_transaction['usedfor']          = '';
        $arr_transaction['generated_by'] = $user->email;
        $arr_transaction['transfer_by']            = '';
        $arr_transaction['issue_to']      = $issue_to_user;
       

        \DB::table('epin')->insert($arr_transaction);
     }

       \DB::table('epin_metadata')->insert($arr_user_data1);


        $arr_transaction                    = [];
        $arr_transaction['reciver_id']      = $user->email;
        $arr_transaction['amount']          =  $count*2200;
        $arr_transaction['date']            = date('Y-m-d');
        $arr_transaction['generator']    = $user->email;
        $arr_transaction['activity_reason'] = 'epin';
        
         \DB::table('transaction')->insert($arr_transaction);


     Session::flash('success', 'Epin Generated');
      
     return redirect()->back(); 

}

public function transfer_epin()
    {
      $arr_view_data[]="";
      $user = Sentinel::check();

      $data = \DB::table('epin')->get();

      $this->arr_view_data['data'] = $data;
      $this->arr_view_data['user'] = $user;


      return view('admin.admin_user.transfer_epin',$this->arr_view_data);
    }


    public function epin_transfer()
    {

      $user = Sentinel::check();

      
      $epin_Transfer= $_POST['epin_Transfer'];
      $issue_to_user =$_POST['transfer_to'];


      $arr_user_data = [];
      $arr_user_data['issue_to'] = $issue_to_user;
      $arr_user_data['transfer_by'] =$user->email;
      
      $arr_user_data1 = [];
      $arr_user_data1['reciever'] = $issue_to_user;
      $arr_user_data1['sender'] =$user->email;
      $arr_user_data1['count'] =$epin_Transfer;
      $arr_user_data1['purpose'] ="transfer";
 

    for ($i=0; $i < $epin_Transfer ; $i++) 
     {
        
        \DB::table('epin')->where('issue_to','=',$user->email)->where('used_by','=','')->limit(1) ->update($arr_user_data);

     }

      \DB::table('epin_metadata')->insert($arr_user_data1);

     Session::flash('success', 'Epin Transfer');
      
     return redirect()->back(); 

    }

    public function epin_transaction(){

      $user = Sentinel::check();
     $epin_metadata= \DB::table('epin_metadata')->where('sender','=',$user->email)->orWhere('reciever', '=', $user->email)->get();
      $this->arr_view_data['$epin_metadata'] = $epin_metadata;


      return view('admin.admin_user.epin_transaction',$this->arr_view_data);
    }

     public function unused_pin(){

      $user = Sentinel::check();
     $epin_data= \DB::table('epin_metadata')->where('sender','=',$user->email)->orWhere('reciever', '=', $user->email)->get();
      $this->arr_view_data['$epin_metadata'] = $epin_data;


      return view('admin.admin_user.unused_pin',$this->arr_view_data);
    }


     public function activate_user_with_epin()
  
  {
      $e_pin    = $_GET['epin_id'];
      $user_email  = $_GET['user_id'];
      
      
      
       $data_ = \DB::table('users')->where('email','=',$_GET['user_id'])->where('is_active','!=','2')->first();
        if(empty($data_))
        {
            $data['status'] = "fail";
           // $data['name'] = $data_->user_name;
            
            echo "fail";
        }
       
        else
        {
      
     
        //update epin used details
        $arr_transaction                    = [];
        $arr_transaction['usedfor']      = 'registration';
        $arr_transaction['used_by']       = $user_email;
       \DB::table('epin')->where('id','=',$e_pin)->update($arr_transaction);

       //update user becomes active details in user table
        $arr_transaction                    = [];
        $arr_transaction['epin']      = $e_pin;
        $arr_transaction['topup_date']       = date('Y-m-d');
        $data = $this->UserModel->where('email','=',$user_email)->update($arr_transaction);


        //add user to autofill_user table with searching auto_sponcer id
       

        $arr_transaction                      = [];
        $arr_transaction['user_id']           = $user_email;
        $arr_transaction['count']             = '0';
        $arr_transaction['level']             = '1';

        \DB::table('autofill_user')->insert($arr_transaction);

        
        }

        echo "success";
        }
      
   
   //epin code ends here




        //dashboard conntroller code starts here

        public function growth_income()
        {

          $user = Sentinel::check();
         /* $data_plan = \DB::table('plans')->where('plan_amount','=','2000')->get();*/
          
          $packages = \DB::table('transaction')
          ->where('activity_reason','=','add_package')
          ->where('sender_id','=',$user->email)
          ->where('approval','=','completed')->get();
       
          $amount=0;
          $amount1=0;
          foreach ($packages as $key1 => $value1) 
          {
            $returns1 = \DB::table('returns')->where('plan','=',$value1->package)->get();
          
          foreach ($returns1 as $key => $value)
          {
    
              $amount=0;
              if(strtotime($value->date)>=strtotime($value1->date))
                  {
                      if($amount>=($value1->amount*2))
                      {
                        break;
                      }
                      else
                      {

                          $amount = $amount+(($value->returns/100)*$value1->amount);
                          $amount1= $amount+$amount1;

                      }
                  }



            }

            }

                   return $amount1; 

        }


        public function add_money(Request $request)
        {

        $user = Sentinel::check();
        $arr_transaction                    = [];
        $arr_transaction['sender_id']       = $user->email;
        $arr_transaction['amount']          = $request->input('amount');
        $arr_transaction['activity_reason'] = 'add_package';
        $arr_transaction['package']         = $request->input('package');
        $arr_transaction['btc']             = $request->input('btc');
        $arr_transaction['approval']        = 'payment_done';
        $arr_transaction['generator']       = 'sender';

        \DB::table('transaction')->insert($arr_transaction);


        Session::flash('success', 'Add Money Request Send');
      
        return redirect()->back(); 
        }




        public function accept_package()
    {
      $arr_user_data = [];
      $arr_user_data['approval'] = 'completed';
      $arr_user_data['date'] = date('Y-m-d');
       $trans = \DB::table('transaction')->where(['id'=>$_GET['id']])->first();
        $users = \DB::table('users')->where(['email'=>$trans->sender_id])->first();
       
       
       if($trans->approval != 'completed')
       {
     $trans1= \DB::table('transaction')->where(['id'=>$_GET['id']])->update($arr_user_data);
      
       $arr_data = [];
       $arr_data['is_active'] = '2';
       if($users->joining_date=='')
       {
       $arr_data['joining_date'] = date('Y-m-d');
       }
        \DB::table('users')->where(['email'=>$trans->sender_id])->update($arr_data);
      

       }
      

      Session::flash('success', 'Payment Accepted');       
      $user = Sentinel::check();
      
   return redirect()->back();
      

    }




     public function add_fund_request()
    { 
      $user = Sentinel::check();
    
      $data = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')
      ->where('transaction.generator','=','sender')
      ->where('transaction.approval','=','payment_done')
      ->where('transaction.activity_reason','=','add_package')
      ->where('transaction.sender_id','<>','')
      ->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount','transaction.btc')
      ->orderBy('transaction.id','DESC')->get();
      
      

      $this->arr_view_data['data'] = $data;
      return view('admin.admin_user.add_fund_request',$this->arr_view_data);
    }


     public function add_fund()
    { 
      
      
      return view('admin.admin_user.add_fund',$this->arr_view_data);
    }



        public function level_income_user()
        {


                 $user = Sentinel::check();
                 $tran_data = \DB::table('transaction')->join('users', 'transaction.level_id', '=', 'users.email')->where(['reciver_id'=>$user->email])->where(['transaction.generator'=>'system'])->where('transaction.activity_reason','=','level')->select('transaction.level_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount')->get();
                 
                 $amount=0;
                 
                 
                 foreach($tran_data as $key=>$value)
                 {
                     
               
                 if($value->is_active==2)
                  {
                    $amount+=$value->amount; 
                  }
                }
                

                 return $amount;

        }



        public function referal_bonus()
        {
         
                

                 $user = Sentinel::check();
                 $tran_data = \DB::table('transaction')->join('users', 'transaction.level_id', '=', 'users.email')->where(['reciver_id'=>$user->email])->where(['transaction.generator'=>'system'])->where('transaction.activity_reason','=','level_referal')->select('transaction.level_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount')->get();
                 
                 
                  $amount =0;
                
                  foreach($tran_data as $key=>$value)

                  {
                    if($value->is_active=='2')
                    {
                  $day = 200;  $counter = 0;
                  for ($i =1; $i <= 200; $i++)
                  {
                  

                  $counter++;
                  
                  $date = date('d-m-Y', strtotime($user->joining_date. ' + '.$counter.' day'));
                  

                  
                  if(strtotime($date)<=strtotime(date('d-m-Y')))
                  {
                   
                      $day = $day-1;
                      $amount = $amount+($user->amount*(0.5/100));
                     
                  }
                  
                
                }
                    }
                
                }
                return $amount;
                



        }


        public function total_fund()
        {
         $user = Sentinel::check();
          $transaction_add_fund = \DB::table('transaction')->where('activity_reason','=','add_package')
          ->where('approval','=','completed')
          ->where('sender_id','=',$user->email)
          ->get();
          $amount=0;
          foreach ($transaction_add_fund as $key => $value) {
            $amount=$amount+$value->amount;
          }

          return $amount;
        }


      public function wallet_balance()
      {
        
          $growth_income= $this->growth_income();
          $level_income= $this->level_income_user();
          $referal_income= $this->referal_bonus();
          $total_withdrawl=$this->total_withdrawl();
          $pending_withdrawl=$this->pending_withdrawl();
          $total_fund=        $this->total_fund();

          $wallet_amount= $growth_income+$level_income+$referal_income-$total_withdrawl;

        $arr_transaction                      = [];
        $arr_transaction['growth_income']     = $growth_income;
        $arr_transaction['level_income']      = $level_income;;
        $arr_transaction['referal_income']    = $referal_income;;
        $arr_transaction['total_withdrawl']   = $total_withdrawl;
        $arr_transaction['wallet_amount']     = $wallet_amount;
        $arr_transaction['pending_withdrawl'] = $pending_withdrawl;
        $arr_transaction['total_fund']        = $total_fund;


        return $arr_transaction;
      }



      public function total_withdrawl()
      {
        $user = Sentinel::check();
        $tran_data = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where(['generator'=>'reciever'])->where(['activity_reason'=>'withdrawl'])->get();
                 $amount=0;
                
                 
                 foreach($tran_data as $key=>$value)
                 {
                 $amount+=$value->amount;
                 
                 }
             if($user->is_active==2)
                 return $amount;

 }

 public function pending_withdrawl()
 {
                  $user = Sentinel::check();
                 $tran_data = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where(['generator'=>'reciever'])->where(['activity_reason'=>'withdrawl'])->where(['approval'=>'payment_done'])->get();
                 $amount=0;
                foreach($tran_data as $key=>$value)
                {

                     $amount+=$value->amount;
                }
                if($user->is_active==2)
                 return $amount;
                 
 }
                

}
