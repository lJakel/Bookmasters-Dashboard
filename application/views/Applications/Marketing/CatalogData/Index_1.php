<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-xs-12">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <button class="btn btn-primary" ng-click="gc.AddPage()">Add New Page</button>
                  <button class="btn btn-primary" ng-click="gc.RefreshJSON()">Refresh JSON</button>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12">
            <div class="page" ng-repeat="p in gc.Pages" ng-class-even="'right-page'" ng-class-odd="'left-page'">
               <div class="row cat-page-header">
                  <div class="col-xs-4">
                     <div class="tab">
                        <h1><input type="text" ng-model="p.Tab" placeholder="Tab Text" class="ghost"></h1>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="header">
                        <h1><input type="text" ng-model="p.PageHeader" placeholder="Page Header" class="ghost"></h1>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <hr>
                  </div>
               </div>
               <div class="wrap" ng-switch on="p.PerPage">
                  <div ng-switch-when="1">
                     <ng-include src="'Marketing/CatalogData/OnePer'"></ng-include>
                  </div>
                  <div ng-switch-when="2">
                     <ng-include src="'Marketing/CatalogData/TwoPer'"></ng-include>
                  </div>
                  <div ng-switch-when="3">
                     <ng-include src="'Marketing/CatalogData/ThreePer'"></ng-include>
                  </div>
                  <div ng-switch-when="4">
                     <ng-include src="'Marketing/CatalogData/FourPer'"></ng-include>
                  </div>
                  <div ng-switch-when="6">
                     <ng-include src="'Marketing/CatalogData/SixPer'"></ng-include>
                  </div>
                  <div ng-switch-when="8">
                     <ng-include src="'Marketing/CatalogData/EightPer'"></ng-include>
                  </div>
                  <div ng-switch-when="10">
                     <ng-include src="'Marketing/CatalogData/TenPer'"></ng-include>
                  </div>
                  <div ng-switch-when="12">
                     <ng-include src="'Marketing/CatalogData/TwelvePer'"></ng-include>
                  </div>
               </div>

               <div class="row">
                  <div class="col-xs-12">
                     <hr>
                     
                  </div>
               </div>
            </div>
         </div>
      </div>
      <pre>{{gc.JSON}}</pre>
      <link rel="stylesheet" href="assets/js/views/Applications/Marketing/CatalogData/style.css">
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData.js?cache=<?php echo rand(1000, 9000); ?>"></script>