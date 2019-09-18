<!-- //////////////////////////////////////////////////////////////////////////// -->

    <!-- START FOOTER -->
    <footer class="page-footer">
        <div class="footer-copyright">
            <div class="container">
                Copyright © 2018 <a class="grey-text text-lighten-4" href="{{url('/')}}" target="_blank">www.lalifetimehelp.org</a> All rights reserved.
              {{--   <span class="right"> Design and Developed by <a class="grey-text text-lighten-4" href="http://geekslabs.com/">GeeksLabs</a></span> --}}
            </div>
        </div>
    </footer>
    <!-- END FOOTER -->


    <!-- ================================================
    Scripts
    ================================================ -->
    
    <!-- jQuery Library -->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/jquery-1.11.2.min.js"></script>    
    <!--materialize js-->
    <script type="text/javascript" src="{{url('/')}}/js/materialize.min.js"></script>
    <!--scrollbar-->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!--prism-->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/prism/prism.js"></script>
    <!-- data-tables -->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/data-tables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/plugins/data-tables/data-tables-script.js"></script>

    <!-- chartist -->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/chartist-js/chartist.min.js"></script>   

    <!-- chartjs -->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/chartjs/chart.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/plugins/chartjs/chart-script.js"></script>

    <!-- sparkline -->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/plugins/sparkline/sparkline-script.js"></script>
    
    <!-- google map api -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAAZnaZBXLqNBRXjd-82km_NO7GUItyKek"></script>

    <!--jvectormap-->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/plugins/jvectormap/vectormap-script.js"></script>
    
    <!--google map-->
    <script type="text/javascript" src="{{url('/')}}/js/plugins/google-map/google-map-script.js"></script>
    <script type="text/javascript" src="{{url('/')}}/js/parsley.js"></script>
    
    
    <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{url('/')}}/js/plugins.min.js"></script>
   
    <!-- Toast Notification -->
    <script type="text/javascript">
       /* window.setInterval(function(){
            $.ajax({
              url: "{{url('/customer/get_notification_count')}}",
              type: 'POST',
              // dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
              data: {
                _method: 'POST',
                _token:     '{{ csrf_token() }}'
              },
            success: function(response)
            {
                $('#noti_count_1').text(response);
                $('#noti_count_2').text(response);
            }
            });

        }, 5000);*/

    // Toast Notification
    $(window).load(function() {
        setTimeout(function() {
           // Materialize.toast('<span>Welcome</span>', 1500);
        }, 1500);
        setTimeout(function() {
           // Materialize.toast('<span>Forget what you can get and see what you can give.</span>', 5000);
        }, 5000);
        setTimeout(function() {
           // Materialize.toast('<span>You have new notification.</span><a class="btn-flat yellow-text" href="#">Read<a>', 3000);
        }, 15000);
    });
    </script>
</body>

</html>