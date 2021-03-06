<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-xs-12">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <button class="btn btn-primary" ng-click="gc.AddPage()">Add New Page</button>
                  <button class="btn btn-primary" ng-print print-element-id="catalog"><i class="fa fa-print"></i> Print</button>
                  <button class="btn btn-primary" ng-click="gc.ReloadCatalog()"><i class="fa fa-refresh"></i> Reload Catalog</button>
               </div>
            </div>
         </div>
      </div>
     
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <nav>
                     <ul class="pagination">
                        <li ng-repeat="Page in gc.PaginationModel.PagesNum" ng-click='gc.ChangePage(Page)' ng-class="{'active':gc.PaginationModel.CurrentPage == Page}"><a href="#">{{Page}}</a></li>
                     </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-xs-12" id="catalog">
            <div class="page" class="ShowOnScreen">
               <br>
               <br>
               <br>
               <br>
               <br>
               <h1>Blank on purpose</h1>
               <h3>To see the catalog spread, collapse the sidebar</h3>
               <button class="btn btn-default" ng-click="gc.Collapse()">Collapse and See Spread</button>
            </div>
            <div class="page" ng-repeat="t in gc.Titles" ng-class-even="'left-page'" ng-class-odd="'right-page'">
               <div class="row cat-page-header">
                  <div class="col-xs-4">
                     <div class="tab">
                        <h1>{{t.Publisher}}</h1>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="pageheader">
                        <h4>
                           Page: {{::t.Page}},
                           Per Page: {{::t.PerPage}},
                           Page Rank: {{::t.PageRank}}
                        </h4>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <hr>
                  </div>
               </div>
               <div class="row cat-page-oneper" >
                  <div class="col-xs-4">
                     <div class="specblock">


                        <img ngf-drop="gc.UploadCover($files,t.ISBN)" ngf-select="gc.UploadCover($files,t.ISBN)"
                             ngf-drag-over-class="'dragover'" accept="image/*" ngf-pattern="'image/*'" 
                             ng-src="./Storage/Catalogs/2016/Fall/AtlasBooks/Data/Cover/{{t.ISBN}}.jpg?cache={{t.Random}}"
                             onerror="this.onerror=null;this.src='http://bookmasters.com/marktplc/images/nocover.jpg';" width="100%" alt="">

                        <span class="spec"> <input type="text" ng-model="t.Publisher" placeholder="Publisher" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.ISBN" placeholder="ISBN" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Format" placeholder="Format" class="ghost"></span>
                        <span class="spec">
                           USD $<input type="text" ng-model="t.USPrice" placeholder="$" ng-style="{'width': t.USPrice.length * 8.3 + 'px' }" style="width:auto;min-width:10px;" class="ghost" ng-change="t.CalcPrice()">
                           (CAN $<input type="text" ng-model="t.CANPrice" placeholder="$" ng-style="{'width': t.CANPrice.length * 8.3 + 'px' }" style="width:auto;min-width:10px;" class="ghost">)
                        </span>
                        <span class="spec">
                           <input type="text" ng-model="t.TrimW" placeholder="6" ng-style="{'width': t.TrimW.length * 8.3 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> x
                           <input type="text" ng-model="t.TrimH" placeholder="9" ng-style="{'width': t.TrimH.length * 8.3 + 'px' }" style="width:10px;min-width:10px;" class="ghost">, <input type="text" ng-model="t.Pages" placeholder="Pages" ng-style="{'width': t.Pages.length * 8.3 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> pages
                        </span>
                        <span class="spec"> <textarea name="" id="" cols="30" rows="2" type="text" ng-model="t.BisacDesc" placeholder="Bisac" class="ghost"></textarea></span>
                        <span class="spec"> <input type="text" ng-model="t.PublicationDate" placeholder="PublicationDate" class="ghost"></span>
                        <div class="form-group ShowOnScreen">
                           <span class="spec">
                              <span class="pull-left">Discount</span>
                              <select name="" id="" ng-model="t.Discount" class="input-sm form-control pull-right " style=' width:auto;' class='ghost'>
                                 <option value="">None</option>
                                 <option value="TRD">TRD</option>
                                 <option value="TRT">TRT</option>
                                 <option value="SHL">SHL</option>
                                 <option value="SHT">SHT</option>
                                 <option value="BIB">BIB</option>
                              </select>
                           </span>
                        </div>
                        <span class="spec ShowOnPrint">Discount: {{t.Discount}}</span>
                        <div style='clear:both;'></div>
                        <div class="form-group ShowOnScreen">
                           <span class="spec">
                              <span class="pull-left" style='font-size:12px;'>Illustrations Type</span>
                              <select name="" id="" ng-model="t.IllustrationsType" class="input-sm form-control pull-right" style=' width:auto;'  class='ghost'>
                                 <option value="">None</option>
                                 <option value="Color">Color</option>
                                 <option value="Black and White">Black and White</option>
                              </select>
                           </span>
                        </div>
                        <span class="spec ShowOnPrint">Illus Type: {{t.IllustrationsType}}</span>
                        <span class="spec ShowOnPrint">Illus Number: {{t.IllustrationsCount}}</span>
                        <span class="spec"> <input type="text" ng-model="t.IllustrationsCount" placeholder="IllustrationsCount" class="ghost ShowOnScreen"></span>
                        <span class="spec"> Ages
                           <input type="text" ng-model="t.AgeFrom" placeholder="5" ng-style="{'width': t.AgeFrom.length * 8.3 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> to
                           <input type="text" ng-model="t.AgeTo" placeholder="10" ng-style="{'width': t.AgeTo.length * 8.3 + 'px' }" style="width:10px;min-width:10px;" class="ghost">
                        </span>
                        <span class="spec" ng-repeat="n in t.ExtraSpecs"> <input type="text" ng-model="n.Value" class="ghost"></span>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="body">
                        <i class="fa fa-fw fa-save pull-right ShowOnScreen" ng-click="gc.UpdateTitle($index)" style="cursor: pointer;"></i>
                        <span class="title">
                           <textarea type="text" ng-model="t.Title" placeholder="Title" class="ghost ShowOnScreen"></textarea>
                           <span class="ShowOnPrint">{{t.Title}}</span>
                        </span>
                        <span class="subtitle">
                           <textarea type="text" ng-model="t.Subtitle" placeholder="Subtitle" class="ghost ShowOnScreen"></textarea>
                           <span class="ShowOnPrint">{{t.Subtitle}}</span>
                        </span>
                        <span class="author">
                           <textarea type="text" ng-model="t.Author1Name" placeholder="Author" class="ghost ShowOnScreen"></textarea>
                           <span class="ShowOnPrint">{{t.Author1Name}}</span>
                        </span>

                        <i class="fa fa-edit" ng-click="gc.showEditTitleModal(t)" style="cursor: pointer;"></i>
                        <p class="body" ng-bind-html='t.MainDescSafe()'></p>
                        <i class="fa fa-edit" ng-click="gc.showEditTitleModal(t)" style="cursor: pointer;"></i>
                        <p class="body" ng-bind-html='t.Author1BioSafe()'></p>
                     </div>
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
      <link rel="stylesheet" href="assets/js/views/Applications/Marketing/CatalogData/style.css?cache=<?= rand(1000, 9000); ?>">
   </div>

   <?php $this->load->view('Applications/Marketing/CatalogData/Modals/edittitle'); ?>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData_1_Back.js?cache=<?= rand(1000, 9000); ?>"></script>
<style>
   .dragover{
      border:5px dotted black !important;
   }
</style>