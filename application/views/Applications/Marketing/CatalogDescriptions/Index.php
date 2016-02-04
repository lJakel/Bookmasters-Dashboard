<div  ng-controller="CatalogDescriptionsController as cd">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-4">
                     <label for="" class="control-label">Search</label>
                     <div class="input-group form-group">
                        <span class="input-group-addon">
                           <i class="fa fa-fw fa-search"></i>
                        </span>
                        <input type="text" class="form-control" ng-model="SearchFilter">
                     </div>
                  </div>
                  <div class="col-md-4">
                     <label for="" class="label-control">Sort By</label>
                     <select name="" id="" class="form-control" ng-model="cd.SortBy">
                        <option value="Title" selected>Title</option>
                        <option value="SubTitle">SubTitle</option>
                        <option value="Publisher">Publisher</option>
                        <option value="ISBN">ISBN</option>
                        <option value="Complete">Completed</option>
                     </select>
                  </div>
                  <div class="col-md-2">
                     <label for="" class="label-control">
                     </label>
                     <div class="checkbox checkbox-primary">
                        <input id="ShowComplete" type="checkbox" ng-model="cd.ShowComplete">
                        <label for="ShowComplete"> Show Complete? </label>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-9">
         <div class="row">
            <div class="col-md-12" ng-repeat="t in cd.Titles| filter: SearchFilter | orderBy: cd.SortBy" ng-hide="cd.ShowComplete == false && t.Complete == true">
               <div class="panel panel-default">

                  <div class="panel-body">
                     <h2>{{t.Title}} <i class="fa fa-fw fa-check-circle" ng-if="t.Complete == 1" style="color: #5cb85c;"></i></h2>
                     <h4>{{t.SubTitle}}</h4>
                     <h4><i>{{t.Publisher}}</i></h4>
                     <h5><i>{{t.Authors}}</i></h5>
                     <h5>{{t.ISBN}}</h5>
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
                  </div>
                  <div class="panel-footer">
                     <div class="row">
                        <div class="col-md-8">
                           <h5 style="line-height: 30px;margin:0;">This title was last updated on: {{t.UpdatedDisplay}}</h5>
                        </div>
                        <div class="col-md-4">
                           <button class="btn btn-danger btn-sm pull-right"  ng-click="cd.DeleteItem(t)">Delete</button>
                           <button class="btn btn-primary btn-sm pull-right"style="margin-right: 5px;" ng-click="cd.showItemModal(t, 'Title', 'edit')">Edit</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-md-3">
         <div class="panel panel-default">
            <div class="panel-body">
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

   <?php $this->load->view('Applications/Marketing/CatalogDescriptions/modals/edittitle'); ?>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogDescriptions/CatalogDescriptions.js?cache=<?= rand(1000, 9000); ?>"></script>
