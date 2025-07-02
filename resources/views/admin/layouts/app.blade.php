<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <?php $page_name =  Request::segment(3);
      $module_name =  Request::segment(2);
         ?>
      <title>RamWindows CRM</title>
      <link rel="icon" type="image/x-icon" href="{{ URL::asset('images/ram-windows-and-doors-favicon.png') }}"/>
      <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap"  rel="stylesheet">

      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <!-- Styles -->
      
      @include('admin.inc.styles')
  <style>
    #load {
      display: none;
    }
  </style>
   </head>
   <!-- <body onload="init()"> -->
   <body >
    <div  style="display: none;" id="dashboard-preloader">
    <div  class="custom-loader" >
        <span class="loader"></span>
</div>
</div>
<div class="dashboardLoader"></div>
     <!-- <div class="email-overlay"></div> -->
  <noscript>
    <p>Sorry, your browser does not support JavaScript!!</p>
  </noscript>
     <div id="load"></div>
     @include('admin.inc.navbar')
      @include('admin.inc.sidebar')
   
      @if($module_name == 'dashboard')
      <div id="main" >
        @else
      <div id="main" style="display: none">
        @endif
         <div class="row">
            @yield('content')
         </div>
      </div>
      <!-- END: Page Main-->
        @include('admin.inc.scripts')
        @include('admin.inc.footer')
        @include('admin.inc.toastr-js')
        @include('admin.inc.custom-js')
        <script type="text/javascript">
            $(".select2").on("select2:open", function() {
                $(".select2-search__field").attr("placeholder", "Type here to search");
            });
         
        </script>
       
   </body>
</html>




