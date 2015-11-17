<div class="container">
   <div id="main-content merge-left">
      <div class="wrapper content view-animate fade-up">

         <div class="loginFrm" ng-controller="LoginCtrl as L">

            <div>
               <img src="http://www.bookmasters.com/CDN/resources/brand/bm/small/flat-horiz-white.png" width='400' alt="">

               <ul class="nav nav-tabs" id="authmodal" role="tablist">
                  <li class="active"><a href="" role="tab" data-target="#login" data-toggle="tab">Login</a></li>
                  <li><a href="" role="tab" data-target="#register" data-toggle="tab">Register</a></li>
               </ul>

               <div class="tab-content">
                  <div class="tab-pane active" id="login" ng-form="loginNgForm">
                     <form method="post">
                        <div class="row">
                           <div class="col-md-12 form-group" data-show-errors>
                              <label for="Username" class="control-label">Username</label>
                              <input type="text" class="form-control input-sm" id="Username" name="username" ng-model="L.loginCtrl.username" ng-required="true" autocomplete="off">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12 form-group" data-show-errors>
                              <label for="Password" class="control-label">Password</label>
                              <input type="password" class="form-control input-sm" id="Password" name="password" ng-model="L.loginCtrl.password"  ng-required="true" autocomplete="off">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <button class="btn btn-primary btn-block" ng-click="L.loginCtrl.login(true)" ng-disabled="!loginNgForm.$valid">Login  <i class="fa fa-refresh fa-fw fa-spin" ng-show="L.loginCtrl.authenticating"></i> </button>
                           </div>
                        </div>

                     </form>
                  </div>
                  <div class="tab-pane" id="register" ng-form="registerNgForm">

                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="regkey" class="control-label">Registration Key</label>
                           <input type="text" class="form-control input-sm" id="Email" name="regkey" autocomplete="off" ng-model="L.registerCtrl.regkey" ng-required="true" ng-minlength="8">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Username" class="control-label">Username</label>
                           <input type="text" class="form-control input-sm" id="Username" name="Username" autocomplete="off" ng-model="L.registerCtrl.username" ng-required="true" ng-minlength="6">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Password" class="control-label">Password</label>
                           <input type="password" class="form-control input-sm" id="Password" name="Password" autocomplete="off" ng-model="L.registerCtrl.password" ng-required="true" ng-minlength="8">
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group" data-show-errors>
                           <label for="Email" class="control-label">Email Address</label>
                           <input type="email" class="form-control input-sm" id="Email" name="Email" autocomplete="off" ng-model="L.registerCtrl.email" ng-required="true" ng-minlength="number">
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-primary btn-block" ng-click="L.registerCtrl.register()" ng-disabled="!registerNgForm.$valid">Register <i class="fa fa-refresh fa-fw fa-spin" ng-show="L.registerCtrl.authenticating"></i> </button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <br>
            <div class="alert alert-danger" ng-show="L.error" role="alert">
               <strong>Error!</strong> {{L.error}}
            </div>
            <div class="alert alert-success" ng-show="L.success" role="alert">
               <strong>Success!</strong> {{L.success}}
            </div>
         </div>


         <style>
            html body {
               background: url(http://www.bookmasters.com/CDN/resources/img/login/moonship.jpg);
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
               border: 1px solid #ddd;
               border-bottom-color: transparent;
               cursor: default;
            }

            .tab-content {
               background: #f4f4f4;
               -webkit-box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
               -moz-box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
               box-shadow: 0px 10px 30px 0px rgba(50, 50, 50, 0.45);
            }

            .tab-pane {
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
