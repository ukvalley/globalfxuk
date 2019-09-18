<!-- HEader -->        
@include('customer.layout.header')    
        
<!-- BEGIN Sidebar -->
@include('customer.layout.sidebar')
<!-- END Sidebar -->

<!-- BEGIN Content -->

    @yield('main_content')

    <!-- END Main Content -->

<!-- Footer -->        
@include('customer.layout.footer')    
                
              