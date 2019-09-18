@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        User List
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">User List</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">User List</h3>
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
                  <th>Transection Pin</th>
                  <th>Mobile No.</th>
<th>Join Date</th>
                  <th>Status</th>
                  <th>Action</th>
<th>Plan</th>
<th>Force Active</th>
<th>Give daily</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->user_name}}</td>
                      <td>{{$value->spencer_id}}</td>
                      <td>{{$value->transaction_pin}}</td>
                      <td>{{$value->mobile}}</td>
                      <td>{{$value->created_at}}</td>
                      <td>
                        @if($value->is_active==2)
                          <a href="{{url('/')}}/admin/status_change?id={{$value->id}}" class="btn label-success">Active</a>
                        @elseif($value->is_active==0)
                          <a href="{{url('/')}}/admin/status_change?id={{$value->id}}" class="btn label-danger">Block</a>
                          @else
                          <a href="{{url('/')}}/admin/status_change?id={{$value->id}}" class="btn label-danger">Inactive</a>
                        @endif
                      </td>
                      <td>
                        <a href="{{url('/')}}/admin/edit?id={{$value->id}}" class="fa fa-edit"></a>
                        <a href="{{url('/')}}/admin/view?id={{$value->id}}" class="fa fa-eye"></a>

                        
                     <!-- -->
<td>{{$value->plan}}</td>
</td>
<td><a href="{{url('/')}}/admin/force_active?id={{$value->id}}" class="glyphicon glyphicon-remove"></a></td>

<td><a href="{{url('/')}}/admin/create_daily_link?id={{$value->id}}" class="glyphicon glyphicon-remove"></a></td>
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