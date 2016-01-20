<div class="container">
   <div id="main-content merge-left">
      <div class="wrapper content view-animate fade-up">

         <div ng-controller="ErrorCtrl as EC">
            <div class="row">
               <div class="col-sm-12 form-group"></div>
            </div>
            <div class="row">

               <div class="col-sm-9">

                  <div class="long-shadow">#{{EC.code}}</div>


                  <h2>Error: {{EC.message}}</h2>
                  <p>While we find out who tripped over the power cord please contact us at support@bookmasters.com.</p>

                  <br>
                  <h3>What do I do now?</h3>
                  <p>
                  <ul>
                     <li>You can go to the dashboard homepage. </li>
                     <li>Go to the application's home page&mdash;this will reload the application. </li>
                     <li>Reloading the dashboard will update the dashboard if there were any updates rolled out since the last time you logged in. This can fix some issues.</li>
                  </ul>
                  </p>
                  <a data-ui-sref="bm.app.page({ 'app': 'main','page': 'index', child: null })" class="btn btn-default"> <i class="fa fa-dashboard"></i> Go to Dashboard</a>
                  <a href="" ng-click='EC.goBack()' class="btn btn-default"> <i class="fa fa-arrow-left"></i> Go To Application's Home Page</a>
                  <a href="./" ng-click='EC.reload()' class="btn btn-default"> <i class="fa fa-refresh"></i> Reload Dashboard</a>

               </div>

            </div>
         </div>
         <link href="//fonts.googleapis.com/css?family=Lobster:regular" rel="stylesheet" type="text/css" >
         <style>

            body,html{
               background-color: #5b5b5b !important;

            }
            .long-shadow {
               display: inline-block;
               -webkit-box-sizing: content-box;
               -moz-box-sizing: content-box;
               box-sizing: content-box;
               padding: 25px;
               border: none;

               color: rgba(255,255,255,1);
               text-align: center;
               -o-text-overflow: clip;
               text-overflow: clip;
               text-shadow: 3px 3px 0 #373737 , 4px 4px 0 #373737 , 5px 5px 0 #373737 , 6px 6px 0 #373737 , 7px 7px 0 #373737 , 8px 8px 0 #373737 , 9px 9px 0 #373737 , 10px 10px 0 #373737 , 11px 11px 0 #373737 , 12px 12px 0 #373737 , 13px 13px 0 #373737 , 14px 14px 0 #373737 , 15px 15px 0 #373737 , 16px 16px 0 #373737 , 17px 17px 0 #373737 , 18px 18px 0 #373737 , 19px 19px 0 #373737 , 20px 20px 0 #373737 ;
               font-family: 'Lobster', serif;
               font-size:160px;
               line-height: 180px;
            }
            .medium{
               display: block;

               font-size:25px;
               font-family: 'Lobster', serif;
               color: #222;
               text-shadow: 0px 1px 1px #4d4d4d;
            }
            p,li{
               font-size:16px;
               line-height: 26px;
               margin-top:10px;
               color: #fff;
            }
            li{
               line-height: 18px;
            }
            
            h3{
               color: #fff;
               font-family:Georgia, serif;
               font-style: italic;
            }
            h2{
               color: #fff;
               padding:0;
               margin:0;
            }
         </style>
         <script>
                    BMApp.register.controller('ErrorCtrl', ['$scope', '$state', function ($scope, $state) {
                    var self = this;
                            self.code = $state.params.code;
                            self.message = $state.params.message;
                            self.goBack = function () {
                            $scope.previousStateParams.page = 'index';
                                    $state.go($scope.previousState, $scope.previousStateParams);
                            }

                    self.reload = function () {
                    window.location = "./";
                    }
                    }]);
         </script>
      </div>
   </div>
</div>
