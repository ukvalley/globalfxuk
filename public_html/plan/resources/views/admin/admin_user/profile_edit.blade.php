@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Profile Edit Details
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Profile Edit Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Profile Edit-{{$data->user_name}}</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/update_user_profile" data-parsley-validate="">
              {{ csrf_field() }}
               @include('admin.layout._operation_status')
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Username</label> <br>
                     <input id="user_name" name="user_name" type="text" value="{{$data->user_name}}" readonly="" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>User Id</label> <br>
                     <input id="email" name="email" type="text" value="{{$data->email}}" style="width: 50%" readonly="" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sponcer Id</label> <br>
                     <input id="spencer_id" name="spencer_id" type="text" value="{{$data->spencer_id}}" readonly="" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Mobile No.</label> <br>
                     <input id="mobile" name="mobile" type="text"  value="{{$data->mobile}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                
                   <div class="col-md-6">
                  <div class="form-group">
                    <label>Recieving address</label> <br>
                     <input id="ifsc" name="ifsc" type="text"  value="{{$data->ifsc}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <!--<div class="col-md-6">
                  <div class="form-group">
                    <label>BRANCH </label> <br>
                     <input id="branch" name="branch" type="text"  value="{{$data->branch}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>IFSC</label> <br>
                     <input id="ifsc" name="ifsc" type="text"  value="{{$data->ifsc}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>BANK ACCOUNT NO. </label> <br>
                     <input id="bank_account_no" name="bank_account_no" type="text"  value="{{$data->bank_account_no}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>PAYTM </label> <br>
                     <input id="paytm" name="paytm" type="text"  value="{{$data->paytm}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>PHONEPE </label> <br>
                     <input id="phonepe" name="phonepe" type="text"  value="{{$data->phonepe}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>TEZ </label> <br>
                     <input id="tez" name="tez" type="text"  value="{{$data->tez}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>BHIM_UPI </label> <br>
                     <input id="bhim_upi" name="bhim_upi" type="text"  value="{{$data->bhim_upi}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>-->
                <div class="row" style="margin-top: 20px;margin-left: 10px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="submit" class="btn cyan waves-effect waves-light right" id="submit" name="submit">
                  </div>
                </div>
              </div>
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