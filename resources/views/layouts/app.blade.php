@include('admin.inc.function')
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
       <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <?php $page_name =  Request::segment(3);
         ?>
      <title>Ram Windows CRM</title>
      <link rel="icon" type="image/x-icon" href="{{ URL::asset('images/ram-windows-and-doors-favicon.png') }}"/>
      <!-- Fonts -->
      <link rel="dns-prefetch" href="//fonts.gstatic.com">
      <!-- Styles -->
      @include('admin.inc.styles')
   </head>
   <body>
      @include('admin.inc.navbar')
      @include('admin.inc.sidebar')
      <!-- BEGIN: Page Main-->
      <div id="main">
         <div class="row">
            @yield('content')
         </div>
      </div>
      <!-- END: Page Main-->
      @include('admin.inc.footer')
      @include('admin.inc.scripts')
   </body>
</html>
