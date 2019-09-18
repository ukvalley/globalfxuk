@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Accept Payment
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Accept Payment</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Accept Payment</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
               <?php   $user = Sentinel::check(); ?>
              <input type="hidden" id="id" name="id" value="{{$user->email}}">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Sender Id</th>    
                  {{--<th>Reciver Id</th>   --}} 
                  <th>Date</th>
                 <!-- <th>Reason</th>-->
                  <th>Amount</th>
                 {{--  <th>Receipt</th> --}}
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key=>$value)
                   <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->sender_id or 'NA'}}</td>   
                    {{--<td>{{$value->reciver_id or 'NA'}}</td>  --}} 
                    <td>{{$value->date or 'NA'}}</td>
                    <!--<td>{{$value->activity_reason or 'NA'}}</td>-->
                    <td>{{$value->amount}}</td>
                 {{--    <td>
                      @if(!empty($value->receipt_file))
                        <a href="" download=""><i class="fa fa-download"></i></a>
                      @else
                        NA
                      @endif
                    </td> --}}
                    <td>
@if($user->is_active==2)
                      @if($value->approval=='completed')
                        <a href="javascript:void(0)" class="btn label-success">Payment Received</a>
                      @elseif($value->approval=='payment_done')


                       @if($value->is_active==0 && $value->generator!="system")   
                         <a data-sample-id="{{$value->trans_id}}" value="{{$value->trans_id}}" href="{{url('/')}}/admin/reclaim_payment?id={{$value->trans_id}}" class="button1 btn label-warning">Reclaim Payment</a>

@elseif($value->is_active==0 && $value->generator=="system")   
                         <a data-sample-id="{{$value->trans_id}}" value="{{$value->trans_id}}"  class="button1 btn label-warning">Payment Rejected</a>
                        @else
<a  data-sample-id="{{$value->trans_id}}" href="{{url('/')}}/admin/accept_payment?id={{$value->trans_id}}" value="{{$value->trans_id}}"  href="javascript:void(0)"  class="button1 btn label-danger">Accept Payment</a>
                        @endif


                      <!--  <a onclick="open_model(this)" data-sample-id="{{$value->trans_id}}" value="{{$value->trans_id}}" href="javascript:void(0);" {{-- href="{{url('/')}}/admin/accept_payment?id={{$value->trans_id}}" --}} class="button1 btn label-danger">Accept Payment</a>  -->
                      @else
                        <button class="btn label-info">Payment Inprocess</button>
                      @endif

 @else
     <span style="color: red">Block! Please activate your account.</span>
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
        $('#btn_1').hide();
          $('#btn_2').show();
        // var p_id      = $(".button1").data("sample-id");
         
        
        
           alert(p_id);
        if(response=='true')
        {
          $('#btn_1').hide();
          $('#btn_2').show();
          $.ajax({
            url : "{{url('/admin/accept_payment')}}",
            type: 'GET',
            data: {
              _method     : 'POST',
              id        : p_id,
              _token      : '{{ csrf_token() }}'
            },
          success: function(response)
          {
            if(response=='success')
            {
              $('#success_msg').val(response);
              setTimeout(
              function() 
              {
                 location.reload();
              }, 1000);
            }
            else
            {
               $('#error_msg').text("Payment Withdrawal Request Already Sent.");
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