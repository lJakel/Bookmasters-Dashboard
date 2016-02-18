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
               <div class="row cat-page-oneper" ng-repeat="t in p.Titles">
                  <div class="col-xs-4">
                     <div class="specblock">
                        <img src="{{t.Cover}}" width="100%" alt="">
                        <span class="spec"> <input type="text" ng-model="t.Publisher" placeholder="Publisher" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.ISBN" placeholder="ISBN" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Format" placeholder="Format" class="ghost"></span>
                        <span class="spec">
                           USD <input type="text" ng-model="t.USPrice" ng-change="t.CalcPrice()" placeholder="$" ng-style="{'width': t.USPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">
                           (CAN <input type="text" ng-model="t.CANPrice" placeholder="$" ng-style="{'width': t.CANPrice.length * 8 + 'px' }" style="width:auto;min-width:10px;" class="ghost">)
                        </span>
                        <span class="spec">
                           <input type="text" ng-model="t.TrimWidth" placeholder="6" ng-style="{'width': t.TrimWidth.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost"> x
                           <input type="text" ng-model="t.TrimHeight" placeholder="9" ng-style="{'width': t.TrimHeight.length * 8 + 'px' }" style="width:10px;min-width:10px;" class="ghost">
                        </span>
                        <span class="spec"> <input type="text" ng-model="t.Pages" placeholder="Pages" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Bisac" placeholder="Bisac" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.PublicationDate" placeholder="PublicationDate" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Discount" placeholder="Discount" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Illlustrations" placeholder="Illlustrations" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.AgeRange" placeholder="AgeRange" class="ghost"></span>
                        <span class="spec" ng-repeat="n in t.ExtraSpecs"> <input type="text" ng-model="n.Value" class="ghost"></span>
                        <button class="btn btn-xs btn-primary" ng-click="t.AddSpec();"><i class="fa fa-fw fa-plus"></i></button>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="body">
                        <span class="title">
                           <input type="text" ng-model="t.Title" placeholder="Title" class="ghost">
                        </span>
                        <span class="subtitle">
                           <input type="text" ng-model="t.Subtitle" placeholder="Subtitle" class="ghost">
                        </span>
                        <span class="author">
                           <span ng-repeat="a in t.Authors">
                              <input type="text" ng-model="a.Prefix" placeholder="Prefix" ng-style="{'width': a.Prefix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.FirstName" placeholder="FirstName" ng-style="{'width': a.FirstName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.MiddleName" placeholder="MiddleName" ng-style="{'width': a.MiddleName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.LastName" placeholder="LastName" ng-style="{'width': a.LastName.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              <input type="text" ng-model="a.Suffix" placeholder="Suffix" ng-style="{'width': a.Suffix.length * 8 + 'px' }" style="width:auto;min-width:30px;" class="ghost">
                              ,
                           </span>
                           <button class="btn btn-xs btn-primary"><i class="fa fa-fw fa-plus"></i></button>
                        </span>
                        <p class="body">
                        <summernote airmode>
                           One of the world’s finest assemblages of rings and gemstones, the Guy Ladrière Collection in Paris is of major importance both to the collector and the art historian. This handsome volume, written and compiled by three of the foremost experts on gems and semi-precious stones, is the first to catalogue, illustrate, and describe all the pieces in the Collection. Comprising some 300 items, and including a rich and varied mixture of cameos and intaglios, the Collection ranges from ancient artefacts originating in the Minoan period to gemstones and rings of the 19th century. It also boasts many medieval pieces, Christian crystal plaques and Lombardic stones with inscriptions. Of special interest are the prize pieces in the Collection. These include the famous rhinoceros, most probably depicting an identifiable animal (the celebrated ‘Madrid’ rhinoceros, also known as the ‘Marvel of Lisbon’ and taken from Portugal to Spain in 1583); Queen Elizabeth I crowned with the mythological lionskin of Hercules, and presented as the power to tame the forces of evil; and some remarkable and varied pairs of heads.
                        </summernote>
                        </p>
                        <p class="body">Diana Scarisbrick, a noted authority on engraved gems, and a former jewelry editor at Harpers & Queen Magazine, is now a research associate at the Beazley Archive in the University of Oxford. Her many publications include Finger Rings: Ancient and Modern and Rings: Miniature Monuments to Love, Power and Devotion.</p>
                        <p class="body">Claudia Wagner is a senior researcher at the Beazley Archive, where she directs the gems databases and research program, and senior research lecturer at Lady Margaret Hall, Oxford. She is co-author (with John Boardman) of The Marlborough Gems.</p>
                        <p class="body">John Boardman is the co-author of The Marlborough Gems.</p>
                     </div>
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