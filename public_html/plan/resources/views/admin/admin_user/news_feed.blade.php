@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Send SMS
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">View Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Send SMS To Customer</h3><br>
              <!-- tools box -->
              <div class="pull-left box-tools">


</div>


 <form class="col s12" method="get" action="{{url('/')}}/admin/update_newsfeed" data-parsley-validate="">
              {{ csrf_field() }}
               @include('admin.layout._operation_status')
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Message Text</label> <br>
                     <textarea id="news" name="news" type="text" rows="4" cols="50">{{$data->news_feed}}
</textarea>
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

@stop 