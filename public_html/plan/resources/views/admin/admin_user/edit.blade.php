@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Edit Details
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Edit Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Edit-{{$data->user_name}}</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/update_user" data-parsley-validate="">
              {{ csrf_field() }}
               @include('admin.layout._operation_status')
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Username</label> <br>
                     <input id="user_name" name="user_name" type="text" value="{{$data->user_name}}" style="width: 50%" data-parsley-required="true">
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
                     <input id="spencer_id" name="spencer_id" type="text" value="{{$data->spencer_id}}" style="width: 50%" data-parsley-required="true">
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
                    <label>Bank Name</label> <br>
                     <input id="bank" name="bank" type="text"  value="{{$data->banck_name}}" style="width: 50%" data-parsley-required="true">
                  </div>
                </div>

                <div class="col-md-6">
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
                     <input id="paytm" name="paytm" type="text"  value="{{$data->paytm}}" style="width: 50%" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>PHONEPE </label> <br>
                     <input id="phonepe" name="phonepe" type="text"  value="{{$data->phonepe}}" style="width: 50%">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>TEZ </label> <br>
                     <input id="tez" name="tez" type="text"  value="{{$data->tez}}" style="width: 50%" >
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>BHIM_UPI </label> <br>
                     <input id="bhim_upi" name="bhim_upi" type="text"  value="{{$data->bhim_upi}}" style="width: 50%" >
                  </div>
                </div>
                <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="submit" style="margin-left:20px" class="btn cyan waves-effect waves-light right" id="submit" name="submit">
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
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Link Generate(Sender)</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
             
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter link Count</label> <br>
                     <input type="hidden" id="email" name="email" value="{{$data->email}}">
                     <input id="link" name="link" type="number" style="width: 50%">
                     <span style="color: red" id="error_name"></span>
                  </div>
                </div>
                <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="submit" style="margin-left:20px" class="btn btn-info right"  onclick="generate_link()" id="submit" name="submit" value="Generate">
                  </div>
                </div>
              </div>
                
            </div>
        </div>   
        </div>
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <section class="content" style="margin-top: -5%;">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Link Generate(Receiver)</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
             
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Enter link Count</label> <br>
                     <input type="hidden" id="email_r" name="email_r" value="{{$data->email}}">
                     <input id="link_r" name="link_r" type="number" style="width: 50%">
                     <span style="color: red" id="error_name_r"></span>
                  </div>
                </div>
                <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="submit" style="margin-left:20px" class="btn btn-info right"  onclick="generate_link_r()" id="submit" name="submit" value="Generate">
                  </div>
                </div>
              </div>
                
            </div>
        </div>   
        </div>
       
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Generate New Password</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
             
              <div class="row" style="margin-top: 20px">
                <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label style="margin-left:20px">Please click here.</label> <br>
                    <input type="submit" style="margin-left:20px" class="btn btn-info right"  onclick="generate_pass()" id="submit" name="submit" value="Generate">
                  </div>
                </div>
              </div>
                
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
<script type="text/javascript">
  function generate_pass()
  {
    var flag       = 0;
    var username        = $('#user_name').val();
    var mobile      = $('#mobile').val();

    if(flag==0)
    {
      $.ajax({
        url : "{{url('/admin/forget_password_process')}}",
        type: 'POST',
        data: {
          _method     : 'POST',
          mobile        : mobile,
          username       : username,
          _token      : '{{ csrf_token() }}'
        },
      success: function(response)
      {
        if(response=='true')
        {
             setTimeout(
              function() 
              {
                 location.reload();
              }, 1000);
        }
        else
        {
           $('#error_msg').text('Please enter valid number');
        }
      }
      });
    }
    else
    {
        $('#error_msg').text('Please enter valid number');
    }
  }
  function generate_link()
  {
    var flag       = 0;
    var email        = $('#email').val();
    var link      = $('#link').val();
    if(link=='')
    {
    $('#error_name').text('Please Enter Number');
    flag=1;
    }
    else
    {
    $('#error_name').text('');
    }

    if(flag==0)
    {
      $.ajax({
        url : "{{url('/admin/generate_link')}}",
        type: 'GET',
        data: {
          _method     : 'POST',
          link        : link,
          email       : email,
          _token      : '{{ csrf_token() }}'
        },
      success: function(response)
      {
        if(response=='true')
        {
             setTimeout(
              function() 
              {
                 location.reload();
              }, 1000);
        }
        else
        {
           $('#error_msg').text('Please enter valid number');
        }
      }
      });
    }
    else
    {
        $('#error_msg').text('Please enter valid number');
    }
  }
  function generate_link_r()
  {
    var flag       = 0;
    var email        = $('#email_r').val();
    var link      = $('#link_r').val();
    if(link=='')
    {
    $('#error_name_r').text('Please Enter Number');
    flag=1;
    }
    else
    {
    $('#error_name_r').text('');
    }

    if(flag==0)
    {
      $.ajax({
        url : "{{url('/admin/generate_link_r')}}",
        type: 'GET',
        data: {
          _method     : 'POST',
          link        : link,
          email       : email,
          _token      : '{{ csrf_token() }}'
        },
      success: function(response)
      {
        if(response=='true')
        {
             setTimeout(
              function() 
              {
                 location.reload();
              }, 1000);
        }
        else
        {
           $('#error_name_r').text('Please enter valid number');
        }
      }
      });
    }
    else
    {
        $('#error_msg').text('Please enter valid number');
    }
  }
</script>
@stop 