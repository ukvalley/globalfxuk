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
    <section class="content light-blue">

<?php
 $data_news = \DB::table('newsfeed')->where('id','=','1')->first();
 $user = Sentinel::check();

?>


    <div class="row">
 <div class="col-lg-12 col-xs-12">

   <div class="col-lg-12 col-xs-12">
 <a href="{{url('/')}}/admin/withdrawl">
 <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>

 

            <div class="info-box-content">
              <span class="info-box-text">Available Balance</span>
              @if($user->is_active=='2')
              <span class="info-box-number">$ {{$wallet_details['wallet_amount']}}</span>
              @else
              <span class="info-box-number">Inactive Account</span>
              @endif

              <div class="progress">
                <div class="progress-bar progress-bar-primary progress-bar-striped" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: {{($wallet_details['wallet_amount'])/0.2}}%"></div>
              </div>
              <span class="progress-description">
                    Click Here to get wallet balance
                  </span>
            </div>
            <!-- /.info-box-content -->
          </div> </a>
          </div>
</div>
     </div>
     
      

      <div class="row">
        <div class="col-lg-12 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
            <h4>Total Invested</h4>  
            
           <h3>$ {{$wallet_details['total_fund']}}</sup></h3>       
                 <p>{{$user->plan}}</p>
           

                <a href="{{url('/')}}/admin/add_fund"> <button class="btn bg-maroon btn-flat margin">Add More</button></a>
           
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">more info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      
      
       

  
             

  <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              
                @if($user->is_active=='2')
              <h3>$ {{$wallet_details['growth_income']}}</sup></h3>
                @else
                <h3>Inactive Account</sup></h3>
                @endif
              
                 <p>Growth Income</p>
             
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">Growth Income<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      
    


        





        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
            
               
               @if($user->is_active=='2')
              <h3>$ {{$wallet_details['level_income']}}</h3>
               @else
                <h3>Inactive Account</sup></h3>
                @endif
            

              <p>Total Level Income</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Level Income<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->





        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              

                 @if($user->is_active=='2')
                <h3>$ {{$wallet_details['referal_income']}}</h3>
                @else
                <h3>Inactive Account</sup></h3>
                @endif
              <p>Promotional Bonus</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Promotional Bonus<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->








          <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
                
           
               @if($user->is_active=='2')
              <h3>$ {{$wallet_details['wallet_amount']}}</sup></h3>
               @else
                <h3>Inactive Account</sup></h3>
                @endif
              

              <p>Wallet Balance</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">Wallet Balance<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->






 <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
               
               @if($user->is_active=='2')
              <h3>$ {{$wallet_details['total_withdrawl']}}</h3>
                @else
                <h3>Inactive Account</sup></h3>
                @endif

              <p>Total Withdrawl Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Total Withdrawl Amount<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        
        
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
               
              @if($user->is_active=='2')
              <h3>$ {{$wallet_details['pending_withdrawl']}}</h3>
                @else
                <h3>Inactive Account</sup></h3>
                @endif

              <p>Pending Withdrawl Amount</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">Pending Withdrawl Amount<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

         <div class="box-body" style="overflow-x:auto;">
          <h3>Top Users</h3>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Sr. No.</th>
                  <th>Partner</th>
                  <th>Invested By</th>
                  <th>Rev</th>
                  <th>Status</th>
                  

                </tr>
                </thead>
                <tbody>
                  <?php
                 $data= \DB::table('top_users')->get();
                  ?>
                  @foreach($data as $key=>$value)
                    <tr>
                      <td>{{$key+1}}</td>
                     
                      <td>{{$value->Partner}}</td>
                       
                      <td>${{$value->Invested}}</td>
                      <td>${{$value->rev}}</td>
                       <td>{{$value->status}}</td>
                       

                    
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>





      <!-- /.row -->
   
   
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script>
function myFunction() {
  /* Get the text field */
  var copyText = document.getElementById("myInput");

  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Copied the text: " + copyText.value);
}
</script>

@stop 