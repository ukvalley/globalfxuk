@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Send Link
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Send Link</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
           <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Send Link</h3>

              <!-- tools box -->
              <div class="pull-right box-tools">
               {{--  <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button> --}}
              </div>
              <form class="col s12" method="post" action="javascript:void(0);{{-- {{url('/')}}/admin/apply_link --}}" data-parsley-validate="">
                 @include('admin.layout._operation_status')
              {{ csrf_field() }}
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Sender Name</label> 
                    <select class="form-control" id="sender" name="sender" required="">
                      <option value="">Select user</option>
                      @foreach($sender as $key=>$value)
                     
                     @if($value->user_is_active==1 OR $value->user_is_active==2)
                      <option value="{{$value->trans_id }}">{{$value->sender_id or 'NA'}} (Transaction Id-{{$value->trans_id or 'trans_id'}}) {{$value->activity_reason}}  {{$value->amount}}</option>
                     @endif
                       @endforeach
                    </select>
                     <span id="error_sender" style="color:red"></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label>Reciver Name</label> 
                    <select class="form-control" id="reciver" name="reciver" required="">
                      <option value="">Select user</option>
                      @foreach($reciever as $key=>$value)
                      @if(strtotime($value->date)<=strtotime(date('d-m-Y')))
                       <option value="{{$value->id }}">{{$value->reciver_id or 'NA'}}(Transaction Id-{{$value->id or 'NA'}} {{$value->date}}) {{$value->amount}} {{$value->activity_reason}}</option>
                      @endif
                       @endforeach
                    </select>
                    <span id="error_reciver" style="color:red"></span>
                  </div>
                </div>
              </div>
              <div class="row" style="margin-top: 20px">
                <div class="col-md-6">
                  <div class="form-group">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group" style="float: right;">
                    <button class="btn btn-success" id="submit" type="button">Submit</button>
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