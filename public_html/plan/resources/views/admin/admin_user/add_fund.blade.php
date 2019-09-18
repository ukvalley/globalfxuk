@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Fund
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Add Fund</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Add Fund</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/add_money" data-parsley-validate="">
              {{ csrf_field() }}
               @include('admin.layout._operation_status')
              <div class="row" style="margin-top: 20px">
 <div class="col-md-6">
  <div class="form-group has-feedback">
        <label>Amount</label>
         <input id="amount" onchange="check_amount()" name="amount" class="form-control" placeholder="Enter amount between package" type="text" required="true">
        <span class="glyphicon glyphicon-ruble form-control-feedback"></span>
      </div>
    </div>

    <div class="col-md-6">
       <div class="form-group has-feedback">
        <label>BTC Rate</label>
         <input id="btc" name="btc" readonly  class="form-control" type="text" required="true">
        <span class="glyphicon glyphicon-ruble form-control-feedback"></span>
      </div>
    </div>
    
    <?php  
      $admin = \DB::table('users')->where(['email'=>"admin"])->first(); ?>
    
    <div class="col-md-6">
       <div class="form-group has-feedback">
        <label>Btc Address: {{$admin->ifsc}}</label>
    
        <span class="glyphicon glyphicon-ruble form-control-feedback"></span>
      </div>
    </div>
    
    <div class="col-md-6">
       <div class="form-group has-feedback">
        <label>Package</label>
         <input id="package" name="package" class="form-control" type="text" required="true">
        <span class="glyphicon glyphicon-ruble form-control-feedback"></span>
      </div>
    </div>
                 
                
                
      <div class="col-md-6">
            <div class="form-group has-feedback">
               <input type="submit"  class="btn cyan waves-effect waves-light right" id="submit" name="submit">
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
  
  
  <!-- jQuery 3 -->
<script src="{{url('/')}}/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{url('/')}}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="{{url('/')}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{url('/')}}/bower_components/parsley.js"></script>

<script type="text/javascript">
   function check()
    {
       
       var value = $('#amount').val();
       $.ajax({
              url: "{{'https://blockchain.info/tobtc'}}",
              type: 'GET',
              data: {
                _method: 'GET',
                currency:'USD',
                value: value
               
                _token:  '{{ csrf_token() }}'
              },
              
            success: function(response)
            {
              
                $('#btc').text(response);
                
              
            }
            });
    }
</script>



  <script type="text/javascript">

   function check_amount()
    {
        
      
      var amount = $('#amount').val();
       var package =$('#package').val();
       
       if(amount<50)
       {
          document.getElementById('package').value = ''
          alert('amount is lower than 50');
       }

      else if(amount < 2500)
      {
        
        document.getElementById('package').value = 'starter'
      }

      else if(amount < 5000)
      {
       document.getElementById('package').value = 'advance'
      }

      else if (amount < 10000) {
        document.getElementById('package').value = 'premium'
      }

      else if(amount < 50000)
      {
        document.getElementById('package').value = 'ultra'
      }

      else if(amount > 50000)
      {
        document.getElementById('package').value = ''
          alert('amount is greater than package');
      }
      
      
       $.ajax({
              url: "{{'https://blockchain.info/tobtc'}}",
              type: 'GET',
              data: {
                _method: 'GET',
                currency:'USD',
                value: amount
               
               
              },
             
            success: function(response)
            {
              
                document.getElementById('btc').value = response;
                 
              
            }
            });

    

  }
</script>

@stop 