@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Support
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Support</li>
      </ol>
    </section>

   
                
              <?php 
$user = Sentinel::check();

    $data_plan = \DB::table('plans')->where('plan_amount','=',$user->plan)->first();
    ?>
                
                
                
            
               <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Withdrawl</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
            
            
          
            
              <!-- /. tools -->
              <form id="form" action="{{url('/')}}/admin/withdrawal_payment" class="col s12" method="get" onsubmit="return validateForm()" {{-- data-parsley-validate="" --}}>
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
                    <label>Wallet Balance</label> <br>
                     <input disabled id="wallet_amt" name="wallet_amt" type="text" class="form-control" placeholder="Title" required="true" value="{{$wallet_details['wallet_amount']}}">
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Withdrawl Amount</label> <br>
                    <input id="withdrawl_amt" name="withdrawl_amt" class="form-control"required="true">
                         
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

<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.10.0/jquery.validate.js" type="text/javascript"></script>
  
  <script type="text/javascript">
    $(document).ready(function()
    {
      $("#form").submit(function()
      {
        var wallet_amt = $('#wallet_amt').val();
        var withdrawl_amt      = $('#withdrawl_amt').val();
       
        
        if(parseInt(withdrawl_amt)<'20')
        {
          $('#error_total_amount').text('Withdrawl Amount Should be greater than min $20 and max $200000');
          
          return false;
        }
        else if(parseInt(wallet_amt)<parseInt(withdrawl_amt))
        { 
          $('#error_total_amount').text('Amount should not grater than total amount');
          return false;
        }
        
        
        else if(parseInt(withdrawl_amt)>'200000')
        { 
          $('#error_total_amount').text('Daily Withdrawl Limit is Max $200000 and min $20');
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