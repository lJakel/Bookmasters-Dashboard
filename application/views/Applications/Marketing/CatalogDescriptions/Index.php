<div class="row" ng-controller="CatalogDescriptionsController as cd">
   <div class="col-md-12">
      <div class="row">
         <div class="col-md-9">

            <div ng-attr-class="{{'col-md-' + cd.PerPage}}" ng-repeat="t in cd.Titles| filter:SearchFilter">
               <div class="panel panel-default">
                  <div class="panel-body">
                     <h2>{{t.Title}}</h2>
                     <h4>{{t.SubTitle}}</h4>
                     <h6><i>{{t.Authors}}</i></h6>
                     <h6>{{t.ISBN}}</h6>
                     <hr>
                     <div class="row">
                        <div class="col-md-12 form-group required">
                           <label for="" class="control-label">Main Description</label>
                           <div ng-bind-html="t.MainDescriptionSafe"></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12 form-group required">
                           <label for="" class="control-label">Author Bios</label>
                           <div ng-bind-html="t.AuthorBiosSafe"></div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                           <button class="btn btn-primary" ng-click="cd.showItemModal(t, 'Title', 'edit')">Edit</button>
                           <button class="btn btn-danger" ng-click="cd.DeleteItem(t)">Delete</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-3">
            <div class="panel panel-default">
               <div class="panel-body">
                  <label for="" class="control-label">Titles Per Row</label>
                  <div class="btn-group btn-group-justified" role="group" aria-label="...">
                     <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" ng-click="cd.PerPage = 3">4</button>
                     </div>
                     <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" ng-click="cd.PerPage = 4">3</button>
                     </div>
                     <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" ng-click="cd.PerPage = 6">2</button>
                     </div>
                     <div class="btn-group" role="group">
                        <button type="button" class="btn btn-default" ng-click="cd.PerPage = 12">1</button>
                     </div>
                  </div>
                  <hr>
                  <h3>Other Titles <i class="fa fa-refresh"></i></h3>

                  <div class="input-group form-group">
                     <span class="input-group-addon">
                        <i class="fa fa-fw fa-search"></i>
                     </span>
                     <input type="text" class="form-control" ng-model="SearchFilter">

                  </div>
                  <ul class="list-group">
                     <li ng-repeat="t in cd.Titles| filter:SearchFilter" style="cursor: pointer;" class="list-group-item" ng-click="cd.showItemModal(t, 'Title', 'edit')">
                        <span style="overflow-wrap: break-word;word-wrap: break-word;-ms-word-break: break-all;word-break: break-all;word-break: break-word;-ms-hyphens: auto;-moz-hyphens: auto;-webkit-hyphens: auto;hyphens: auto;">
                           {{t.ISBN}} - {{t.Title}} - {{t.SubTitle}}
                        </span>
                     </li>
                  </ul>
                  <button class="btn btn-primary btn-block" ng-click="cd.AddTitle('Title')">Create Title</button>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php $this->load->view('Applications/Marketing/CatalogDescriptions/modals/edittitle'); ?>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogDescriptions/CatalogDescriptions.js?cache=<?= rand(1000, 9000); ?>"></script>
