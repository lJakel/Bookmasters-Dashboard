<div class="row" ng-controller="DevDebugApp as DBA">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">


            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     <a href="" data-toggle="collapse" data-target="#userdata" aria-expanded="false" aria-controls="userdata">
                        User Data
                     </a>
                  </h3>
               </div>
               <div class="panel-body collapse" id="userdata">
                  <pre>{{user|json}}</pre>
               </div>
            </div>
            <div class="panel panel-default">
               <div class="panel-heading">
                  <h3 class="panel-title">
                     <a href="" data-toggle="collapse" data-target="#localstorage" aria-expanded="false" aria-controls="userdata">
                        User Data
                     </a>
                  </h3>
               </div>
               <div class="panel-body collapse" id="localstorage">
                  <pre>{{DBA.localStorage|json}}</pre>
               </div>
            </div>
            <script>
               BMApp.register.controller('DevDebugApp', ['$localStorage', function ($localStorage) {
                     var self = this;
                     self.localStorage = $localStorage;
                  }]);
            </script>

         </div>
      </div>
   </div>
</div>