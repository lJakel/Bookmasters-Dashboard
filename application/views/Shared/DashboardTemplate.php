<!DOCTYPE html>
<html lang="en" ng-app="BMApp">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, height=device-height">
      <meta name="description" content="">
      <meta name="author" content="Jake Ihasz">
      <meta name="robots" content="noindex">

      <title>Bookmasters - Dashboard</title>
      <!--<link rel="dns-prefetch" href="//api.bookmasters.com">-->
      <!--[if IE]><link href="/CDN/resources/brand/favicon/favicon.ico" rel="icon" /><![endif]-->
      <link rel="icon" href="/CDN/resources/brand/favicon/favicon.png">
      <link rel="apple-touch-icon-precomposed" href="/CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="57x57" href="/CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/CDN/resources/brand/favicon/apple-touch-icon-72x72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/CDN/resources/brand/favicon/apple-touch-icon-114x114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/CDN/resources/brand/favicon/apple-touch-icon-144x144-precomposed.png">
      <!--Core CSS -->
      <link href="/CDN/css/bootstrap-reset/bootstrap-reset.css" rel="stylesheet">
      <link rel="stylesheet" href="/CDN/bower_components/font-awesome/css/font-awesome.min.css">
      <link rel="stylesheet" href="/CDN/bower_components/angular-toasty/dist/angular-toasty.min.css">
      <!-- Custom styles for this Dashboard -->
      <link href="/CDN/css/dashboard-sass2/assets/stylesheets/dashboard.css" rel="stylesheet">
      <link rel="stylesheet" href="/CDN/bower_components/summernote/dist/summernote.css">
   </head>

   <body data-ng-controller="BMAppController">
      <!--[if lt IE 10]><div class="lt-ie10-bg"><p class="browsehappy">You are using an <strong>outdated</strong> browser.</p><p>Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p</div><![endif]-->

      <!--App Bootstrap-->
      <div data-ui-view></div>

      <!-- common libraries. required for every page-->
      <?php
      $AppLibs = [
          'assets/js/ng/app.js',
          'assets/js/ng/controllers.js',
          'assets/js/ng/directives.js',
          'assets/js/ng/services.js',
          'assets/js/ng/validators.js',
          'assets/js/ng/wrappers.js',
      ];
      $VendorLibs = [
          '/CDN/bower_components/jquery/dist/jquery.js',
          '/CDN/bower_components/angular/angular.js',
          '/CDN/bower_components/angular-ui-router/release/angular-ui-router.js',
          '/CDN/bower_components/ngstorage/ngStorage.js',
          '/CDN/bower_components/angular-resource/angular-resource.js',
          '/CDN/bower_components/angular-ui-event/dist/event.js',
          '/CDN/bower_components/angular-animate/angular-animate.js',
          '/CDN/bower_components/ng-file-upload/ng-file-upload-all.js',
          '/CDN/bower_components/nya-bootstrap-select/dist/js/nya-bs-select.js',
          '/CDN/bower_components/angular-summernote/dist/angular-summernote.js',
          '/CDN/bower_components/summernote/dist/summernote.js',
          '/CDN/bower_components/bootstrap/dist/js/bootstrap.js',
          '/CDN/bower_components/angular-bootstrap/ui-bootstrap-tpls.js',
          '/CDN/bower_components/moment/min/moment-with-locales.js',
          '/CDN/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
          '/CDN/bower_components/angular-toasty/dist/angular-toasty.js',
          '/CDN/bower_components/jquery.nicescroll/jquery.nicescroll.js',
          '/CDN/bower_components/ng-tasty/ng-tasty-tpls.js',
      ];
      if ($_SERVER['HTTP_HOST'] == '10.10.11.48') {
         foreach ($VendorLibs as $value) {
            echo "<script src=\"{$value}\"></script>\n";
         }
      } else {
         echo "<script src=\"assets/vendor/vendor.min.js?cache=" . rand(1000, 9000) . "\"></script>";
      }
      ?>
      <!-- common app js -->
      <?php
      if ($_SERVER['HTTP_HOST'] == '10.10.11.48') {
         foreach ($AppLibs as $value) {
            echo "<script src=\"{$value}\"></script>\n";
         }
      } else {
         echo "<script src=\"assets/js/ng/build/appbuild.min.js?cache=" . rand(1000, 9000) . "\"></script>";
      }
      ?>
      <!-- page specific libs -->
   <toasty></toasty>
</body>
</html>
