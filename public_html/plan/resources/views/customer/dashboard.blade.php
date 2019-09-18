@extends('customer.layout.master')                

@section('main_content')

  <!-- START MAIN -->
  <div id="main">
      <!-- START WRAPPER -->
      <div class="wrapper">         

          <!-- //////////////////////////////////////////////////////////////////////////// -->

          <!-- START CONTENT -->
          <section id="content">

              <!--start container-->
              <div class="container">
                <?php
                   $user = Sentinel::check();

                ?>

                 

                  <!-- //////////////////////////////////////////////////////////////////////////// -->

                  <!--card widgets start-->
                  <div id="card-widgets">
                      <div class="row">

                              <?php
                                use App\Models\PaymentModel;
                                use App\Models\UserModel;

                                $sp_data  = [];
                                $payment = PaymentModel::where(['sender_id'=>$user->id,'status'=>'1'])->orderBy('id', 'DESC')->first();
                                if(!empty($payment))
                                {
                                  $payment_data = UserModel::where(['id'=>$payment->reciever_id])->first();
                                  if(!empty($payment_data->spencer_name))
                                  {
                                    $sp_data    = UserModel::where(['id'=>$payment_data->reciever_id])->first();
                                  }
                                }
                              ?>

                              @if(!empty($payment))
                                <script>
                                  // Set the date we're counting down to
                                  //var countDownDate = new Date("April 17, 2018 11:39:25").getTime();
                                  //alert('<?php echo(date("M d, Y H:i:s",  strtotime("+"."1 days", strtotime($payment->created_at)))); ?>');
                                  var countDownDate = new Date('<?php echo(date("M d, Y H:i:s",  strtotime("+"."28 hours", strtotime($payment->created_at)))); ?>').getTime();

                                  // Update the count down every 1 second
                                  var x = setInterval(function() {

                                      // Get todays date and time
                                      var now = new Date().getTime();
                                      
                                      // Find the distance between now an the count down date
                                      var distance = countDownDate - now;
                                      
                                      // Time calculations for days, hours, minutes and seconds
                                      var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                      var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                      var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                      var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                      
                                      // Output the result in an element with id="demo"
                                      document.getElementById("demo").innerHTML =  days + "D " + hours + "H "
                                      + minutes + "M " + seconds + "S ";
                                      
                                      // If the count down is over, write some text 
                                      if (distance < 0) {
                                          clearInterval(x);
                                          document.getElementById("demo").innerHTML = "Time Complete";
                                      }
                                  }, 1000);
                                </script>
                                <div class="col s12 m12 l4">
                                    <ul id="task-card" class="collection with-header">
                                        <li class="collection-header cyan">
                                            <h4 class="task-card-title">Send Payment</h4>
                                            <p class="task-card-date">{{date('M d, Y')}}</p>
                                            <span class="task-card-date">Time Is Remain </span><span class="task-card-date" style="color: #ff4081;font-size: 20px" id="demo"></span>
                                        </li>
                                        <li class="collection-item ">
                                            <label for="task1">Receiver Id:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{$payment_data->email or 'NA'}}</span></a>
                                            </label>
                                             <label for="task1">Mobile No.:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{$payment_data['mobile']}}</span></a>
                                            </label>
                                            <label for="task1">Sponcer Name:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{$payment_data['spencer_name'] or 'NA'}}</span></a>
                                            </label>
                                            <label for="task1">Mobile No.:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{$sp_data->mobile or 'NA'}}</span></a>
                                            </label>
                                        </li>
                                        <li class="collection-item ">
                                            <label for="task1">Bank Holder Name:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['bank_holder_name']))}}</span></a>
                                            </label>
                                            <label for="task1">Bank Name:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['bank_name']))}}</span></a>
                                            </label>
                                            <label for="task1">Branch :- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['branch']))}}</span></a>
                                            </label>
                                            <label for="task1">Account No.:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['account_no']))}}</span></a>
                                            </label>
                                            <label for="task1">IFSC Code:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['ifsc_code']))}}</span></a>
                                            </label>
                                             </li>
                                        <li class="collection-item ">
                                            <label for="task1">Paytm No.:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['paytm_no']))}}</span></a>
                                            </label>
                                            <label for="task1">BTC Address:- <a href="#" class="secondary-content">
                                              <span class="ultra-small">{{base64_decode(base64_decode($payment_data['btc_address']))}}</span></a>
                                            </label>
                                        </li>
                                    </ul>
                                </div>
                              @endif

                          <div class="col s12 m6 l4">
                              <div id="profile-card" class="card">
                                  <div class="card-image waves-effect waves-block waves-light">
                                      <img class="activator" src="{{url('/')}}/images/user-bg.jpg" alt="user background">
                                  </div>
                                  <div class="card-content">
                                      <img src="{{url('/')}}/images/user.png" alt="" class="circle responsive-img activator card-profile-image">
                                      <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                          <i class="mdi-action-account-circle"></i>
                                      </a>

                                      <span class="card-title activator grey-text text-darken-4">{{$user->user_name}}</span>
                                      <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Agent</p>
                                      <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +91 {{$user->mobile}}</p>
                                      <p><i class="mdi-communication-email cyan-text text-darken-2"></i> {{$user->email}}</p>

                                  </div>
                                  <div class="card-reveal">
                                      <span class="card-title grey-text text-darken-4">{{$user->user_name}} <i class="mdi-navigation-close right"></i></span>
                                      <p>Here is some more information about agent.</p>
                                      <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Project Manager</p>
                                      <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +91 {{$user->mobile}}</p>
                                      <p><i class="mdi-communication-email cyan-text text-darken-2"></i> {{$user->email}}</p>
                                     {{--  <p><i class="mdi-social-cake cyan-text text-darken-2"></i> 18th June 1990</p>
                                      <p><i class="mdi-device-airplanemode-on cyan-text text-darken-2"></i> BAR - AUS</p> --}}
                                  </div>
                              </div>
                          </div>

                          <div class="col s12 m6 l4">
                              <div id="flight-card" class="card">
                                  <div class="card-header amber darken-2">
                                      <div class="card-title">
                                          <h4 class="flight-card-title">INDIA</h4>
                                          <p class="flight-card-date">{{date('M d, D h:m')}}</p>
                                      </div>
                                  </div>
                                  <div class="card-content-bg white-text">
                                      <div class="card-content">
                                          <div class="row flight-state-wrapper">
                                              <div class="col s5 m5 l5 center-align">
                                                  <div class="flight-state">
                                                      <h4 class="margin">LDN</h4>
                                                      <p class="ultra-small">Growth Start</p>
                                                  </div>
                                              </div>
                                              <div class="col s2 m2 l2 center-align">
                                                  <i class="mdi-device-airplanemode-on flight-icon"></i>
                                              </div>
                                              <div class="col s5 m5 l5 center-align">
                                                  <div class="flight-state">
                                                      <h4 class="margin">SFO</h4>
                                                      <p class="ultra-small">Growth Stop</p>
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="row">
                                              <div class="col s6 m6 l6 center-align">
                                                  <div class="flight-info">
                                                      <p class="small"><span class="grey-text text-lighten-4">Depart:</span> 23:59</p>
                                                      <p class="small"><span class="grey-text text-lighten-4">Night</p>
                                                      <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> A</p>
                                                  </div>
                                              </div>
                                              <div class="col s6 m6 l6 center-align flight-state-two">
                                                  <div class="flight-info">
                                                      <p class="small"><span class="grey-text text-lighten-4">Arrive:</span> 00:00</p>
                                                      <p class="small"><span class="grey-text text-lighten-4">Night</p>
                                                      <p class="small"><span class="grey-text text-lighten-4">Terminal:</span> B</p>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          
                      <div class="row">
                          <!-- map-card -->
                          <div class="col s12 m12 l4" style="display: none;">
                              <div class="map-card">
                                  <div class="card">
                                      <div class="card-image waves-effect waves-block waves-light">
                                          <div id="map-canvas" data-lat="40.747688" data-lng="-74.004142"></div>
                                      </div>
                                      <div class="card-content">                    
                                          <a class="btn-floating activator btn-move-up waves-effect waves-light darken-2 right">
                                              <i class="mdi-maps-pin-drop"></i>
                                          </a>
                                          <h4 class="card-title grey-text text-darken-4"><a href="#" class="grey-text text-darken-4">Company Name LLC</a>
                                          </h4>
                                          <p class="blog-post-content">Some more information about this company.</p>
                                      </div>
                                      <div class="card-reveal">
                                          <span class="card-title grey-text text-darken-4">Company Name LLC <i class="mdi-navigation-close right"></i></span>                   
                                          <p>Here is some more information about this company. As a creative studio we believe no client is too big nor too small to work with us to obtain good advantage.By combining the creativity of artists with the precision of engineers we develop custom solutions that achieve results.Some more information about this company.</p>
                                          <p><i class="mdi-action-perm-identity cyan-text text-darken-2"></i> Manager Name</p>
                                          <p><i class="mdi-communication-business cyan-text text-darken-2"></i> 125, ABC Street, New Yourk, USA</p>
                                          <p><i class="mdi-action-perm-phone-msg cyan-text text-darken-2"></i> +1 (612) 222 8989</p>
                                          <p><i class="mdi-communication-email cyan-text text-darken-2"></i> support@geekslabs.com</p>                    
                                      </div>
                                  </div>
                              </div>
                          </div>

                  </div>
                  <!--card widgets end-->

                  <!-- //////////////////////////////////////////////////////////////////////////// -->

                   <!--card stats start-->
                  <div id="card-stats">
                      <div class="row">
                          <div class="col s12 m6 l3">
                              <div class="card">
                                  <div class="card-content  green white-text">
                                      <p class="card-stats-title"><i class="mdi-social-group-add"></i> Self Team</p>
                                      <h4 class="card-stats-number">566</h4>
                                      <p class="card-stats-compare"> 55% <span class="green-text text-lighten-5">from last month</span>
                                      </p>
                                  </div>
                                  <div class="card-action  green darken-2">
                                      <div id="clients-bar" class="center-align"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col s12 m6 l3">
                              <div class="card">
                                  <div class="card-content pink lighten-1 white-text">
                                      <p class="card-stats-title"><i class="mdi-editor-insert-drive-file"></i> Direct Level</p>
                                      <h4 class="card-stats-number">1806</h4>
                                      <p class="card-stats-compare"> 49% <span class="deep-purple-text text-lighten-5">from last month</span>
                                      </p>
                                  </div>
                                  <div class="card-action  pink darken-2">
                                      <div id="invoice-line" class="center-align"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col s12 m6 l3">
                              <div class="card">
                                  <div class="card-content blue-grey white-text">
                                      <p class="card-stats-title"><i class="mdi-action-trending-up"></i> Parent User Id</p>
                                      <h4 class="card-stats-number">{{$user->spencer_name}}</h4>
                                      <p class="card-stats-compare">Mobile No.-NA</span>
                                      </p>
                                  </div>
                                  <div class="card-action blue-grey darken-2">
                                      <div id="profit-tristate" class="center-align"></div>
                                  </div>
                              </div>
                          </div>
                          <div class="col s12 m6 l3">
                              <div class="card">
                                  <div class="card-content purple white-text">
                                      <p class="card-stats-title">My User Id</p>
                                      <h4 class="card-stats-number">{{$user->user_name}}</h4>
                                      <p class="card-stats-compare">Mobile No.{{$user->mobile}}</span>
                                      </p>
                                  </div>
                                  <div class="card-action purple darken-2">
                                      <div id="sales-compositebar" class="center-align"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!--card stats end-->

              </div>
              <!--end container-->
          </section>
          <!-- END CONTENT -->

          <!-- //////////////////////////////////////////////////////////////////////////// -->

      </div>
      <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

@stop 