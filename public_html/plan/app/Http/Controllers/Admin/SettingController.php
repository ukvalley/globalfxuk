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
use App\Models\EmailTemplateModel;

class SettingController  extends Controller
{
    public $arr_view_data;
    public $admin_panel_slug;

    public function __construct(UserModel $user_model,
                               EmailTemplateModel $email_template_model)
    {
      $this->UserModel          = $user_model;
      $this->EmailTemplateModel = $email_template_model;
      $this->arr_view_data      = [];
      $this->admin_panel_slug   = config('app.project.admin_panel_slug');

    }

    public function bank_details()
    {
      $arr_data    = [];
      $user_status = Sentinel::check();
      if($user_status)
      {
        $data = $this->UserModel->where(['id'=>$user_status->id])->get();
        if(!empty($data))
        {
          $arr_data = $data->toArray();
        }
      }
      
      $this->arr_view_data['data']             = $arr_data;
      $this->arr_view_data['page_title']       = "bank_details";
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
    	return view('admin.setting.bank_details',$this->arr_view_data);
    }

    public function change_password()
    {
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title'] = "change_password";
      
      return view('admin.setting.change_password',$this->arr_view_data);
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

    public function store_bank_details(Request $request)
    {
      $validator         = Validator::make($request->all(), [
      'bank_name'        => 'required',
      'bank_holder_name' => 'required',
      'branch'           => 'required',
      'ifsc_code'        => 'required',
      'account_no'       => 'required',
   /*   'atm_card_no'      => 'required',
      'paytm_no'         => 'required',
      'btc_address'      => 'required',*/
        ]);


      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/bank_details')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }
      $user_status =  $user = Sentinel::check();

      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 6; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      
      if(isset($user_status->id) && !empty($user_status->id))
      {
        $arr_bank_data                     = [];
        $arr_bank_data['bank_name']        = base64_encode(base64_encode($request->input('bank_name')));
        $arr_bank_data['bank_holder_name'] = base64_encode(base64_encode($request->input('bank_holder_name')));
        $arr_bank_data['branch']           = base64_encode(base64_encode($request->input('branch')));
        $arr_bank_data['ifsc_code']        = base64_encode(base64_encode($request->input('ifsc_code')));
        $arr_bank_data['account_no']       = base64_encode(base64_encode($request->input('account_no')));
      /*  $arr_bank_data['atm_card_no']      = base64_encode(base64_encode($request->input('atm_card_no')));*/
        $arr_bank_data['paytm_no']         = base64_encode(base64_encode($request->input('paytm_no')));
        $arr_bank_data['btc_address']      = base64_encode(base64_encode($request->input('btc_address')));
        $arr_bank_data['otp']              = $randomString;
        $arr_bank_data['bank_active']      = "0";

        $this->UserModel->where(['id'=>$user_status->id])->update($arr_bank_data);

        Session::flash('success', 'OTP sent successfully. Please verify your bank details with OTP.');
        $mobileno = $user_status->mobile;
        $msg="Your otp is ".$randomString." \nPlease do not share your OTP with anyone.";
         if(strlen($mobileno)>10)
         {
           $keycount=strlen($mobileno)-10;
           
           $mobileno = substr($mobileno,$keycount);
         }

         $url='http://sms.ukvalley.com/api/sendhttp.php?authkey='.config("app.project.auth").'&mobiles=91'.$mobileno.'&message='.urlencode($msg).'&sender=LIFETM&route=6&country=0';
         $ch = curl_init();
         curl_setopt( $ch,CURLOPT_URL, $url);
         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
         $result = curl_exec($ch );
         
         curl_close( $ch );
      }
      
      return redirect('admin/bank_details_otp');
    }

    public function bank_details_otp()
    {
      $this->arr_view_data['admin_panel_slug'] = $this->admin_panel_slug;
      $this->arr_view_data['page_title'] = "bank_details_otp";
      
      return view('admin.setting.bank_details_otp',$this->arr_view_data);
    }

    public function activate_bank_details(Request $request)
    {
      $validator         = Validator::make($request->all(), [
      'otp'        => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/bank_details_otp')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }

      $user_status =  $user = Sentinel::check();
    
      if($user_status->otp==$request->input('otp'))
      {
        if(isset($user_status->id) && !empty($user_status->id))
        {
          $arr_bank_data                     = [];
          $arr_bank_data['bank_active']      = "1";

          $this->UserModel->where(['id'=>$user_status->id])->update($arr_bank_data);
          Session::flash('success', 'Bank details updated successfully.');
        }
      }
      else
      {
        Session::flash('error', 'Please enter valid OTP.');
        return redirect('admin/bank_details_otp');
      }
      
      return redirect('admin/bank_details');
    }

    public function resend_otp(Request $request)
    {
      $user_status =  $user = Sentinel::check();

      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 6; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      
      if(isset($user_status->id) && !empty($user_status->id))
      {
        $arr_bank_data                     = [];
        $arr_bank_data['otp']              = $randomString;

        $this->UserModel->where(['id'=>$user_status->id])->update($arr_bank_data);

        Session::flash('success', 'OTP sent successfully.');
        $mobileno = $user_status->mobile;
        $msg="Your otp is ".$randomString." \nPlease do not share your OTP with anyone.";
         if(strlen($mobileno)>10)
         {
           $keycount=strlen($mobileno)-10;
           
           $mobileno = substr($mobileno,$keycount);
         }

         $url='http://sms.ukvalley.com/api/sendhttp.php?authkey='.config("app.project.auth").'&mobiles=91'.$mobileno.'&message='.urlencode($msg).'&sender=LIFETM&route=6&country=0';
         $ch = curl_init();
         curl_setopt( $ch,CURLOPT_URL, $url);
         curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
         curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
         $result = curl_exec($ch );
         
         curl_close( $ch );
      }
      
      return redirect('admin/bank_details_otp');
    }
}
