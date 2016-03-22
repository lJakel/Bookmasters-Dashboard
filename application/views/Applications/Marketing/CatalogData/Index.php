<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-3">
            <div class="panel panel-default">
               <div class="panel-body">
                  <h2>Catalogs</h2>
                  <div class="list-group">
                     <a href="#" ng-click="gc.ChangeCatalog(catalog)" class="list-group-item" ng-repeat="catalog in gc.Catalogs">
                        {{catalog.Year}} {{catalog.Season}} {{catalog.Division}}
                        <span class="badge pull-right">{{catalog.Count[0]['count(*)']}}</span>
                     </a>
                  </div>
                  <div class="form-group">
                     <select name="" id="" class="form-control" ng-model="gc.CreateCatalogModel.Year">
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <select name="" id="" class="form-control" ng-model="gc.CreateCatalogModel.Season">
                        <option value="Summer">Summer</option>
                        <option value="Winter">Winter</option>
                        <option value="Fall">Fall</option>
                        <option value="Spring">Spring</option>
                     </select>
                  </div>
                  <div class="form-group">
                     <select name="" id="" class="form-control" ng-model="gc.CreateCatalogModel.Division">
                        <option value="AtlasBooks">AtlasBooks</option>
                        <option value="Christian">Christian</option>
                        <option value="University Press">University Press</option>
                     </select>
                  </div>
                  <button class="btn btn-primary btn-block" ng-click="gc.CreateCatalog()">Create Catalog</button>
               </div>
            </div>
         </div>

         <div class="col-md-9">
            <div class="panel panel-default">
               <div class="panel-body">
                  <div class="form-group">
                     <h2>Titles</h2>
                  </div>
                  <div class="form-group">
                     <button class="btn btn-danger " ng-click="gc.DeleteCatalog()">Delete Catalog</button> 
                     <button class="btn btn-primary " ng-click="gc.LoadCatalogEditor()">Load In Editor</button> 
                  </div>
                  <div class="table-responsive">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th>Page</th>
                              <th>Page Rank</th>
                              <th>Per Page</th>
                              <th>ISBN</th>
                              <th>Title</th>
                              <th>Publisher</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="title in gc.Titles">
                              <td>{{title.Page}}</td>
                              <td>{{title.PageRank}}</td>
                              <td>{{title.PerPage}}</td>
                              <td>{{title.ISBN}}</td>
                              <td style="word-wrap: break-word;">{{title.Title}}</td>
                              <td>{{title.Publisher}}</td>
                           </tr>
                        </tbody>
                     </table>
                  </div>

                  <nav>
                     <ul class="pagination">

                        <li ng-repeat="Page in gc.PaginationModel.PagesNum" ng-click='gc.ChangePage(Page)' ng-class="{'active':gc.PaginationModel.CurrentPage == Page}"><a href="#">{{Page}}</a></li>

                     </ul>
                  </nav>

               </div>
            </div>
         </div>
      </div>
      <link rel="stylesheet" href="assets/js/views/Applications/Marketing/CatalogData/style.css">
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData.js?cache=<?php echo rand(1000, 9000); ?>"></script>