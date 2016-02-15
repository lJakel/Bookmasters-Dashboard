<div class="container">
   <div id="main-content" class="merge-left">
      <div class="wrapper content view-animate fade-up" style="margin:0px;padding:0px;height:100%;">
         <div class="center">
            <div class="loginFrm form animated fadeInUp" ng-controller="AuthCtrl as AC">

               <img src="/CDN/resources/brand/bm/small/flat-horiz-white.png" width='400' alt="">
               <div ng-form="loginNgForm" ng-repeat="LC in [AC.loginCtrl]">
                  <form action="">
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="LCUsername" class="control-label">Username</label>
                           <input type="text" class="form-control input-sm" id="LCUsername" name="LCUsername" ng-model="LC.Model.Username" ng-required="true" autocomplete="off">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="LCPassword" class="control-label">Password</label> <!--<span class="pull-right"><a data-ui-sref="forgot" tabindex="-1">Forgot Password?</a></span>-->
                           <input type="password" class="form-control input-sm" id="LCPassword" name="LCPassword" ng-model="LC.Model.Password"  ng-required="true" autocomplete="off">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-primary btn-block" ng-click="LC.login(true)" ng-disabled="!loginNgForm.$valid">Login  <i class="fa fa-refresh fa-fw fa-spin" ng-if="LC.authenticating"></i> </button>
                        </div>
                     </div>
                  </form>
               </div>
               <p>New users need to <a data-ui-sref="register">register an account.</a></p>

            </div>
         </div>
      </div>
      <link rel="stylesheet" href="assets/login.css">
      <script src="assets/js/views/authentication/login.js"></script>

   </div>
</div>
