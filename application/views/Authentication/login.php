<div class="container">
   <div id="main-content merge-left">
      <div class="wrapper content view-animate fade-up">
         <div class="container-fluid">
            <div class="login" ng-controller="LoginCtrl as L">

               <img src="http://www.bookmasters.com/CDN/resources/brand/bm/small/flat-horiz-white.png" width='400' alt="">
               <ul class="nav nav-tabs" id="authmodal" role="tablist">
                  <li class="active"><a href="" role="tab" data-target="#login" data-toggle="tab">Login</a></li>
                  <li><a href="" role="tab" data-target="#register" data-toggle="tab">Register</a></li>
               </ul>
               
               <div class="tab-content">
                  <div class="tab-pane active" id="login">
                     <form method="post">
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="Username" class="control-label">Username</label>
                                 <input type="text" class="form-control input-sm" id="Username" name="username" ng-model="L.loginCtrl.username" autocomplete="off">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="Password" class="control-label">Password</label>
                                 <input type="password" class="form-control input-sm" id="Password" name="password" ng-model="L.loginCtrl.password" autocomplete="off">
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <button class="btn btn-primary btn-block" ng-click="L.loginCtrl.login(true)">Login</button>
                           </div>
                        </div>

                     </form>
                  </div>
                  <div class="tab-pane" id="register">

                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="regkey" class="control-label">Registration Key</label>
                              <input type="text" class="form-control input-sm" id="Email" name="regkey" autocomplete="off" ng-model="L.registerCtrl.regkey">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="Username" class="control-label">Username</label>
                              <input type="text" class="form-control input-sm" id="Username" name="Username" autocomplete="off" ng-model="L.registerCtrl.username">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="Password" class="control-label">Password</label>
                              <input type="password" class="form-control input-sm" id="Password" name="Password" autocomplete="off" ng-model="L.registerCtrl.password">
                           </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="Email" class="control-label">Email Address</label>
                              <input type="text" class="form-control input-sm" id="Email" name="Email" autocomplete="off" ng-model="L.registerCtrl.email">
                           </div>
                        </div>
                     </div>

                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <button class="btn btn-primary btn-block" ng-click="L.registerCtrl.register()">Register</button>

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
         </div>

         <style>
            html body {
               background: url(http://www.bookmasters.com/CDN/resources/img/login/moonship.jpg);
            }

            .login {
               position: absolute;
               z-index: 2;
               position: absolute;
               left: 50%;
               top: 50%;
               transform: translate(-50%, -50%);
               width: 400px;
            }

            .login li a {
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

            .login img {
               margin-top: -150px;
               text-shadow: 0px 0px 8px black;
            }
         </style>

      </div>
      <script src="assets/js/views/authentication/login.js"></script>

   </div>
</div>
