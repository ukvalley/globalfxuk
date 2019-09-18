@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
      Block  User List
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Block User List</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Block User List</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>User Id</th>
                  <th>User Name</th>
                  <th>Parent User</th>
                  <th>Mobile No.</th>
                  <th>Time Complete on</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
          @php   $date1 =date("M d, Y H:i:s"); @endphp
             
                  @foreach($data as $key=>$value)
                    <tr>
                     @php $date2 = date("M d, Y H:i:s",  strtotime("+"."48 hours", strtotime($value->created_at))); @endphp
                       @if($date1>$date2)
                      
                    
                   
                      <td>{{$key+1}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->user_name}}</td>
                      <td>{{$value->spencer_id}}</td>
                      <td>{{$value->mobile}}</td>
                      <td><?php echo(date("M d, Y H:i:s",  strtotime("+"."48 hours", strtotime($value->created_at)))); ?></td>
                      <td>
                        @if($value->is_active==1)
                          <a href="{{url('/')}}/admin/status_change?id={{$value->id}}" class="btn label-success">Active</a>
                        @else
                          <a href="{{url('/')}}/admin/status_change?id={{$value->id}}" class="btn label-danger">Block</a>
                        @endif
                      </td>
                      <td>
                        <a href="{{url('/')}}/admin/edit?id={{$value->id}}" class="fa fa-edit"></a>
                        <a href="{{url('/')}}/admin/view?id={{$value->id}}" class="fa fa-eye"></a>
                      </td>
                    @endif
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