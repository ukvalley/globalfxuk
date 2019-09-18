@extends('admin.layout.master')                

@section('main_content')

<?php
$data_setting = \DB::table('site_setting')->where('id','=','1')->first();

?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Details
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">View-{{$data->user_name}}</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/process_change_pass" data-parsley-validate="">
              {{ csrf_field() }}
               @include('admin.layout._operation_status')
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>Username</label>:</td>
                        <td>{{$data->user_name}}</td>
                      </tr>
                    </table>
                  
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>User Id:</td>
                        <td>{{$data->email}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>Sponcer Id:</td>
                        <td>{{$data->spencer_id}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>Mobile No.:</td>
                        <td>{{$data->mobile}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>BRANCH :</td>
                        <td>{{$data->branch}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>BANK :</td>
                        <td>{{$data->banck_name}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>IFSC:</td>
                        <td>{{$data->ifsc}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>BANK ACCOUNT NO. :</td>
                        <td>{{$data->bank_account_no}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>PAYTM :</td>
                        @if($data->paytm!=null && strlen($data->paytm) >= 10)
                       <td> <a href="paytmmp://cash_wallet?featuretype=sendmoneymobile&recipient={{$data->paytm}}&amount={{$_GET['amt']}}" ><button type="button" class="btn bg-navy btn-flat margin">{{$data->paytm}}<br> click here or pay on paytm</button></td></a>
@else
<td>Not Available</td>
@endif
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>UPI Payment:</td>
                        @if($data->phonepe!=null && strlen($data->phonepe) >= 10)
                        <td><a href="upi://pay?pa={{$data->phonepe}}@ybl&pn={{$data->user_name}}&am={{$_GET['amt']}}"><button type="button" class="btn bg-purple btn-flat margin">{{$data->phonepe}}<br> click here or pay on UPI</button></td></a>
@else
<td>Not Available</td>
@endif
                      </tr>
<tr><center><p style="color:red;"><b>Don't Use phonepe for below UPI Payment method</b><p></center></tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>TEZ :</td>
                        <td>{{$data->tez}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>BHIM_UPI :</td>
                        @if($data->bhim_upi!=null && strlen($data->bhim_upi) >= 10)
                        <td><a href="upi://pay?pa={{$data->bhim_upi}}&pn={{$data->user_name}}&am={{$_GET['amt']}}"><button type="button" class="btn bg-orange btn-flat margin">{{$data->bhim_upi}}<br> click here or pay on UPI</button></td></a>
@else
<td>Not Available</td>
@endif
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <table>
                      <tr>
                        <td width="150"><label>Amount :</td>
                        <td>{{$_GET['amt']}}</td>
                      </tr>
                    </table>
                  </div>
                </div>
<div class="col-md-6">
                  <div class="form-group bg-green">
<a href="https://api.whatsapp.com/send?phone=91{{$data->mobile}}&text=Hello sir, I have sent you {{$_GET['amt']}} payment through {{$data_setting->site_name}} at ({{$data->email}}) id. please accept my payment my user id is {{Sentinel::getUser()->email}} Regards:{{Sentinel::getUser()->user_name}} Member of {{$data_setting->site_name}}" class="btn btn-block btn-social btn-facebook bg-green">
                <i class="fa fa-whatsapp"></i> Send confirmation message to Reciever on whatsapp
              </a>

                    
                  </div>
                </div>


              </div>
              {{-- <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="submit" class="btn cyan waves-effect waves-light right" id="submit" name="submit">
                  </div>
                </div>
              </div> --}}
              </form>
            </div>
        </div>   
        </div>
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->

@stop 