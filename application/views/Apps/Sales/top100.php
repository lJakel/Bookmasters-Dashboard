<div class="row" ng-controller="Top100 as t">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">


            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
               <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="home">


                  
                  <div tasty-table bind-resource-callback="getResource" bind-init="init" bind-filters="filterBy">
                     <table class="table table-striped table-condensed">
                        <thead tasty-thead></thead>
                        <tbody>
                           <tr ng-repeat="row in rows">
                              <td>{{ row.name}}</td>
                              <td>{{ row.star}}</td>
                              <td>{{ row['sf-location']}}</td>
                           </tr>
                        </tbody>
                     </table>
                     <div tasty-pagination></div>
                  </div>



               </div>
            </div>



         </div>
      </div>
   </div>
</div>
<script>
   BMApp.register.controller('Top100', ['$scope', '$http', function ($scope, $http) {
         var self = this;
         $scope.init = {
            'count': 5,
            'page': 1,
            'sortBy': 'name',
            'sortOrder': 'dsc',
            'filterBase': 1 // set false to disable
         };
         $scope.filterBy = {
            'name': 'r',
            'sf-location': ''
         };
         $scope.getResource = function (params, paramsObj) {
            var urlApi = 'table.json?' + params;
            return $http.post(urlApi, data).then(function (response) {
               return {
                  'rows': response.data.rows,
                  'header': response.data.header,
                  'pagination': response.data.pagination,
                  'sortBy': response.data['sort-by'],
                  'sortOrder': response.data['sort-order']
               }
            });
         }

      }]);
</script>