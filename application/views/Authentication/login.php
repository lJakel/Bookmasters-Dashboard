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
                              <label for="Username" class="control-label">Username</label>
                              <input type="text" class="form-control input-sm" id="Username" name="username" ng-model="LC.username" ng-required="true" autocomplete="off">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 form-group" data-show-errors>
                              <label for="Password" class="control-label">Password</label> <span class="pull-right"><a href="#" tabindex="-1" ng-click="L.forgotPassword()">Forgot Password?</a></span>
                              <input type="password" class="form-control input-sm" id="Password" name="password" ng-model="LC.password"  ng-required="true" autocomplete="off">
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
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="regkey" class="control-label">Registration Key</label>
                           <input type="text" class="form-control input-sm" id="Email" name="regkey" autocomplete="off" ng-model="RC.regkey" ng-required="true" ng-minlength="8">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Username" class="control-label">Username</label>
                           <input type="text" class="form-control input-sm" id="Username" name="Username" autocomplete="off" ng-model="RC.username" ng-required="true" ng-minlength="6">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Password" class="control-label">Password</label>
                           <input type="password" class="form-control input-sm" id="Password" name="Password" autocomplete="off" ng-model="RC.password" ng-required="true" data-bm-validate data-bm-validate-options="['bmpassword']">

                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Email" class="control-label">Email Address</label>
                           <input type="email" class="form-control input-sm" id="Email" name="Email" autocomplete="off" ng-model="RC.email" ng-pattern="/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/" ng-required="true" ng-minlength="number">
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
               background: url(///CDN/resources/img/login/moonship.jpg);
            }
            li.active a{
               background-color:#f4f4f4 !important;
            }
            .loginFrm {

               width: 400px;

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
