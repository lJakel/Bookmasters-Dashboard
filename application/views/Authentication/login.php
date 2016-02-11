<div class="container">
   <div id="main-content merge-left">
      <div class="wrapper content view-animate fade-up">
         <div class="loginFrm" ng-controller="AuthCtrl as L">
            <div>
               <img src="/CDN/resources/brand/bm/small/flat-horiz-white.png" width='400' alt="">
               <ul class="nav nav-tabs" id="authmodal" role="tablist">
                  <li class="active"><a href="" role="tab" data-target="#login" data-toggle="tab">Login</a></li>
                  <li><a href="" role="tab" data-target="#register" data-toggle="tab">Create Account</a></li>
                  <li><a href="" role="tab" data-target="#forgot" data-toggle="tab">Forgot?</a></li>
               </ul>
               <div class="tab-content">
                  <div class="tab-pane fade in active" id="login" ng-form="loginNgForm" ng-repeat="LC in [L.loginCtrl]">
                     <form method="post">
                        <div class="row">
                           <div class="col-md-12 form-group" data-show-errors>
                              <label for="LCUsername" class="control-label">Username</label>
                              <input type="text" class="form-control input-sm" id="LCUsername" name="LCUsername" ng-model="LC.Model.Username" ng-required="true" autocomplete="off">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 form-group" data-show-errors>
                              <label for="LCPassword" class="control-label">Password</label> <span class="pull-right"><a href="#" tabindex="-1" ng-click="L.forgotPassword()">Forgot Password?</a></span>
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
                  <div class="tab-pane fade" id="register" ng-form="registerNgForm" ng-repeat="RC in [L.registerCtrl]">
                                                         
                     <div class="row">
                        <div class="col-md-6 form-group required" data-show-errors>
                           <label for="RCRegKey" class="control-label">Registration Key</label>
                           <input type="text" class="form-control input-sm" id="RCRegKey" name="RCRegKey" autocomplete="off" ng-model="RC.Model.Regkey" ng-required="true" ng-minlength="8">
                        </div>
                        <div class="col-md-6 form-group required" data-show-errors>
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
                  </div>
                  <div class="tab-pane fade" id="forgot" ng-form="forgotNgForm" ng-repeat="FC in [L.forgotCtrl]">
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Username" class="control-label">Username</label>
                           <input type="text" class="form-control input-sm" id="Username" name="Username" autocomplete="off" ng-model="FC.username" ng-required="true" ng-minlength="6">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Email" class="control-label">Email Address</label>
                           <input type="email" class="form-control input-sm" id="Email" name="Email" autocomplete="off" ng-model="FC.email" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" ng-required="true" ng-minlength="number">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-primary btn-block" ng-click="FC.forgot()" ng-disabled="!forgotNgForm.$valid">Reset <i class="fa fa-refresh fa-fw fa-spin" ng-if="RC.authenticating"></i> </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <style>
            html body {
               background: url(/CDN/resources/img/login/moonship.jpg);
            }
            li.active a{
               background-color:#f4f4f4 !important;
            }
            .loginFrm {
               width: 500px;
               min-height:330px;
               max-height:470px;
               /* overflow: auto; */
               margin: auto;
               position: absolute;
               top: 0;
               left: 0;
               bottom: 0;
               right: 0;
            }
            .loginFrm img {
               margin: 0 auto;
               display: block;
               width: 400px;
               text-shadow: 0px 0px 8px black;
            }
            .loginFrm li a {
               color: #555;
               background-color: #fff;
               border: none !important;
               border-bottom-color: transparent;
               cursor: default;
            }
            .tab-content {
               background: #f4f4f4;
               -webkit-box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
               -moz-box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
               box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
            }
            .tab-pane fade {
               border: none;
            }
            ul.nav.nav-tabs{
               margin-top: 40px;
            }
         </style>
      </div>
      <script src="assets/js/views/authentication/login.js"></script>
   </div>
</div>
