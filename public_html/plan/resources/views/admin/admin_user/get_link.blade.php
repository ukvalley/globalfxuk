@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Get Link
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Get Link </li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Get Link</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>User Id</th>
                  <th>Action</th>
                 <!-- <th>Mobile No.</th>-->
                 <!-- <th>Status</th>
                  <th>Action</th>-->
                </tr>
                </thead>
                   <?php 
                    $user = Sentinel::check();
                        $data = \DB::table('transaction')->where(['reciver_id'=>$user->email])->where('generator','<>','reciever')->where(['approval'=>'payment_done'])->get();
                    ?>
<tbody>
                  @foreach($data as $key=>$value)
                    <tr>
                      <?php $trans_user_data = \DB::table('users')->where(['email'=>$value->sender_id])->first();
            if(empty($trans_user_data->user_name))
            {
              continue;
            }
            ?>
                

                      <td>{{$key+1}}</td>
                      <td>{{$value->sender_id}}</td>
                      <td> <a class="btn btn-success" href="{{url('/')}}/admin/view1?id={{$trans_user_data->id or 'NA'}}">Get Help</a></td>
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

@stop 