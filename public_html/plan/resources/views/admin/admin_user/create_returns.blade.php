@extends('admin.layout.master')                

@section('main_content')

<!-- Select2 -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Epin Generate
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Create Returns</li>
      </ol>
    </section>


     <!-- Main content -->
     <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Create Returns</h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <!-- /. tools -->
              <form class="col s12" method="post" action="{{url('/')}}/admin/add_return" data-parsley-validate="">
                 @include('admin.layout._operation_status')
              {{ csrf_field() }}

              
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Date</label> <br>
                     <input id="date" name="date" type="text" class="form-control" placeholder="Enter date in dd-mm-yyyy format" required="true">
                  </div>
                </div>
              </div>
    <?php 
    $plans = \DB::table('package')->get();
    $user = Sentinel::check();
    ?>
        <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
              <div class="form-group">
                <label>Plans</label>
                <select name="plan" id="plan" class="form-control select2" style="width: 100%;" tabindex="-1" aria-hidden="true">
                   
                   @foreach($plans as $key=>$value)
                  
                  <option>{{$value->package_name}}</option>
                  @endforeach
                 
                </select>
              </div>
              </div>
            </div>


             <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Return %</label> <br>
                     <input id="return" name="return" type="text" class="form-control" placeholder="Enter quantity less than 999 at a time" required="true">
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