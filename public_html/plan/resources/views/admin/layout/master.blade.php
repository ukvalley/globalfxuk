<!-- HEader -->        
@include('admin.layout.header')    
        
<!-- BEGIN Sidebar -->
@include('admin.layout.sidebar')
<!-- END Sidebar -->

<!-- BEGIN Content -->

    @yield('main_content')

    <!-- END Main Content -->

<!-- Footer -->        
@include('admin.layout.footer')    
                
              