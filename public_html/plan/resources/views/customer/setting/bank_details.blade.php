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
                      <h5 class="breadcrumbs-title">Setting</h5>
                      <ol class="breadcrumbs">
                        <li><a href="{{url('/customer/dashboard')}}">Dashboard</a>
                        </li>
                        <li><a href="#">Setting</a>
                        </li>
                        <li class="active">Bank Details</li>
                      </ol>
                    </div>
                  </div>
                </div>

            <div id="basic-form" class="section">
              <div class="row">
                <div class="col s12 m12 8">
                   @include('admin.layout._operation_status')
                  <div class="card-panel">
                    <h4 class="header2">Bank Details</h4>
                    <div class="row">
                      <form class="col s12" method="post" action="{{url('/')}}/customer/store_bank_details" data-parsley-validate="">
                        {{ csrf_field() }}
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="bank_name" name="bank_name" type="text" value="{{ (!empty($data[0]['bank_name']))?base64_decode(base64_decode($data[0]['bank_name'])):""}}" data-parsley-required="true">
                            <label for="bank_name">Bank Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="bank_holder_name" name="bank_holder_name" type="text" value="{{ (!empty($data[0]['bank_holder_name']))?base64_decode(base64_decode($data[0]['bank_holder_name'])):""}}" data-parsley-required="true">
                            <label for="bank_holder_name">Bank Holder Name</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="branch" name="branch" type="text" value="{{ (!empty($data[0]['branch']))?base64_decode(base64_decode($data[0]['branch'])):""}}" data-parsley-required="true">
                            <label for="branch">Branch</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="ifsc_code" name="ifsc_code" type="text" value="{{ (!empty($data[0]['ifsc_code']))?base64_decode(base64_decode($data[0]['ifsc_code'])):""}}" data-parsley-required="true">
                            <label for="ifsc_code">IFSC Code</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
                            <input id="account_no" name="account_no" type="text" value="{{ (!empty($data[0]['account_no']))?base64_decode(base64_decode($data[0]['account_no'])):""}}">
                            <label for="account_no">Account No.</label>
                          </div>
                        </div>
                      {{--   <div class="row">
                          <div class="input-field col s12">
                            <input id="atm_card_no" name="atm_card_no" type="text" value="{{ (!empty($data[0]['atm_card_no']))?base64_decode(base64_decode($data[0]['atm_card_no'])):""}}" data-parsley-required="true">
                            <label for="atm_card_no">ATM Card No.</label>
                          </div>
                        </div> --}}
                         <div class="row">
                          <div class="input-field col s12">
                            <input id="paytm_no" name="paytm_no" type="text" value="{{ (!empty($data[0]['paytm_no']))?base64_decode(base64_decode($data[0]['paytm_no'])):""}}" data-parsley-required="true">
                            <label for="paytm_no">Paytm No.</label>
                          </div>
                        </div>
                         <div class="row">
                          <div class="input-field col s12">
                            <input id="btc_address" name="btc_address" type="text" value="{{ (!empty($data[0]['btc_address']))?base64_decode(base64_decode($data[0]['btc_address'])):""}}" data-parsley-required="true">
                            <label for="btc_address">BTC Address</label>
                          </div>
                        </div>
                        <div class="row">
                          <div class="input-field col s12">
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