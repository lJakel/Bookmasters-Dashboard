<div class="row" ng-controller="Top100 as t">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">

            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Top 100</a></li>
               <!--<li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>-->
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="home">



                  <div tasty-table bind-resource-callback="t.getResource" bind-init="t.config.init" bind-theme="t.config.theme">
                     <table class="table table-striped table-bordered table-condensed">
                        <thead tasty-thead></thead>
                        <tbody>
                           <tr ng-repeat="row in rows">
                              <td>{{row.Isbn13}}</td>
                              <td>{{row.Title}}</td>
                              <td>{{row.ProductBinding}}</td>
                              <td>{{row.DataType}}</td>
                              <td>{{row.UnitRank}}</td>
                              <td>{{row.Units}}</td>
                              <td>{{row.NetSales}}</td>
                              <td>{{row.Inventory}}</td>
                              <td>{{row.OnOrder}}</td>
                              <td>{{row.LastUpdated}}</td>
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
   BMApp.register.controller('Top100', ['$http', function ($http) {
         var self = this;
         self.config = {
            init: {
               'count': 20,
               'page': 1,
               'sortBy': 'Isbn13',
               'sortOrder': 'desc',
               'filterBase': 1 // set false to disable
            },
            theme: {
               bootstrapIcon: false,
               bindOnce: true,
               loadOnInit: true,
               iconUp: 'fa fa-sort-up',
               iconDown: 'fa fa-sort-down',
               itemsPerPage: 15,
               listItemsPerPage: [5, 25, 50, 100, 200],
            }
         };
         self.getResource = function (params, paramsObj) {
            var urlApi = 'http://10.10.11.48/Bookmasters-Dashboard/sales/api';
            return $http.post(urlApi, paramsObj).then(function (response) {
               console.log(response);
               return {
                  'rows': response.data.data.rows,
                  'header': response.data.data.header,
                  'pagination': response.data.data.pagination,
                  'sortBy': response.data.data['sort-by'],
                  'sortOrder': response.data.data['sort-order']
               }
            });
         }
      }]);
</script>