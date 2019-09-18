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
              <h3 class="box-title">Recommitment User List</h3>
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
                  <th>Action</th>
               
                  
                </tr>
                </thead>
                
                
           <tbody>
              
                
                 
                  @foreach($data as $key=>$value)
                   <?php $day = 15; $amount =0; $counter = 0; ?>
                    @for ($i =1; $i <= 15; $i++)
                      <?php 
                
                  $counter++;
                  if($value->joining_date==null)
                  {
                    break;
                  }
                  $date = date('d-m-Y', strtotime($value->joining_date. ' + '.$counter.' day'));
               
                  if(date('l', strtotime($date))=='Saturday' || date('l', strtotime($date))=='Sunday')
                  {
                    $i--;
                    continue;
                    
                   // $amount = $amount-400;
                  }
                   if(strtotime($date)<=strtotime(date('d-m-Y')))
                  {
                      $day = $day-1;
                  }
                 
                  ?>
                  @endfor
                <?php $amt =  4000-(200*(20-$day)) ?>
                      <tr>
                         @if($amt<=0)
                      <td>{{$key+1}}</td>
                      <td>{{$value->email}}</td>
                      <td>{{$value->user_name}}</td>
                      <td>{{$value->spencer_id}}</td>
                      <td>{{$value->mobile}}</td>
                     <td> <a href="{{url('/')}}/admin/recommit?email={{$value->email}}" class="btn bg-red">Recommitment</a></td>
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