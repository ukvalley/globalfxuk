@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Level Income
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Level Income</li>
      </ol>
    </section>

     <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Level Income</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body" style="overflow-x:auto;">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Partner</th>    
                  <th>Amount</th>
                  <th>Percentage</th>
                  <th>Date</th>
                  <th>Amount</th>
                  
                  
                 {{--  <th>Receipt</th> --}}
                 <!-- <th>Status</th>-->
                </tr>
                </thead>
                <tbody>
                  @foreach($data as $key=>$value)
                  <?php 
                   $partner = \DB::table('users')->where(['email'=>$value->level_id])->first();
                  ?>
                  @if($partner->is_active=='2')
                   <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$value->level_id or 'NA'}}</td>   
                    <td>{{$value->plan_amt}}</td>   
                     <td>{{$value->percentage}}</td>  
                    <td>{{$value->date or 'NA'}}</td>
                    <td>${{$value->amount}}</td>
                
                  </tr>
                  @endif
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