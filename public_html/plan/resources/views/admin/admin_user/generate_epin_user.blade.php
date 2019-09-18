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
                  $tran_transfer_sender = \DB::table('transaction')->where(['income_against'=>$user->email])->where('activity_reason','=','transfer')->get();
                   $tran_transfer_reciever = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('activity_reason','=','transfer')->get();
                 
                 $amount_income_level1=0;
                 $amount_income_level2=0;
                 $amount_income_sponcer=0;
                 $amount_transfer_sender=0;
                 $amount_transfer_reciever=0;
                 ?>
                 @if(count($tran_level_one)=='3')
                 @foreach($tran_level_one as $key=>$value)
                 
                <?php $amount_income_level1+=$value->amount; ?>
                 
                 @endforeach
                 @endif

                 
                 @foreach($tran_level_two as $key=>$value)
                 
                <?php $amount_income_level2+=$value->amount; ?>
                 
                 @endforeach
                 


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


                 @foreach($tran_transfer_sender as $key=>$value)
                 
                <?php $amount_transfer_sender+=$value->amount; ?>
                 
                 @endforeach

                 @foreach($tran_transfer_reciever as $key=>$value)
                 
                <?php $amount_transfer_reciever+=$value->amount; ?>
                 
                 @endforeach

                 <?php $wallet_income_main= $amount_transfer_reciever+$amount_income_level1+$amount_income_level2+$amount_income_sponcer-$amount_expenses-$amount_transfer_sender; ?>



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
              <form id="form_epin_generate" name="form_epin_generate" class="col s12" method="post" action="{{url('/')}}/admin/generate_epin_for_user" data-parsley-validate="">
                 @include('admin.layout._operation_status')
              {{ csrf_field() }}


              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
             <span id="error_total_amount" style="float: center; color:red" </span>
               </div>
                </div>
              </div>


               <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Wallet Balance: {{$wallet_income_main}}</label> <br>
                    <label>You can generate Epin upto</label> <br>
                     <input disabled id="wallet_epin" name="wallet_epin" type="text" class="form-control" placeholder="Generate Epin upto" required="true" value="{{intval($wallet_income_main/2200)}}">
                  </div>
                </div>
              </div>


              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Quantity</label> <br>
                     <input id="epin_quantity" name="epin_quantity" type="text" class="form-control" placeholder="You can create upto {{intval($wallet_income_main/2200)}} quantity" required="true">
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
 
 <script src="http://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript">
  
</script>
  
  <script type="text/javascript">
    $(document).ready(function()
    {
      $("#form_epin_generate").submit(function()
      {
        var wallet_epin = $('#wallet_epin').val();
        var epin_quantity      = $('#epin_quantity').val();
       
        
        
        if(parseInt(wallet_epin)<parseInt(epin_quantity))
        { 
          $('#error_total_amount').text('You have minimum wallet Balance to generate Epin');
          return false;
        }
       
        else 
        {
          $('#error_total_amount').text('');
        }
      });
    });
  </script>

@stop 