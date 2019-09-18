  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{url('/')}}/dist/img/avatar04.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <?php
            $user = Sentinel::check();
          ?>
          <p>{{$user->user_name or 'User'}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="{{url('/')}}/admin/dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            {{-- <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span> --}}
          </a>
        </li>
        <?php 
        if($user->is_admin=='1'){?>
         <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-user"></i>Admin <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/change_password" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Change Password</a>
            </li>
             <li>
              <a href="{{url('/')}}/admin/btc_change" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Change BTC</a>
            </li>
          </ul>
        </li>
         <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-users"></i>Users <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/user_list" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Users List</a>
            </li>
            <li>
              <a href="{{url('/')}}/admin/block_user_list" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Block Users</a>
            </li>
            <!-- <li>
              <a href="{{url('/')}}/admin/recommitment_user_list" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Recommitment Users</a>
            </li> -->
          </ul>
       <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>My Team <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <!--  <li>
              <a href="{{url('/')}}/admin/work_income" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Accept Payment</a>
            </li> -->
           <!--  <li>
               <a href="{{url('/')}}/admin/level_tree?id={{$user->email}}" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Geneology</a>
            </li>
            -->
<!-- <li>
              <a href="{{url('/')}}/admin/user_transaction_daily_admin" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Daily-Transction</a>
            </li> -->
          </ul>
        </li>


         <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Withdrawal<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/withdrawl_request" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Withdrawal Requests</a>
            </li>
            <li>
               <a href="{{url('/')}}/admin/withdrawl_history" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Withdrawal history</a>
            </li>
            

          </ul>
        </li>


         <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Return<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/create_return" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Create Return</a>
            </li>
            <li>
               <a href="{{url('/')}}/admin/all_return" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>View Returns</a>
            </li>
            

          </ul>
        </li>




        <!--  <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Epin Management<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/epin_generate" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Generate Epin</a>
            </li>

            <li>
              <a href="{{url('/')}}/admin/unused_pin" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Activate user</a>
            </li>

           
            <li>
               <a href="{{url('/')}}/admin/transfer_epin" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Transfer Epin</a>
            </li>
            <li>
               <a href="{{url('/')}}/admin/epin_transaction" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Epin Transaction</a>
            </li>
 <li>
              <a href="{{url('/')}}/admin/user_transaction_daily_admin" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Daily-Transction</a>
            </li> 
          </ul>
        </li>
 -->

       
        <li>
         <a href="{{url('/')}}/admin/add_fund_request" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>Add Fund Requests</a>
        </li>
       

        <li>
         <a href="{{url('/')}}/admin/support" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i> Support</a>
        </li>

<li>
<a href="{{url('/')}}/admin/user_mobile" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i> Send SMS</a>
</li>

<li>
<a href="{{url('/')}}/admin/news_feed" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>DashBoard News</a>
</li>




        <?php }else{ ?>
        <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-user"></i>My Profile <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/profile_edit" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Change Profile</a>
            </li>
            <!--<li>
              <a href="{{url('/')}}/admin/bank_edit" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Change Bank Details</a>
            </li>-->
            <li>
              <a href="{{url('/')}}/admin/change_password" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Change Password</a>
            </li>
           <!--  <li>
              <a href="{{url('/')}}/admin/change_trans_password" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Change Transaction Pin</a>
            </li>
<li>
              <a href="{{url('/')}}/admin/forgot_tpin" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Forget Transaction Pin</a>
            </li> -->
          </ul>
        </li>
        <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Team & Network <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/self_team" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>My Team</a>
            </li>
          <!--   <li>
              <a href="{{url('/')}}/admin/level_tree?id={{$user->email}}" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Geneology Tree</a>
            </li> -->
          </ul>
        </li>



        <li class="bold"><a href="{{url('/')}}/admin/user_level_income" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>Level Income</a>


           <li class="bold"><a href="{{url('/')}}/admin/referal_bonus_income" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>Promotional Bonus</a>

             <li class="bold"><a href="{{url('/')}}/admin/u_daily_income" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>Growth Income</a>

               <li class="bold"><a href="{{url('/')}}/admin/user_transaction" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i>Withdrawl History</a>
        
        
       
        
        
      <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Wallet<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
              
              <li>
              <a href="{{url('/')}}/admin/withdrawl" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Withdrawl Payment</a>
            </li>
              
           
         
          </ul>
        </li>
        
        
           <!-- <li>
              <a href="{{url('/')}}/admin/u_work_income" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i> Accept payments</a>
            </li>
         -->
         <!-- <li class="treeview">
          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-image"></i>Rewards Income<span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li>
              <a href="{{url('/')}}/admin/self_team" class="waves-effect waves-cyan"><i class="fa fa-circle-o"></i>Rewards History</a>
            </li>
            
          </ul>
        </li> -->
        

         
        
        
        
        
        
        <li class="bold"><a href="{{url('/')}}/admin/u_support" class="waves-effect waves-cyan"><i class="fa fa-angellist"></i> Support</a>

        <?php }?>
        <li class="bold"><a href="{{url('/')}}/admin/logout" class="waves-effect waves-cyan"><i class="fa fa-close"></i> Logout</a>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->

  </aside>