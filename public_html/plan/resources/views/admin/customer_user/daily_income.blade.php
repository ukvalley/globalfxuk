@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Daily Income
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Growth Income</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
              @include('admin.layout._operation_status')
            <div class="box-header">
              <h3 class="box-title">Daily Income</h3>
              <?php   $user = Sentinel::check(); ?>
              <input type="hidden" id="id" name="id" value="{{$user->email}}">
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
             
             <?php 
$user = Sentinel::check();

    $data_plan = \DB::table('plans')->where('plan_amount','=',$user->plan)->first();
    ?>
             
             <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Date</th>
                  <th>Daily Growth %</th>
                  <th>Plan Amount</th>
                  <th>Total Recived</th>
                  
                </tr>
                </thead>
                <tbody>
          <?php
          $user = Sentinel::check();
         /* $data_plan = \DB::table('plans')->where('plan_amount','=','2000')->get();*/
          
          $packages = \DB::table('transaction')
          ->where('activity_reason','=','add_package')
           ->where('sender_id','=',$user->email)
          ->where('approval','=','completed')->get();
        //  print_r($packages);
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
                      { ?>
                          <tr>
                          <td>{{$key+1}}</td>
                          <td>{{$value->date}}</td>
                          <td>{{$value->returns}}</td>
                          <td>${{$value1->amount}}</td>
                          <td>${{($value->returns/100)*$value1->amount}}</td>
                          </tr>   
                          <?php
                          $amount = $amount+(($value->returns/100)*$value1->amount);
                          $amount1= $amount+$amount1;

                      }
                  }



            }

            }

                   
                   ?>
               
                 
                  
                </tbody>
              </table>
             
             
                                
             
             
              <table id="example1" class="table table-bordered table-striped">
                
                




<tbody>
  <?php
               $transaction  = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('activity_reason','=','daily')->orderBy('id', 'ASC')->get();
               $date1= date('Y-m-d'); 
               ?>

              
                @foreach($transaction as $key=>$value)
                  <tr>
                   

                    
                    <?php $date1= date('2018-11-12') ?>
                     
                    

                    

                    
                 
                    <td>{{$key+1}}</td>
                    <td>{{$value->date}}</td>
                    <td>{{$value->amount}}</td>
                    

                    <td>@if($value->approval=='completed')
                      <a href="javascript void(0)" class="btn label-success">Recieved</a>
                        @elseif($value->approval=='payment_done' && empty($value->sender) && strtotime($value->date) >= strtotime($date1))
                        <a href="javascript void(0)" class="btn label-danger">Time remaining</a>
                        @elseif($value->approval=='payment_done' && !empty($value->sender))
                        <a href="javascript void(0)" class="btn label-warning">sender allocated</a>
                        @elseif($value->approval=='payment_done' && empty($value->sender) && strtotime($value->date) <= strtotime($date1))
                        <a href="javascript void(0)" class="btn label-warning">Withdrawl requested</a>
                        @endif
                     
                    </td>
                   
                   
                  </tr>
                @endforeach       
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
   <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="background: #1390b2">
            <!-- Modal content-->
        
            <div class="modal-content" >
                <div class="modal-header" data-dismiss="modal">
                    <button type="button"  class="close" >&times;</button>
                <h4 class="modal-title">Transaction Pin</h4>
                </div>
                <form action="javascript:void(0)" method="post" id="payment-form">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 icon-calendar" style="padding-top: 20px;padding-left: 30px;padding-right: 30px">
                          
                            <label class="sr-only" for="arrival-Name">Pin</label>
                            <input type="text" class="form-control" id="pin" placeholder="Pin">
                            <span style="color: red;" id="error_name"></span><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_1" style="float: left;" onclick="pin_verify()" class="btn btn-success">Verify</button>
                         <button id="btn_2" style="float: left;display: none;"  class="btn btn-success"><i class="fa fa-spinner fa-spin"></i></button>
                        <span style="color: green" id="success_msg"></span>
                        <span style="color: red" id="error_msg"></span>
                        <button type="button" class="btn input_tranperent" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script type="text/javascript">

var p_id = {};
  function open_model(a)
  {
    $('#myModal').modal('toggle');
    p_id = a.getAttribute('value');
  }
  function pin_verify()
  {
$('#btn_1').hide();
    var flag       = 0;
    var pin        = $('#pin').val();
    var email      = $('#id').val();

    if(pin=='')
    {
    $('#error_name').text('Please Enter Pin');
    flag=1;
    }
    else
    {
    $('#error_name').text('');
    }

    if(flag==0)
    {
      $.ajax({
        url : "{{url('/admin/check_pin')}}",
        type: 'GET',
        data: {
          _method     : 'POST',
          pin        : pin,
          email        : email,
          _token      : '{{ csrf_token() }}'
        },
      success: function(response)
      {
        if(response=='true')
        {
           $('#btn_1').hide();
          $('#btn_2').show();
alert(p_id);
          $.ajax({
            url : "{{url('/admin/withdrawal_payment')}}",
            type: 'GET',
            data: {
              _method     : 'POST',
              id        : p_id,
                   
              _token      : '{{ csrf_token() }}'
            },
          success: function(response)
          {
             $('#btn_1').hide();
          $('#btn_2').show();
            if(response=='success')
            {
              $('#success_msg').val(response);
              setTimeout(
              function() 
              {
                 location.reload();
              }, 3000);
            }
            else
            {
               $('#error_msg').text("Payment Withdrawal Request Already Sent.");
setTimeout(
              function() 
              {
                 location.reload();
              }, 3000);

            }
          }
          });
        }
        else
        {
           $('#error_msg').text('Please enter valid pin');
            $('#btn_1').show();
          $('#btn_2').hide();
        }
      }
      });
    }
    else
    {
        $('#error_msg').text('Please enter valid pin');
         $('#btn_1').show();
          $('#btn_2').hide();
    }
  }
</script>
@stop 