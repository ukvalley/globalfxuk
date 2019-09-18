<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $site_settings['site_name'] or '' }} Admin Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="{{url('/')}}/favicon.ico" type="image/x-icon" />
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <!--base css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/font-awesome/css/font-awesome.min.css">

        <!--page specific css styles-->
        <link rel="stylesheet" type="text/css" href="{{ url('/') }}/assets/chosen-bootstrap/chosen.min.css">
        
        <!--flaty css styles-->
        <link rel="stylesheet" href="{{ url('/') }}/assets/admin/css/flaty.css">
        <link rel="stylesheet" href="{{ url('/') }}/assets/admin/css/flaty-responsive.css">

        <link rel="shortcut icon" href="{{ url('/') }}/img/favicon.ico">

        <style type="text/css">
        .error
        {
            color: red;
        }

        .login-page::before, .error-page::before, #main-content 
        {
                /*background-image: url("{{url('/')}}/assets/admin/img/demo/video-02b.jpg")!important;*/
                background-size: 100% 100%;
                background-repeat: no-repeat;
        }
        .login-page .login-wrapper 
        {
            /*position: fixed!important;*/
            z-index: 2!important;
            /*margin-left: 115px!important;*/
            /*border:2px solid #E9ECF3!important;*/
        }

        .login-page .login-wrapper h3
        {
            text-align: center!important;
        }
        

        .login-page .login-wrapper form 
        {
            background-color: #424242!important;
            opacity: 0.9;
            margin: 0 auto;
            padding: 20px;
            width: 340px;
            color: #fff;
            border:2px solid #E9ECF3!important;
        }
        .help-block
        {
            color: #DF0101!important;
            font-weight: bold;
        }
        </style>

    </head>
    <body class="login-page">

        <!-- BEGIN Main Content -->
        <div class="login-wrapper" >
            <!-- BEGIN Login Form -->
            {{-- 
            {!! Form::open([ 'url' => $admin_panel_slug.'/process_login',
                                 'method'=>'POST',
                                 'id'=>'form-login' 
                                ]) !!}  --}}
            <form method="POST" id="form-login" action="{{url($admin_panel_slug)}}/process_login">
                                    
                  
                 
            	 {{ csrf_field() }}

                 
                
                <h3>
                {{-- <a href="{{url('/')}}" class="hidden-xs  hidden-sm"><img src="{{url('/')}}/front/images/virtual-logo.png" alt="virtual home concept logo" height="55" style="margin-bottom:10px;" /> </a> --}}
                <br/>
                Login to your account
                </h3>
                <hr/>
                    <div id="op_status">
                       @if(Session::has('success'))
                          <div class="alert alert-success alert-dismissible">
                          <button type="button" class="close" style="margin-top: -12px;" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times" style="color: #000000;" ></i>
                          </button>
                              {{ Session::get('success') }}
                          </div>
                       @endif  

                       @if(Session::has('error'))
                           <div class="alert alert-danger alert-dismissible">
                           <button type="button" class="close" style="margin-top: -12px;" data-dismiss="alert" aria-label="Close">
                            <i class="fa fa-times" style="color: #000000;" ></i> 
                            </button>
                            {{ Session::get('error') }}
                           </div>
                       @endif 
                    </div>

                
                <div class="form-group " >
                    <div class="controls">
                        <input type="text" name="email" class="form-control" placeholder="Email" data-rule-required="true" data-rule-email="true">
                        <span class="error">{{ $errors->first('email') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" name="password" class="form-control" data-rule-required="true" placeholder="Password">
                        <span class="error">{{ $errors->first('password') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                    <input type="submit" class="btn btn-primary form-control" value="Sign In">
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <a href="#" class="goto-forgot pull-left">Forgot Password?</a>
                </p>
            </form>
            <!-- END Login Form -->

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="{{url($admin_panel_slug)}}/forgot_password"  method="post" style="display:none">
            	 {{ csrf_field() }}

                <h3>Get back your password</h3>
                <hr/>
                  <div id="op_status_forgot">
                    @if(Session::has('success_fp'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ Session::get('success_fp') }}
                    </div>
                  @endif  

                  @if(Session::has('error_fp'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        {{ Session::get('error_fp') }}
                    </div>
                  @endif
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="text" placeholder="Email" class="form-control" data-rule-required="true" data-rule-email="true" name="email"/>
                        <span class="error">{{ $errors->first('email') }} </span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary form-control" id="form-forgot-btn-submit">Recover</button>
                    </div>
                </div>
                <hr/>
                <p class="clearfix">
                    <a href="#" class="goto-login pull-left">← Back to login form</a>
                </p>
            </form>
            <!-- END Forgot Password Form -->
        </div>
        <!-- END Main Content -->


        <!--basic scripts-->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="{{ url('/') }}/assets/jquery/jquery-2.1.4.min.js"><\/script>')</script>
        <script src="{{ url('/') }}/assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="{{ url('/') }}/assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
        <script src="{{ url('/') }}/assets/jquery-cookie/jquery.cookie.js"></script>


        <script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/jquery.validate.min.js"></script>
		<script type="text/javascript" src="{{ url('/') }}/assets/jquery-validation/dist/additional-methods.min.js"></script>
        <script type="text/javascript" src="{{ url('/') }}/assets/chosen-bootstrap/chosen.jquery.min.js"></script>
        

        <!--flaty scripts-->
        <script src="{{ url('/') }}/assets/admin/js/flaty.js"></script>
        <script src="{{ url('/') }}/assets/admin/js/flaty-demo-codes.js"></script>
        <script src="{{ url('/') }}/assets/admin/js/validation.js"></script>

        <script type="text/javascript">



        $(document).ready(function () 
        {
            <?php
            if(Session::has('success_fp') || Session::has('error_fp'))
            {
            ?>

                 goToForm('forgot');

           <?php
            }
            ?>
           
        });

            function goToForm(form)
            {
                $('.login-wrapper > form:visible').fadeOut(500, function(){
                    $('#form-' + form).fadeIn(500);
                });
            }
            $(function() 
            {
                $('.goto-login').click(function(){
                    goToForm('login');
                });
                $('.goto-forgot').click(function(){
                    goToForm('forgot');
                });
                $('.goto-register').click(function(){
                    goToForm('register');
                });

                applyValidationToFrom($("#form-login"))
                applyValidationToFrom($("#form-forgot"))
            });


          setTimeout(function()
          {
            $("#op_status").fadeOut();
            $("#op_status_forgot").fadeOut();
            
          },5000);
		

           $('#form-forgot').submit(function () 
           {
                if ($('#form-forgot').valid())
                 {
                    jQuery('#form-forgot-btn-submit').prop('disabled', true);
                 }
              
           });
        </script>
    </body>
</html>

