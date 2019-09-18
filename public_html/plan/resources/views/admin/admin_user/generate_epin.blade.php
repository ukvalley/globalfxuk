@extends('admin.layout.master')                

@section('main_content')

<!-- Select2 -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Epin Generate
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Epin Generate</li>
      </ol>
    </section>


             <?php 
$user = Sentinel::check();

    $data_plan = \DB::table('plans')->where('plan_amount','=',$user->plan)->first();
    ?>
                
                
                 <?php
                 $user = Sentinel::check();
                /* $user_income = ['level1', 'level2', 'sponcer'];*/
                 $user_expense = ['upgrade', 'epin','withdrawl'];
                 //income
                 $tran_level_one = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('activity_reason','=','level1')->get();
                  $tran_level_two = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('activity_reason','=','level2')->get();
                  $tran_level_sponcer = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('activity_reason','=','sponcer')->get();
                 
                 $amount_income_level1=0;
                 $amount_income_level2=0;
                 $amount_income_sponcer=0;
                 ?>
                 @if(count($tran_level_one)=='3')
                 @foreach($tran_level_one as $key=>$value)
                 
                <?php $amount_income_level1+=$value->amount; ?>
                 
                 @endforeach
                 @endif

                 @if(count($tran_level_two)=='6')
                 @foreach($tran_level_two as $key=>$value)
                 
                <?php $amount_income_level2+=$value->amount; ?>
                 
                 @endforeach
                 @endif


                 @foreach($tran_level_sponcer as $key=>$value)
                 
                <?php $amount_income_sponcer+=$value->amount; ?>
                 
                 @endforeach

                 <?php
                 //expenses 
                 $tran_data = \DB::table('transaction')->where(['reciver_id'=>$user->email])->whereIn('activity_reason',$user_expense)->get();
                 
                 $amount_expenses=0;
                 ?>
                 
                 @foreach($tran_data as $key=>$value)
                 
                <?php $amount_expenses+=$value->amount; ?>
                 
                 @endforeach
                 <?php $wallet_income_main= $amount_income_level1+$amount_income_level2+$amount_income_sponcer-$amount_expenses; ?>



     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Epin Generate</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/generate_epin" data-parsley-validate="">
                 @include('admin.layout._operation_status')
              {{ csrf_field() }}

              
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Quantity</label> <br>
                     <input id="quantity" name="quantity" type="text" class="form-control" placeholder="Enter quantity less than 999 at a time" required="true">
                  </div>
                </div>
              </div>
    <?php 
    $user_data = \DB::table('users')->where('email','<>','admin')->get();
    $user = Sentinel::check();
    ?>
        <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
              <div class="form-group">
                <label>User ID</label>
                <select name="issue_to" id="issue_to" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                   <option>{{$user->email}}</option>
                   @foreach($user_data as $key=>$value)
                  
                  <option>{{$value->email}}</option>
                  @endforeach
                 
                </select>
              </div>
              </div>
            </div>
             
              <div class="row" style="margin-top: 20px">
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