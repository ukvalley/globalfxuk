@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Transaction
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Transaction</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Transaction</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Creator / Sender</th>
                  <th>Reciever Id</th>
                  <th>Count</th>
                  <th>Date</th>
                  <th>Purpose</th>
                </tr>
                </thead>
                <tbody>
               <?php    $user = Sentinel::check();
     $epin_metadata= \DB::table('epin_metadata')->where('sender','=',$user->email)->orWhere('reciever', '=', $user->email)->get();
     ?>
                  @foreach($epin_metadata as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->sender}}</td>
                      <td>{{$value->reciever or 'NA'}}</td>
                      <td>{{$value->count}}</td>
                      <td>{{$value->created_at}}</td>
                       <td>{{$value->purpose}}</td>
                     
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