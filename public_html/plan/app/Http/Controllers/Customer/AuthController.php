<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use URL;
use Mail;
use Session;
use Sentinel;
use Validator;
use App\Models\UserModel;
use App\Models\TransactionModel;
use App\Models\EmailTemplateModel;

class AuthController extends Controller
{
    public $arr_view_data;
    public $customer_panel_slug;

    public function __construct(UserModel $user_model,
                                TransactionModel $TransactionModel,
                                EmailTemplateModel $email_template_model)
    {
      $this->UserModel          = $user_model;
      $this->EmailTemplateModel = $email_template_model;
      $this->TransactionModel   = $TransactionModel;
      $this->arr_view_data      = [];
      $this->customer_panel_slug   = config('app.project.customer_panel_slug');

    }
    

    public function login()
    {
      $this->arr_view_data['customer_panel_slug'] = $this->customer_panel_slug;
      $this->arr_view_data['page_title'] = "Login";
      
    	return view('customer.login',$this->arr_view_data);
    }

    public function login_process(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username'  => 'required|max:255',
            'password'  => 'required',
        ]);

        if ($validator->fails()) 
        {
            return redirect(config('app.project.customer_panel_slug').'/login')
                        ->withErrors($validator)
                        ->withInput($request->all());
        }
       
        if(isset($_POST["remember_me"]))
        {
          if($_POST["remember_me"]=='on')
          {
            $hour = time() + 3600 * 24 * 30;
            setcookie('username',$request->input('username'), $hour);
            setcookie('password',$request->input('password'), $hour);
          }
        }
        
        $credentials = [
            'email'=> $request->input('username'),
            'password' => $request->input('password'),
        ];

        $check_authentication = Sentinel::authenticate($credentials);

        if($check_authentication)
        {
          if($check_authentication->is_active=='1')
          {
            return redirect('customer/dashboard');
          }
          else
          {
            Sentinel::logout();
            Session::flash('error', 'Your account has been blockd by admin.');
            return redirect('customer');
          }
          return redirect('customer/dashboard');
        }
        else
        {
          Session::flash('error', 'Invalid Login Credentials.');
        } 
      Sentinel::logout();
      return redirect('customer');
    }

    public function dashboard()
    {
      $this->arr_view_data['customer_panel_slug'] = $this->customer_panel_slug;
      $this->arr_view_data['page_title']       = "Login";
      
      return view('customer.dashboard',$this->arr_view_data);
    }

    public function registration()
    {
      $this->arr_view_data['customer_panel_slug'] = $this->customer_panel_slug;
      $this->arr_view_data['page_title']       = "Login";
      
      return view('customer.register',$this->arr_view_data);
    }

    public function registration_process(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'user_id'        => 'required',
            'username'       => 'required',
            'spencer_id'     => 'required',
            'spencer_name'   => 'required',
            'mobile'         => 'required',
            'mobile'         => 'required',
            'password'       => 'required',
            'package'        => 'required',
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.admin_panel_slug').'/new_joining')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }

      $arr_data                 = [];
      $arr_data['user_name']    = $request->input('username');
      $arr_data['mobile']       = $request->input('mobile');
      $arr_data['email']        = trim($request->input('user_id'));
      $arr_data['spencer_id']   = $request->input('spencer_id');
      $arr_data['package']      = $request->input('package');
      $arr_data['spencer_name'] = $request->input('spencer_name');
      $arr_data['password']     = $request->input('password');
      $arr_data['is_active']    = 1;

      $validate = $this->UserModel->where(['email'=>$arr_data['email']])->count();
      if($validate)
      {
        Session::flash('error', 'User id already exist.');
        return redirect('admin/new_joining');
      }

      $user_status = Sentinel::registerAndActivate($arr_data);
     
      if(isset($user_status->id) && !empty($user_status->id))
      {
        $arr_user_data                 = [];
        $arr_user_data['user_name']    = $request->input('username');
        $arr_user_data['mobile']       = $request->input('mobile');
        $arr_user_data['spencer_id']   = $request->input('spencer_id');
        $arr_user_data['package']      = $request->input('package');
        $arr_user_data['spencer_name'] = $request->input('spencer_name');
        $arr_user_data['password']     = password_hash($request->input('password'), PASSWORD_DEFAULT);
        $arr_user_data['pancard']      = $request->input('pancard');
        $arr_user_data['country']      = $request->input('country');
        $arr_user_data['state']        = $request->input('state');
        $arr_user_data['city']         = $request->input('city');

        $data = $this->UserModel->where(['id'=>$user_status->id])->update($arr_user_data);
        if(!empty($user_status->id))
        {
          $transaction = $this->UserModel->where(['id'=>$user_status->id])->first();

          $TransactionModel                  = new TransactionModel;
          $TransactionModel->sender_id       = $user_status->email;
          $TransactionModel->amount          = $transaction['package'];
          $TransactionModel->approval        = "sms";
          $TransactionModel->activity_reason = 'deposit';
          $TransactionModel->save();
        }
        //send sms
        $mobileno = $request->input('mobile');
        $aplicant = $request->input('username');
        $username = $request->input('user_id');
        $password = $request->input('password');
        $msg="Dear ".$aplicant.",\nYour are register on lifetimehelp.org successfully. \nYour Username:-".$username." & Password:-".$password."\nPlease Login Your Account.";
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
          Session::flash('success', 'User added successfully.');
      }
      
      return redirect('customer');
    }

    public function forget_password()
    {
      $this->arr_view_data['customer_panel_slug'] = $this->customer_panel_slug;
      $this->arr_view_data['page_title'] = "Login";
      
      return view('customer.forgot',$this->arr_view_data);
    }

    public function forget_password_process(Request $request)
    {
      $validator = Validator::make($request->all(), [
            'username'       => 'required',
            'mobile'         => 'required'
        ]);

      if ($validator->fails()) 
      {
          return redirect(config('app.project.customer_panel_slug').'/forget_password')
                      ->withErrors($validator)
                      ->withInput($request->all());
      }


      $characters = '0123456789';
      $charactersLength = strlen($characters);
      $randomString = '';
      for ($i = 0; $i < 6; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }

      $arr_user_data                 = [];
      $password                      = password_hash($randomString, PASSWORD_DEFAULT);
      $arr_user_data['email']        = $request->input('username');
      $arr_user_data['mobile']       = $request->input('mobile');

      $count = $this->UserModel->where($arr_user_data)->count();
      if($count)
      {
        $this->UserModel->where($arr_user_data)->update(['password'=>$password]);
        Session::flash('success', 'Password has been sent to your mobile.');
        $mobileno = $request->input('mobile');
        $msg="Dear Sir,\nYour new password is ".$randomString." \nPlease Login Your Account.";
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
      else
      {
         Session::flash('error', 'Please enter valid details!!!');
         return redirect('customer/forget_password');
      }

       return redirect('customer');
      
    }

    public function logout()
    {
      Sentinel::logout();
      return redirect(url($this->customer_panel_slug.'/login'));
    }
}
