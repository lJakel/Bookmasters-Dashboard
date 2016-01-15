<div class="row" ng-controller="DevFeedbackCtrl as DFC">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="table-responsive">
               <table class="table table-bordered table-striped">
                  <thead>
                     <tr>
                        <th>Username</th>
                        <th>ResponseNumber</th>
                        <th>PageReported</th>
                        <th>BrowserAgent</th>
                        <th>ResponseMessage</th>
                        <th>CanBeContacted</th>
                        <th>Created</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr ng-repeat="fb in DFC.feedback">
                        <td>{{fb.UserId}}</td>
                        <td>{{fb.ResponseNumber}}</td>
                        <td>
                           <a href="{{fb.PageReported}}">{{fb.PageReported}}</a>
                        </td>
                        <td>{{fb.BrowserAgent}}</td>
                        <td>{{fb.ResponseMessage}}</td>
                        <td>{{fb.CanBeContacted}}</td>
                        <td>{{fb.Created}}</td>
                     </tr>
                  </tbody>
               </table>

            </div>
         </div>
      </div>
   </div>
</div>
<style>
   table td{
      word-wrap: break-word;
   }
</style>
<script>
   BMApp.register.controller('DevFeedbackCtrl', function ($state, $timeout, $http) {
      var self = this;
      $timeout(function () {
         $http.post('devfeedback/apiview').then(function (response) {
            self.feedback = $.map(response.data, function (item) {
               return item;
            });
         }, function (response) {
            $state.go('error');
         });
      },1000);
   });
</script>