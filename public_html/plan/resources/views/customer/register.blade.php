<!DOCTYPE html>
<html lang="en">

<!--================================================================================
  Item Name: Materialize - Material Design Admin Template
  Version: 3.1
  Author: GeeksLabs
  Author URL: http://www.themeforest.net/user/geekslabs
================================================================================ -->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="msapplication-tap-highlight" content="no">
  <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
  <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
  <title>Register Page | Materialize - Material Design Admin Template</title>

  <!-- Favicons-->
  <link rel="icon" href="{{url('/')}}/images/favicon/favicon-32x32.png" sizes="32x32">
  <!-- Favicons-->
  <link rel="apple-touch-icon-precomposed" href="{{url('/')}}/images/favicon/apple-touch-icon-152x152.png">
  <!-- For iPhone -->
  <meta name="msapplication-TileColor" content="#00bcd4">
  <meta name="msapplication-TileImage" content="images/favicon/mstile-144x144.png">
  <!-- For Windows Phone -->


  <!-- CORE CSS-->
  
  <link href="{{url('/')}}/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{url('/')}}/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="{{url('/')}}/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{url('/')}}/css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">

  <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
  <link href="{{url('/')}}/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="{{url('/')}}/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
  
</head>

<body class="cyan">
  <!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
<style type="text/css">
    .parsley-required{
      color: #ff4081;
    }
  </style>


  <div id="login-page" class="row">
    <div class="col s12 z-depth-4 card-panel">
      <form class="login-form" action="{{url('/')}}/customer/registration_process" method="post" data-parsley-validate="">
        {{ csrf_field() }}
        <div class="row">
          <div class="input-field col s12 center">
            <h4>Register</h4>
            <p class="center">Join to our community now !</p>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-group-add prefix"></i>
            <input id="spencer_id" name="spencer_id" type="text" onchange="sponcer_name()" value="{{old('spencer_id')}}" data-parsley-required="true">
            <label for="spencer_id" class="center-align">Sponcer Id</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-assignment-ind prefix"></i>
            <input id="spencer_name" name="spencer_name" type="text" data-parsley-required="true" readonly="">
            <label for="spencer_name">Sponcer Name</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person prefix"></i>
            <input id="user_id" name="user_id" type="text" onchange="user_exist()" value="{{old('user_id')}}" data-parsley-required="true">
            <label for="user_id" class="center-align">User Id</label>
            <span style="margin-left: 45px;" id="user_id_error" class="parsley-required"></span>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
            <input id="password" name="password" type="password" data-parsley-required="true">
            <label for="password">Password</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="username" name="username" type="text" value="{{old('username')}}" data-parsley-required="true">
            <label for="username" class="center-align">Applicant Name</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-communication-phone prefix"></i>
            <input id="mobile" name="mobile" type="text" value="{{old('mobile')}}" data-parsley-required="true">
            <label for="mobile" class="center-align">Mobile</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-account-balance-wallet prefix"></i>
            <input id="pancard" name="pancard" type="text" value="{{old('pancard')}}" data-parsley-required="true">
            <label for="pancard" class="center-align">Pan Card No.</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-file-folder-shared prefix"></i>
            <input id="country" name="country" type="text" value="{{old('country')}}" data-parsley-required="true">
            <label for="country" class="center-align">Country</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-file-folder-shared prefix"></i>
            <input id="state" name="state" type="text" value="{{old('state')}}" data-parsley-required="true">
            <label for="state" class="center-align">State</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-file-folder-shared prefix"></i>
            <input id="city" name="city" type="text" value="{{old('city')}}" data-parsley-required="true">
            <label for="city" class="center-align">City</label>
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <select id="package" name="package" data-parsley-required="true">
              <option value="">Select Package</option>
              <option value="1000">1000</option>
              <option value="2000">2000</option>
              <option value="3000">3000</option>
              <option value="4000">4000</option>
              <option value="5000">5000</option>
              <option value="10000">10000</option>
              <option value="15000">15000</option>
              <option value="20000">20000</option>
              <option value="25000">25000</option>
            </select>
            <label for="package">Package</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input type="submit" id="submit" name="submit" class="btn waves-effect waves-light col s12" value="Register Now">
          </div>
          <div class="input-field col s12">
            <p class="margin center medium-small sign-up">Already have an account? <a href="{{url('/')}}/customer">Login</a></p>
          </div>
        </div>
      </form>
    </div>
  </div>
  <script type="text/javascript">
    function sponcer_name()
    {
       var id = $('#spencer_id').val();
       $.ajax({
              url: "{{url('/get_sponcer_name')}}",
              type: 'POST',
              // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
              data: {
                _method: 'POST',
                id     : id,
                _token:  '{{ csrf_token() }}'
              },
            success: function(response)
            {
                $('#spencer_name').val(response);
            }
            });
    }
    function user_exist()
    {
       var id = $('#user_id').val();
       $.ajax({
              url: "{{url('/user_exist')}}",
              type: 'POST',
              data: {
                _method: 'POST',
                id     : id,
                _token:  '{{ csrf_token() }}'
              },
            success: function(response)
            {
              if(response == '1')
              {
                $('#user_id_error').text('User id already exist.');
              }
              else if(response == '2')
              {
                $('#user_id_error').text('');
              }
              else
              {
                $('#user_id_error').text('');
              }
            }
            });
    }
  </script>



  <!-- ================================================
  Scripts
  ================================================ -->

  <!-- jQuery Library -->
  <script type="text/javascript" src="{{url('/')}}/js/plugins/jquery-1.11.2.min.js"></script>
  <!--materialize js-->
  <script type="text/javascript" src="{{url('/')}}/js/materialize.min.js"></script>
  <!--prism-->
  <script type="text/javascript" src="{{url('/')}}/js/plugins/prism/prism.js"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="{{url('/')}}/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

  <script type="text/javascript" src="{{url('/')}}/js/parsley.js"></script>

  <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <script type="text/javascript" src="{{url('/')}}/js/plugins.min.js"></script>
  <!--custom-script.js - Add your own theme custom JS-->
  <script type="text/javascript" src="{{url('/')}}/js/custom-script.js"></script>

</body>

</html>