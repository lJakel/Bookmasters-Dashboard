<div class="container">
   <div id="main-content merge-left">
      <div class="wrapper content view-animate fade-up">
         <div ng-controller="ErrorCtrl as EC">
            <div class="row">
               <div class="col-sm-12 form-group"></div>
            </div>
            <div class="row">
               <div class="col-sm-3">
                  <img width="100%" src="http://www.bookmasters.com/CDN/resources/img/badger.png" alt="">
               </div>
               <div class="col-sm-9">
                  <h1>Whoops</h1>
                  <h2>Someone's totally going to pay for this.</h2>
                  <p>This page is temporarily down or has created an internal error.
                     <br>
                     While we find out who tripped over the power cord please contact us at support@bookmasters.com.
                  </p>

                  <div class="row">
                     <div class="col-sm-8">
                        <div class="alert alert-danger" role="alert">
                           <strong>Error!</strong> 
                           {{EC.message}}
                           <br>
                           Code: {{EC.code}}
                        </div>
                     </div>
                  </div>

                  <h4>What do I do now?</h4>
                  <a data-ui-sref="bm.app.page({ 'app': 'main','page': 'index', child: null })" class="btn btn-primary"> <i class="fa fa-dashboard"></i> Go to Dashboard</a>
                  <a href="" ng-click='EC.goBack()' class="btn btn-primary"> <i class="fa fa-arrow-left"></i> Go To Application's Home Page</a>
                  <a href="./" ng-click='EC.reload()' class="btn btn-primary"> <i class="fa fa-refresh"></i> Reload Dashboard</a>

               </div>

            </div>
         </div>
         <style>
            h1{
               font-size:65px;

            }
            p{
               font-size:16px;
               line-height: 26px;
               margin-top:10px;
            }
            h4{
               font-family:Georgia, serif;

               font-style: italic;
            }
            h1, h2,{
               padding:0;
               margin:0;
            }
         </style>
         <script>
                    BMApp.register.controller('ErrorCtrl', ['$scope', '$state', function($scope, $state) {
                        var self = this;
                        self.code = $state.params.code;
                        self.message = $state.params.message;
                        self.goBack = function() {
                            $scope.previousStateParams.page = 'index';
                            $state.go($scope.previousState, $scope.previousStateParams);
                        }

                        self.reload = function() {
                            window.location = "./";
                        }
                    }]);
         </script>
      </div>
   </div>
</div>
