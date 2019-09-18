 <!-- START LEFT SIDEBAR NAV-->
          <aside id="left-sidebar-nav">
              <ul id="slide-out" class="side-nav fixed leftside-navigation">
              <li class="user-details cyan darken-2">
              <div class="row">
                  <div class="col col s4 m4 l4">
                      <img src="{{url('/')}}/images/user.png" alt="" class="circle responsive-img valign profile-image">
                  </div>
                 <div class="col col s8 m8 l8">
                      <ul id="profile-dropdown" class="dropdown-content">
                          <li><a href="{{url('/customer/bank_details')}}"><i class="mdi-action-account-balance"></i> Bank </a>
                          </li>
                          <li><a href="#"><i class="mdi-communication-live-help"></i> Help</a>
                          </li>
                          <li class="divider"></li>
                          <li><a href="{{url('/')}}/customer/logout"><i class="fa fa-close"></i> Logout</a>
                          </li>
                      </ul>
                      <?php $user = Sentinel::getUser();?>
                      <a class="btn-flat dropdown-button waves-effect waves-light white-text profile-btn" href="#" data-activates="profile-dropdown">{{$user->user_name or "NOT AVAILABLE"}}<i class="mdi-navigation-arrow-drop-down right"></i></a>
                     
                  </div>
              </div>
              </li>
              <li class="bold active"><a href="{{url('/')}}/customer/dashboard" class="waves-effect waves-cyan"><i class="mdi-action-dashboard"></i> Dashboard</a>
              </li>
              <li class="no-padding">
                  <ul class="collapsible collapsible-accordion">
                      <?php 
                      $user = Sentinel::check();
                      if($user->user_activity=='package' && $user->status=='approved')
                      {
                      ?>
                      {{-- <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="mdi-social-group-add"></i>Account</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li>
                                    <a href="{{url('/')}}/customer/new_joining">New Joining</a>
                                  </li>
                              </ul>
                          </div>
                      </li> --}}
                      <?php }?>
                      <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-check-square"></i>Activation</a>
                          <div class="collapsible-body">
                              <ul>
                                  @if($user->status!='approved')
                                  <li>
                                    <a href="{{url('/')}}/customer/upload_recipient">Upload Recipient</a>
                                  </li>
                                  @endif
                                  {{-- <li>
                                    <a href="{{url('/')}}/customer/approve_payment">Approve Payment</a>
                                  </li> --}}
                                  <li>
                                    <a href="{{url('/')}}/customer/approve_payment_withdraw">Approve Pay- Withdraw</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <?php 
                      $user = Sentinel::check();
                      if($user->user_activity=='package' && $user->status=='approved')
                      {
                      ?>
                      <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="mdi-content-archive"></i>Downline</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li>
                                    <a href="{{url('/')}}/customer/my_direct">My Direct</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/self_team">Self Team View</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/level_view">Level View</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="mdi-action-account-balance"></i>Payout Statement</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li>
                                    <a href="{{url('/')}}/customer/direct_income">View Direct Income</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/level_income">View Level Income</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/growth_income">Daily Growth Income</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/work_withdrawal">Work Withdrawal</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/growth_withdrawal">Growth Withdrawal</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                     {{--  <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="mdi-maps-local-atm"></i>All Transaction</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li>
                                    <a href="{{url('/')}}/customer/my_provided_donation">My Provided Donation</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/my_receive_donation">My Receive Donation</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/my_withdrawal">My Withdrawal</a>
                                  </li>
                              </ul>
                          </div>
                      </li> --}}
                      <li class="bold">
                          <a class="collapsible-header waves-effect waves-cyan"><i class="fa fa-cog"></i>Setting</a>
                          <div class="collapsible-body">
                              <ul>
                                  <li>
                                    <a href="{{url('/')}}/customer/bank_details">Bank Details</a>
                                  </li>
                                  <li>
                                    <a href="{{url('/')}}/customer/change_password">Change Passowrd</a>
                                  </li>
                              </ul>
                          </div>
                      </li>
                      <?php }?>
                      {{-- <li class="bold"><a href="{{url('/')}}/customer/notification" class="waves-effect waves-cyan"><i class="fa fa-bell"></i> Notification</a> --}}
                      <li class="bold"><a href="{{url('/')}}/customer/logout" class="waves-effect waves-cyan"><i class="fa fa-close"></i> Logout</a>
              </li>
                      
                  </ul>
              </li>
          </ul>
              <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only cyan"><i class="mdi-navigation-menu"></i></a>
          </aside>
          <!-- END LEFT SIDEBAR NAV-->