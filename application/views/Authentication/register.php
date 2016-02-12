<div class="container">
   <div id="main-content" class="merge-left">
      <div class="wrapper content view-animate fade-up" style="margin:0px;">
         <div class="center">
            <div class="form animated fadeInUp" ng-controller="AuthCtrl as AC">

               <img src="/CDN/resources/brand/bm/small/flat-horiz-white.png" width='400' alt="">
               <div ng-form="registerNgForm" ng-repeat="RC in [AC.registerCtrl]">
                  <form action="">
                     <div class="row">
                        <div class="col-md-12 form-group required" data-show-errors>
                           <label for="RCRegKey" class="control-label">Registration Key</label>
                           <input type="text" class="form-control input-sm" id="RCRegKey" name="RCRegKey" autocomplete="off" ng-model="RC.Model.Regkey" ng-required="true" ng-minlength="8">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group required" data-show-errors>
                           <label for="RCUsername" class="control-label">Username</label>
                           <input type="text" class="form-control input-sm" id="RCUsername" name="RCUsername" autocomplete="off" ng-model="RC.Model.Username" ng-required="true" ng-minlength="6">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 form-group required" data-show-errors>
                           <label for="RCPassword" class="control-label">Password</label>
                           <input type="password" class="form-control input-sm" id="RCPassword" name="RCPassword" autocomplete="off" ng-model="RC.Model.Password" ng-required="true" data-bm-validate data-bm-validate-options="['bmpassword']">
                        </div>
                        <div class="col-md-6 form-group required" data-show-errors>
                           <label for="RCPasswordVerify" class="control-label">Retype Password</label>
                           <input type="password" class="form-control input-sm" id="RCPasswordVerify" 
                                  name="RCPasswordVerify" autocomplete="off" ng-model="RC.Model.PasswordVerify" ng-required="true" data-compare-to="RC.Model.Password" 
                                  data-bm-validate data-bm-validate-options="['bmpassword','compareto']">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-6 form-group required" data-show-errors>
                           <label for="RCEmail" class="control-label">Email Address</label>
                           <input type="email" class="form-control input-sm" id="RCEmail" 
                                  name="RCEmail" autocomplete="off" ng-model="RC.Model.Email" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" ng-required="true">
                        </div>
                        <div class="col-md-6 form-group required" data-show-errors>
                           <label for="RCEmailVerify"Verify class="control-label">Retype Email Address</label>
                           <input type="email" class="form-control input-sm" id="RCEmailVerify" 
                                  name="RCEmailVerify" autocomplete="off" ng-model="RC.Model.EmailVerify" data-compare-to='RC.Model.Email' ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" ng-required="true"
                                  data-bm-validate data-bm-validate-options="['compareto']">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-primary btn-block" ng-click="RC.register()" ng-disabled="!registerNgForm.$valid">Create Account <i class="fa fa-refresh fa-fw fa-spin" ng-if="RC.authenticating"></i> </button>
                        </div>
                     </div>
                  </form>
               </div>

               <p>Already have an account? <a data-ui-sref="login">Login</a>.</p>

            </div>
         </div>
      </div>
      <link rel="stylesheet" href="assets/login.css">
      <script src="assets/js/views/authentication/login.js"></script>

   </div>
</div>
