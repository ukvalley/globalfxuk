@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Level Income
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Promotional Bonus</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Promotional Bonus</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Income Against</th>    
                  <th>Reciver Id</th>    
                  <th>Date</th>
                  <th>Amount</th>
                  
                  
                 {{--  <th>Receipt</th> --}}
                 <!-- <th>Status</th>-->
                </tr>
                </thead>
                <tbody>
                  <?php

                  $user = Sentinel::check();
                 $tran_data = \DB::table('transaction')->join('users', 'transaction.level_id', '=', 'users.email')->where(['reciver_id'=>$user->email])->where(['transaction.generator'=>'system'])->where('transaction.activity_reason','=','level_referal')->select('transaction.level_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.id as user_sender_id','users.is_active','transaction.date','transaction.approval','transaction.generator','transaction.amount','transaction.level_id')->get();
                 
                
                     $amount =0;
                
                  foreach($tran_data as $key=>$value)

                  {
                      
                       if($value->is_active==2)
                 
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
                      ?>
                    <tr>
                    <td>{{$i}}</td>
                    <td>{{$value->level_id or 'NA'}}</td>   
                    <td>{{$value->reciver_id or 'NA'}}</td>
                    <td>{{$date or 'NA'}}</td>
                    <td>${{$user->amount*(0.5/100)}}</td>
                
                  </tr>
                  <?php
                      
                  }
                  
                
                }
                
                }
                
                 }

                  ?>
                  
                  
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
   
  </div>
  <!-- /.content-wrapper -->

@stop 