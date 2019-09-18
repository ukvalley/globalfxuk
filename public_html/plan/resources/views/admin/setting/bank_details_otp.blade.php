@extends('admin.layout.master')                

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

                  <!--card widgets start-->
                  <div id="card-widgets">
                    <div class="row" style="display: none;">
                      <!-- map-card -->
                      <div class="col s12 m12 l4">
                          <div class="map-card">
                              <div class="card">
                                  <div class="card-image waves-effect waves-block waves-light">
                                      <div id="map-canvas" data-lat="40.747688" data-lng="-74.004142"></div>
                                  </div>
                              </div>
                          </div>
                      </div>
                    </div>
                  </div>
                </div>  

                <div class="container">
                  <div class="row">
                    <div class="col s12 m12 12">
                      <h5 class="breadcrumbs-title">OTP Verification</h5>
                      <ol class="breadcrumbs">
                        <li><a href="{{url('/admin/dashboard')}}">Dashboard</a>
                        </li>
                        <li><a href="#">Setting</a>
                        </li>
                        <li class="active">OTP Verification</li>
                      </ol>
                    </div>
                  </div>
                </div>

            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m6 8">
                  @include('admin.layout._operation_status')
                  <div class="card-panel">
                    <h4 class="header2">OTP Verification</h4>
                    <div class="row">
                      <form class="col s12" method="post" action="{{url('/')}}/admin/activate_bank_details" data-parsley-validate="">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="otp" name="otp" type="text" data-parsley-required="true">
                            <label for="otp">Enter OTP</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s6">
                            <a href="{{url('/admin/resend_otp')}}" class="btn cyan waves-effect waves-light right" id="submit" name="submit" value="Resent OTP">Resent OTP</a>
                          </div>
                          <div class="input-field col s6">
                            <input type="submit" class="btn cyan waves-effect waves-light right" id="submit" name="submit">
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          
            <!--end container-->
          </section>
          <!-- END CONTENT -->

      </div>
      <!-- END WRAPPER -->

  </div>
  <!-- END MAIN -->

@stop 