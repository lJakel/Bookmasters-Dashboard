<div class="row" ng-controller="SellSheetUploadController as ss">
   <div class="col-md-3">
      <div class="panel panel-default">
         <div class="panel-body">
            <h3>Recently Uploaded Sell Sheets</h3>
            <div class="list-group">
               <a href="#" class="list-group-item active">
                  <h4 class="list-group-item-heading">List group item heading</h4>
                  <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
               </a>
               <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">List group item heading</h4>
                  <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
               </a>
               <a href="#" class="list-group-item">
                  <h4 class="list-group-item-heading">List group item heading</h4>
                  <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
               </a>
            </div>
         </div>
      </div>
   </div>
   <div class="col-md-9">
      <div class="panel panel-default">
         <div class="panel-body">
            <h1>Get Started</h1>



            <div class="row">
               <div class="col-md-12 form-group">
                  <h3 style="margin:0px;padding:0px;">Upload File</h3>
               </div>
            </div>
            
            <div class="row">
               <div class="col-md-12 form-group">
                  <label class="control-label">Drop File (Max 100mb)</label>
                  <div ngf-drop ngf-select ng-model="ss.files" class="drop-box" 
                       ngf-drag-over-class="'dragover'" ngf-multiple="true" ngf-allow-dir="true">Drop files here or click to upload</div>
                  <div ngf-no-file-drop>File Drag/Drop is not supported for this browser</div>
               </div>
            </div>   
            <div class="row">
               <div class="col-md-12">
                  <div class="progress">
                     <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" ng-style="{width:ss.progress.ngProgressPercentage}" style="min-width: 2em;">
                        {{ss.progress.ngProgressPercentage}}
                     </div>
                  </div>
               </div>
            </div>


         </div>
      </div>
   </div>
</div>
<style>
   .drop-box {
      background: #F8F8F8;
      border: 3px dashed #DDD;
      width: 100%;                      
      text-align: center;
      padding: 25px;
   }
   .dragover {
      border: 5px dashed #354b5e;
   }

</style>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Marketing/SellSheets/SellSheets.js?cache=<?php echo rand(1000, 9000); ?>"></script>