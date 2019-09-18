@extends('admin.layout.master')                

@section('main_content')

<!-- Select2 -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Epin Transfer
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Epin Transfer</li>
      </ol>
    </section>

     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Epin Transfer</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form id="form_" class="col s12" method="post" action="{{url('/')}}/admin/epin_transfer"  onsubmit="return validateForm()"data-parsley-validate="">
                 @include('admin.layout._operation_status')
              {{ csrf_field() }}

                <span id="error_total_amount" style="float: center; color:red"></span>

    <?php 
    $user = Sentinel::check();
    $epin_count = \DB::table('epin')->where('issue_to','=',$user->email)->where('used_by','=','')->count();
   
    ?>

               <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Epin Available</label> <br>
                     <input id="epin_available" disabled value="{{$epin_count}}" name="epin_available" type="text" class="form-control" placeholder="" required="true">
                  </div>
                </div>
              </div>

              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Transfer Quantity</label> <br>
                     <input id="epin_Transfer" name="epin_Transfer" type="text" class="form-control" placeholder="Enter quantity less than 999 at a time" required="true">
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
               
                  
                   <input id="transfer_to" onchange="check()" name="transfer_to" type="text" class="form-control" placeholder="Enter username to transfer amount" required="true">
                 <span id="success_msg" style="color: green"></span>
        <span id="error_msg" style="color:red"></span>
                
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
      $("#form_").submit(function()
      {
        var epin_available = $('#epin_available').val();
        var epin_Transfer      = $('#epin_Transfer').val();
       
        
       
        if(parseInt(epin_available)<parseInt(epin_Transfer))
        { 
          $('#error_total_amount').text('Epin count should not grater than Available Epin count');
          return false;
        }
        
        
       
        else 
        {
          $('#error_total_amount').text('');
        }
      });
    });
  </script>
  
  
  
  <script src="{{url('/')}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{url('/')}}/bower_components/parsley.js"></script>
<script type="text/javascript">
   function check()
    {
       var sponcer_id = $('#transfer_to').val();
       $.ajax({
              url: "{{url('/check_sponcer1')}}",
              type: 'GET',
              data: {
                _method: 'GET',
                sponcer_id     : sponcer_id,
                _token:  '{{ csrf_token() }}'
              },
            success: function(response)
            {
              if(response.status == 'success')
              {
                $('#success_msg').text(response.name);
                $('#error_msg').text('');
              }
              else if(response.status == 'error')
              {
                $('#success_msg').text('');
                $('#error_msg').text('Sponcer id is invalid');
              }
              else
              {
                $('#success_msg').text('');
                $('#error_msg').text('Sponcer id is invalid');
              }
            }
            });

      
    }
</script>


@stop 