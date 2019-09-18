@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Teamview
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Teamview </li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Teamview</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Level</th>
                  <th>Status</th>
               
                  
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key=>$value)
                  
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value['email']}}</td>
                      <td>{{$value['user_name']}}</td>
                      <td>{{$value['level']}}</td>
                      <td>
    <?php  $data = \DB::table('users')->where('email','=',$value['email'])->first(); ?>
                           
                           @if($data->is_active=="0")
                           Block
                           @elseif($data->is_active=="1")
                           Inactive
                           @elseif($data->is_active=="2")
                           Active
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

@stop 