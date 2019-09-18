@extends('admin.layout.master')                

@section('main_content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Control panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php   $usercount = \DB::table('users')->where('is_admin','<>','1')->count();?>
              <h3>{{$usercount or 'NA'}}</h3>

              <p>Total Users</p>
            </div>
            <div class="icon">
              <i class="fa fa-user"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php   $activeusers = \DB::table('users')->where('is_admin','<>','1')->where('is_active','=','2')->count();?>
              <h3>{{$activeusers or 'NA'}}</h3>

              <p>Total Active Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
               <?php   $usercount = \DB::table('users')->where('is_admin','<>','1')->where('is_active','=','1')->count();?>
              <h3>{{$usercount or 'NA'}}</h3>

              <p>New Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <?php   $usercount = \DB::table('users')->where('is_admin','<>','1')->where('is_active','=','0')->count();?>
              <h3>{{$usercount or 'NA'}}</h3>

              <p>Block Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
               <?php     $reciever_withdrawl = \DB::table('transaction')->where('sender_id','=','')->where('activity_reason','=','withdrawl')->orderBy('date','DESC')->count();
                $reciever_extra = \DB::table('transaction')->where('sender_id','=','')->where('activity_reason','=','extra')->orderBy('date','DESC')->count();
      ?>
     
      
              <h3>W:{{$reciever_withdrawl or 'NA'}}</h3>

              <p>Total Reciever</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <?php    $sender = \DB::table('transaction')
      ->join('users', 'transaction.sender_id', '=', 'users.email')
      ->where('transaction.reciver_id','=','')
      ->where('transaction.approval','<>','failed')
      ->where('transaction.activity_reason','<>','add_fund')
      ->where('transaction.approval','<>','completed')
      ->select('transaction.sender_id as sender_id','transaction.reciver_id','transaction.id as trans_id','users.is_active as user_is_active','transaction.date','transaction.approval','transaction.activity_reason','transaction.amount')
      ->orderBy('transaction.id','DESC')
      ->count();
      
      
      ?>
     
     
              <h3>{{$sender or 'NA'}}</h3>

              <p>Add fund Requests</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        {{-- <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>400</h3>

              <p>Inactive Users</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        <!-- ./col -->
       {{--  <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>800</h3>

              <p>Today's Work Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> --}}
        <!-- ./col -->
      </div>
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <?php   $transaction = \DB::table('transaction')->count();?>
              <h3>{{$transaction or 'NA'}}</h3>

              <p>Total Transaction</p>
            </div>
            <div class="icon">
              <i class="fa fa-credit-card"></i>
            </div>
            <a href="#" class="small-box-footer">More Info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@stop 