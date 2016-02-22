<div class="row" ng-controller="GeneratedController as gc">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <?php foreach ($Catalogs as $key => $value) { ?>
                     <div class="row">
                        <div class="col-md-12">
                           <h1><?= $key ?></h1>
                           <div class="row">
                              <?php foreach ($value as $key => $value) { ?>
                                 <div class="col-md-3">
                                    <span style="border: solid thin rgba(0,0,0,0.1); display: block; padding:5px; box-shadow: 0px 2px 2px rgba(0,0,0,0.1);    background-color: rgb(244, 244, 244);">
                                       <h3><?= $key ?></h3>
                                       <div class="row">
                                          <?php foreach ($value as $key => $value) { ?>
                                             <div class="col-md-6">
                                                <div class="thumbnail" style="background-color: #fff;">
                                                   <img src="http://10.10.11.48/AtlasBooks/marktplc/images/nocover.jpg" style="border:solid thin rgba(0,0,0,0.2);">
                                                   <div class="caption">
                                                      <h5><?= $value ?></h5>
                                                      <p>...</p>
                                                      <p><a data-ui-sref="bm.app.page({folder: 'Marketing', app:'CatalogData', child: null, page: 'View', params: {'Year':2016,'Season':'Spring','Division':'AtlasBooks'}})" class="btn btn-primary btn-sm" role="button">Load</a></p>
                                                   </div>
                                                </div>
                                             </div>
                                          <?php } ?>
                                       </div>
                                    </span>
                                 </div>
                              <?php } ?>
                           </div>
                           <hr>
                        </div>
                     </div>
                  <?php } ?>
               </div>   
            </div>
         </div>
      </div>
      <link rel="stylesheet" href="assets/js/views/Applications/Marketing/CatalogData/style.css">
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/CatalogData/CatalogData.js?cache=<?php echo rand(1000, 9000); ?>"></script>