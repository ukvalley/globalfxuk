@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Unused Epins for Activation
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Unused Epins for Activation</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Unused Epins for Activation</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Epin</th>
                  <th>Issued to</th>
                  <th>Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               <?php    $user = Sentinel::check();
     $epin_unused= \DB::table('epin')->where('issue_to','=',$user->email)->Where('usedfor', '=', '')->get();
     ?>
                  @foreach($epin_unused as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->epin_id}}</td>
                      <td>{{$value->issue_to or 'NA'}}</td>
                      <td>{{$value->created_at}}</td>
                      <td><a onclick="open_model(this)" data-sample-id="{{$value->id}}" value="{{$value->id}}"  href="javascript:void(0)"  class="button1 btn label-danger">Use Epin to activate ID</a></td>
                     
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


   <!-- /.content-wrapper -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog" style="background: #1390b2">
            <!-- Modal content-->
        
            <div class="modal-content" >
                <div class="modal-header" data-dismiss="modal">
                    <button type="button"  class="close" >&times;</button>
                <h4 class="modal-title">Enter User ID to Activate</h4>
                </div>
                <form action="javascript:void(0)" onsubmit="return validateForm()" method="post" id="payment-form">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 icon-calendar" style="padding-top: 20px;padding-left: 30px;padding-right: 30px">
                          
                            <label class="sr-only" for="arrival-Name">Enter User ID</label>
                           

                               <input name="user_id" id="user_id" onchange="check()" name="transfer_to" type="text" class="form-control" placeholder="Enter username to transfer amount" required="true">
                 <span id="success_msg" style="color: green"></span>
        <span id="error_msg" style="color:red"></span>
                 
                </select>


                            <span style="color: red;" id="error_name"></span><br>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button id="btn_1" style="float: left;" onclick="pin_verify()" class="btn btn-success">Activate User</button>
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

var epin_id = {};
  function open_model(a)
  {
    $('#myModal').modal('toggle');
     epin_id = a.getAttribute('value');
 
  }
  function pin_verify()
  {
    var flag       = 0;
    var user_id        = $('#user_id').val();
    
       
   
      
        $('#btn_1').hide();
          $('#btn_2').show();
      
           alert(epin_id);
        
          $.ajax({
            url : "{{url('/admin/activate_user_with_epin')}}",
            type: 'GET',
            data: {
              _method     : 'GET',
              epin_id        : epin_id,
              user_id   : user_id,
             _token:  '{{ csrf_token() }}' 
            },
          success: function(response)
          {
            if(response=='success')
            {
              $('#success_msg').val(response);
               $('#error_msg').hide();
              setTimeout(
              function() 
              {
                 location.reload();
              }, 1000);
            }
            else
            {
               $('#error_msg').text("User Activated");
               alert("User is already Activated");
                
          $('#btn_2').hide();
          $('#btn_1').show();
            }
          }
          });
        
     
  }
</script>


  <script src="{{url('/')}}/plugins/iCheck/icheck.min.js"></script>
<script src="{{url('/')}}/bower_components/parsley.js"></script>
<script type="text/javascript">
   function check()
    {
       var sponcer_id = $('#user_id').val();
       $.ajax({
              url: "{{url('/check_sponcer_active')}}",
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
                $('#error_msg').text('User active');
                 $('#user_id').value('');
              }
              else
              {
                $('#success_msg').text('');
                $('#error_msg').text('User Active');
                 $('#user_id').value('');
              }
            }
            });

      
    }
    
    function validateForm() {
 var sponcer_id = $('#user_id').val();
       $.ajax({
              url: "{{url('/check_sponcer_active')}}",
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
                $('#error_msg').text('User Id is already active');
                 $('#user_id').value('');
              }
              else
              {
                $('#success_msg').text('');
                $('#error_msg').text('Sponcer id is invalid');
                 $('#user_id').value('');
              }
            }
            });
}
</script>

@stop 