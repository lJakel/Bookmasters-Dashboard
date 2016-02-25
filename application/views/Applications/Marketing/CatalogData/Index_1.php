<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-xs-12">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <button class="btn btn-primary" ng-click="gc.AddPage()">Add New Page</button>
                  <button class="btn btn-primary" ng-print print-element-id="catalog"><i class="fa fa-print"></i> Print</button>
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
                        <h1>
                           Page: {{t.Page}}, 
                           Per Page: {{t.PerPage}}, 
                           Page Rank: {{t.PageRank}}, 
                        </h1>
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
                        <img ng-src="./Storage/Catalogs/Christian/Data/Cover/{{t.ISBN}}.jpg" onerror="this.onerror=null;this.src='http://bookmasters.com/marktplc/images/nocover.jpg';" width="100%" alt="">
                        <span class="spec"> <input type="text" ng-model="t.Publisher" placeholder="Publisher" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.ISBN" placeholder="ISBN" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Format" placeholder="Format" class="ghost"></span>
                        <span class="spec">
                           USD $<input type="text" ng-model="t.USPrice" ng-change="t.CalcPrice()" placeholder="$" ng-style="{'width': t.USPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">
                           (CAN $<input type="text" ng-model="t.CANPrice" placeholder="$" ng-style="{'width': t.CANPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">)
                        </span>
                        <span class="spec">
                           <input type="text" ng-model="t.TrimW" placeholder="6" ng-style="{'width': t.TrimWidth.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> x
                           <input type="text" ng-model="t.TrimH" placeholder="9" ng-style="{'width': t.TrimHeight.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost">
                        </span>
                        <span class="spec"> <input type="text" ng-model="t.Pages" placeholder="Pages" class="ghost"></span>
                        <span class="spec"> <textarea name="" id="" cols="30" rows="2" type="text" ng-model="t.BisacDesc" placeholder="Bisac" class="ghost"></textarea></span>
                        <span class="spec"> <input type="text" ng-model="t.PublicationDate" placeholder="PublicationDate" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Discount" placeholder="Discount" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Illlustrations" placeholder="Illlustrations" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.AgeRange" placeholder="AgeRange" class="ghost"></span>
                        <span class="spec" ng-repeat="n in t.ExtraSpecs"> <input type="text" ng-model="n.Value" class="ghost"></span>
                        <i class="fa fa-fw fa-plus ShowOnScreen" ng-click="t.AddSpec()" style="cursor: pointer;"></i>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="body">
                        <i class="fa fa-fw fa-plus ShowOnScreen" ng-click="p.AddTitle()" style="cursor: pointer;"></i>
                        <i class="fa fa-fw fa-close pull-right ShowOnScreen" ng-click="p.AddTitle()" style="cursor: pointer;"></i>
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
                           <span ng-repeat="a in t.Authors">
                              <input type="text" ng-model="a.Prefix" placeholder="Mr." ng-style="{'width': a.Prefix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.FirstName" placeholder="Jake" ng-style="{'width': a.FirstName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.MiddleName" placeholder="A" ng-style="{'width': a.MiddleName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.LastName" placeholder="Ihasz" ng-style="{'width': a.LastName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.Suffix" placeholder="3rd" ng-style="{'width': a.Suffix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              ,
                           </span>

                           <i class="fa fa-fw fa-plus ShowOnScreen" ng-click="t.AddAuthor()" style="cursor: pointer;"></i>

                        </span>
                        <p class="body">
                        <summernote airmode ng-model="t.MainDesc"></summernote>
                        </p>
                        <p class="body">
                        <summernote airmode ng-model="t.Author1Bio"></summernote>
                        </p>

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
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData_1_Back.js?cache=<?= rand(1000, 9000); ?>"></script>