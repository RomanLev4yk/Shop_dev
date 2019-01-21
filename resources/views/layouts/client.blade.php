<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
 <head>
  @include('base.meta')
 </head>

 <body class="animsition">
   @include('base.header')
   @yield('content')
   @include('base.footer')
  </div>
 </body>
</html>
