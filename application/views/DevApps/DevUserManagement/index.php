<div class="row" ng-controller="DevUserManagementCtrl as DUMC">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="table-responsive">
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>IsActive</th>
                        <th>RegisteredKey</th>
                        <th>RoleId</th>
                        <th>Created</th>
                        <th>LastModified</th>
                        <th style="text-align: center;width:55px;">
                           <button class="btn btn-info btn-sm" ng-click="DUMC.load()">
                              <i class="fa fa-refresh" ng-class="{'fa-spin' : DUMC.loading == true}"></i>
                           </button>
                        </th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="u in DUMC.users">
                        <td>{{u.Id}}</td>
                        <td>{{u.Username}}</td>
                        <td>{{u.Email}}</td>
                        <td>{{u.IsActive}}</td>
                        <td>{{u.RegisteredKey}}</td>
                        <td>{{u.RoleId}}</td>
                        <td>{{u.Created}}</td>
                        <td>{{u.LastModified}}</td>
                        <td></td>

                     </tr>
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>
<style>
   table td {
      word-wrap: break-word;
   }
</style>
<script>
   BMApp.register.controller('DevUserManagementCtrl', function ($state, $http, $q) {

      var self = this;
      self.loading = false;
      self.load = function () {
         self.loading = true;
         self.users = [];
         $http.post('devusermanagement/viewusers').then(function (response) {
            self.users = $.map(response.data, function (item) {
               return item;
            });
            self.loading = false;
         }, function (response) {
            self.loading = false;
            $state.go('error');
         });
      }
      self.load();
   });
</script>