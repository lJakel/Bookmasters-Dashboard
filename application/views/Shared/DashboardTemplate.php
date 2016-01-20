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
      <!--[if IE]><link href="CDN/resources/brand/favicon/favicon.ico" rel="icon" /><![endif]-->
      <link rel="icon" href="CDN/resources/brand/favicon/favicon.png">
      <link rel="apple-touch-icon-precomposed" href="CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="57x57" href="CDN/resources/brand/favicon/apple-touch-icon-57x57-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="72x72" href="CDN/resources/brand/favicon/apple-touch-icon-72x72-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="114x114" href="CDN/resources/brand/favicon/apple-touch-icon-114x114-precomposed.png">
      <link rel="apple-touch-icon-precomposed" sizes="144x144" href="CDN/resources/brand/favicon/apple-touch-icon-144x144-precomposed.png">

      <!--Core CSS -->

      <link href="CDN/css/bootstrap-reset/bootstrap-reset.css" rel="stylesheet">

      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="CDN/bower_components/angular-toasty/dist/angular-toasty.min.css">


      <!-- Custom styles for this Dashboard -->
      <link href="CDN/css/dashboard-sass2/assets/stylesheets/_dashboard.css" rel="stylesheet">


   </head>

   <body data-ng-controller="BMAppController">
      <!--[if lt IE 10]><div class="lt-ie10-bg"><p class="browsehappy">You are using an <strong>outdated</strong> browser.</p><p>Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p</div><![endif]-->

      <!--App Bootstrap-->
      <div data-ui-view></div>

      <!-- common libraries. required for every page-->
      <script src="CDN/bower_components/jquery/dist/jquery.min.js"></script>
      <script src="CDN/bower_components/angular/angular.min.js"></script>
      <script src="CDN/bower_components/angular-ui-router/release/angular-ui-router.min.js"></script>
      <script src="CDN/bower_components/ngstorage/ngStorage.min.js"></script>
      <script src="CDN/bower_components/angular-resource/angular-resource.min.js"></script>
      <script src="CDN/bower_components/angular-ui-event/dist/event.min.js"></script>
      <script src="CDN/bower_components/angular-animate/angular-animate.min.js"></script>

      <script src="CDN/bower_components/ng-file-upload-shim/ng-file-upload-all.min.js"></script>
      <script src="CDN/bower_components/nya-bootstrap-select/dist/js/nya-bs-select.min.js"></script>
      <!--<script src="CDN/bower_components/summernote/dist/summernote.min.js"></script>
      <script src="CDN/bower_components/angular-summernote/dist/angular-summernote.js"></script>-->

      <script src="CDN/js/summernote/angular-summernote.min.js"></script>
      <script src="CDN/js/summernote/summernote.min.js"></script>
      <link rel="stylesheet" href="https://cdn.rawgit.com/summernote/summernote/v0.7.0/dist/summernote.css">

      <!-- common libs. previous bootstrap-sass version was used, but due to a need to have single compiled file using bootstrap's version -->
      <script src="CDN/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
      <script src="CDN/bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
      <script src="CDN/bower_components/moment/min/moment-with-locales.min.js"></script>
      <script src="CDN/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
      <script src="CDN/bower_components/angular-toasty/dist/angular-toasty.min.js"></script>



      <!-- common app js -->
      <script src="assets/js/ng/build/appbuild.min.js?cache=<?php echo rand(1000, 9000); ?>"></script>
      <!--<script src="assets/js/ng/build/appbuild.js?cache=<?php echo rand(1000, 9000); ?>"></script>-->

      <!-- page specific libs -->

   <toasty></toasty>
</body>
</html>
