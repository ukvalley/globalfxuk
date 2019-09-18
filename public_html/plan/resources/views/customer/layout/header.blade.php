<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Life time help Organisation</title>

    <!-- Favicons-->
    <link rel="icon" href="{{url('/')}}/images/favicon/favicon-32x32.png" sizes="32x32">
    <!-- Favicons-->
    <link rel="apple-touch-icon-precomposed" href="{{url('/')}}/images/favicon/apple-touch-icon-152x152.png">
    <!-- For iPhone -->
    <meta name="msapplication-TileColor" content="#00bcd4">
    <meta name="msapplication-TileImage" content="{{url('/')}}/images/favicon/mstile-144x144.png">
    <!-- For Windows Phone -->

    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{url('/')}}/js/plugins/prism/prism.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{url('/')}}/js/plugins/data-tables/css/jquery.dataTables.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{url('/')}}/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">



    <!-- CORE CSS-->    
    <link href="{{url('/')}}/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{url('/')}}/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="{{url('/')}}/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
    <link href="{{url('/')}}/js/plugins/perfect-scrollbar/perfect-scrollbar.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{url('/')}}/js/plugins/jvectormap/jquery-jvectormap.css" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{url('/')}}/js/plugins/chartist-js/chartist.min.css" type="text/css" rel="stylesheet" media="screen,projection">


</head>

<body>
    <!-- Start Page Loading -->
    <div id="loader-wrapper">
        <div id="loader"></div>        
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
    <!-- End Page Loading -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START HEADER -->
    <header id="header" class="page-topbar">
        <!-- start header nav-->
        <div class="navbar-fixed">
            <nav class="navbar-color">
                <div class="nav-wrapper">
                    <ul class="left">                      
                      <li><h1 class="logo-wrapper"><a href="{{url('/')}}" class="brand-logo darken-1"><img src="{{url('/')}}/images/materialize-logo.png" alt="materialize logo"></a> <span class="logo-text">Materialize</span></h1></li>
                    </ul>
                    <div class="header-search-wrapper hide-on-med-and-down">
                        <i class="mdi-action-search"></i>
                        <input type="text" name="Search" class="header-search-input z-depth-2" placeholder="Explore Your Idea"/>
                    </div>
                    <ul class="right hide-on-med-and-down">
                       {{--  <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button"  data-activates="translation-dropdown"><img src="{{url('/')}}/images/flag-icons/United-States.png" alt="USA" /></a>
                        </li> --}}
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light toggle-fullscreen"><i class="mdi-action-settings-overscan"></i></a>
                        </li>
                        <li><a href="javascript:void(0);" class="waves-effect waves-block waves-light notification-button" data-activates="notifications-dropdown"><i class="mdi-social-notifications"><small class="notification-badge"><span id="noti_count_1">0</span></small></i>
                        
                        </a>
                        </li>                        
                       {{--  <li><a href="#" data-activates="chat-out" class="waves-effect waves-block waves-light chat-collapse"><i class="mdi-communication-chat"></i></a>
                        </li> --}}
                    </ul>
                    <!-- translation-button -->
                    <ul id="translation-dropdown" class="dropdown-content">
                      <li>
                        <a href="#!"><img src="{{url('/')}}/images/flag-icons/United-States.png" alt="English" />  <span class="language-select">English</span></a>
                      </li>
                    </ul>
                    <?php
                        $arr_data_ = [];
                        $user_status = Sentinel::check();
                        if($user_status)
                        {
                            $data_ = DB::table('notifications')
                                ->where(['user_id'=>$user_status->id,'is_seen'=>0])
                                ->get();
                        }
                    ?>
                    <!-- notifications-dropdown -->
                    <ul id="notifications-dropdown" class="dropdown-content">
                      <li>
                        <h5>NOTIFICATIONS {{-- <span id="noti_count_2" class="new badge"></span> --}}</h5>
                      </li>
                      <li class="divider"></li>
                     <?php
                        if(!empty($data_))
                        {
                            foreach ($data_ as $key => $value) 
                            {
                     ?>
                              <li>
                                <a href="#!"><i class="mdi-action-stars"></i> {{$value->notification_text}}</a>
                                <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">{{-- 3 days ago --}}</time>
                              </li>
                      <?php 
                            }
                        }

                      ?>
                      <li>
                        <a href="javascript:void(0);{{-- url('/admin/notification') --}}"><i class="mdi-action-trending-up"></i>All Notification</a>
                        <time class="media-meta" datetime="2015-06-12T20:50:48+08:00">See Recent Notifiction</time>
                      </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- end header nav-->
    </header>
    <style type="text/css">
        .parsley-required{
          color: #ff4081;
        }
    </style>
    <!-- END HEADER -->

    <!-- //////////////////////////////////////////////////////////////////////////// -->