<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{ $site_settings['site_name'] or '' }} Admin Login</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
        </style>

    </head>
    <body class="login-page">
          
        <!-- BEGIN Main Content -->
        <div class="login-wrapper">

            <!-- BEGIN Forgot Password Form -->
            <form id="form-forgot" action="{{url($admin_panel_slug)}}/reset_password/{{$user_details['token']}}/{{ base64_encode($user_details['id'])}}"  method="post">
            	 {{ csrf_field() }}

                @include('admin.layout._operation_status')  

                <h3>Reset your password</h3>
                <hr/>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" class="form-control" name="password" id="new_password" data-rule-minlength="6" data-rule-required="true" placeholder="Password"/>
                        <span class='error'>{{ $errors->first('password') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <input type="password" class="form-control" name="password_confirmation" id="confirm_password" data-rule-minlength="6" data-rule-required="true" data-rule-equalto="#new_password" placeholder="Confirm password"/>
                        <span class='error'>{{ $errors->first('password_confirmation') }}</span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-primary form-control">Recover</button>
                    </div>
                </div>
                <hr/>
                <!-- <p class="clearfix">
                    <a href="#" class="goto-login pull-left">← Back to login form</a>
                </p> -->
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
		
        </script>
    </body>
</html>

