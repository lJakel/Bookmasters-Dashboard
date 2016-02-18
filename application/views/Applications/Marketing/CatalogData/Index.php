<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-xs-12">
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
               <div class="panel-body">
                  <button class="btn btn-primary" ng-click="gc.AddPage()">Add New Page</button>
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
                        <h1><input type="text" ng-model="p.Tab" class="ghost"></h1> 
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="header">
                        <h1><input type="text" ng-model="p.PageHeader" class="ghost"></h1>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xs-12">
                     <hr>
                  </div>
               </div>
               <div class="row" ng-repeat="t in p.Titles">
                  <div class="col-xs-4">
                     <div class="specblock">
                        <img src="{{t.Cover}}" width="100%"  alt="">
                        <span class="spec"> <input type="text" ng-model="t.Publisher" placeholder="Publisher" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.ISBN" placeholder="ISBN" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Format" placeholder="Format" class="ghost"></span>
                        <span class="spec"> 
                           USD <input type="text" ng-model="t.USPrice" ng-change="t.CalcPrice()" ng-model-options="{ updateOn: 'blur' }" placeholder="Price" style="width: 70px;" class="ghost">
                           (CAN <input type="text" ng-model="t.CANPrice" placeholder="Price" style="width: 70px;" class="ghost">)
                        </span>
                        <span class="spec"> 
                           <input type="text" ng-model="t.TrimWidth" placeholder="6" style="width: 30px;" class="ghost"> x 
                           <input type="text" ng-model="t.TrimHeight" placeholder="9" style="width:30px;" class="ghost">
                        </span>
                        <span class="spec"> <input type="text" ng-model="t.Pages" placeholder="Pages" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Bisac" placeholder="Bisac" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.PublicationDate" placeholder="PublicationDate" class="ghost"></span>
                        <span class="spec"> <input type="text" ng-model="t.Discount" placeholder="Discount" class="ghost"></span>

                        <span class="spec" ng-repeat="n in t.ExtraSpecs"> <input type="text" ng-model="n.Value" class="ghost"> {{n|json}}</span>
                        <button class="btn btn-sm btn-primary" ng-click="t.AddSpec();"><i class="fa fa-fw fa-plus"></i></button>
                     </div>
                  </div>
                  <div class="col-xs-8">
                     <div class="body">
                        <span class="title">
                           <summernote airmode>Treasured Possessions</summernote>
                        </span>
                        <span class="subtitle">
                           <summernote airmode>From the Renaissance to the Enlightenment</summernote>
                        </span>
                        <span class="author">Victoria Avery </span>
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
      <pre>{{p|json}}</pre>
      <link rel="stylesheet" href="assets/js/views/Applications/Marketing/CatalogData/style.css">
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData.js?cache=<?php echo rand(1000, 9000); ?>"></script>