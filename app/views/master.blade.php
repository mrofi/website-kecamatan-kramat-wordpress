<?php
$local = (App::environment('local') or App::environment('local_ubuntu')) ? true : false;
?>

<!DOCTYPE html>
<html ng-app="myApp">
  <head>
    <meta charset="UTF-8">
    <title>
      {{ $siteTitle or TITLE }}
    </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset_themes('/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
  @if ($local)
    <link href="{{ asset_themes('/bootstrap/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
  @else
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
  @endif
    <!-- Theme style -->
    <link href="{{ asset_themes('/dist/css/AdminLTE.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link href="{{ asset_themes('/dist/css/skins/skin-jaya.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="skin-jaya @yield('bodyClass')" @yield('bodyAttributes')>
    <div class="wrapper">

      @yield('content')

    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.3 -->
    <script src="{{ asset_themes('/plugins/jQuery/jQuery-2.1.3.min.js') }}"></script>
    <!-- angular -->
    <script src="{{ asset_themes('/plugins/angular/angular.min.js') }}"></script>
    <!-- angular resource -->
    <script src="{{ asset_themes('/plugins/angular/angular-resource.min.js') }}"></script>
    <!-- angular-route -->
    <script src="{{ asset_themes('/plugins/angular/angular-route.min.js') }}"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{ asset_themes('/bootstrap/js/bootstrap.min.js') }}" type="text/javascript"></script>

    <!-- angular script -->
    <script>
    (function(){
      var app = angular.module('myApp', ['ngResource', 'ngRoute']);

      @yield('angularJS')

    })()
    </script>

    <!-- AdminLTE App -->
    <script src="{{ asset_themes('/dist/js/app.min.js') }}" type="text/javascript"></script>

    @yield('js')

    <!-- Optionally, you can add Slimscroll and FastClick plugins.
          Both of these plugins are recommended to enhance the
          user experience -->
  </body>
</html>