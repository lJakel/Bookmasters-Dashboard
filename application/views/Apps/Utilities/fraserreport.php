<div class="row" ng-controller="UtilitiesFraserReport as UFR">
   <div class="col-md-3">
      <div class="panel panel-default">
         <div class="panel-body">

            <div class="panel-group" id="accordionBM">
               <div class="panel panel-default">
                  <div class="panel-heading">
                     <h4 class="panel-title">
                        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBM" style="display: block;cursor: pointer;" data-target="#collapseBM" aria-expanded="true">Fraser Reports</a>
                     </h4>
                  </div>
                  <div class="panel-collapse collapse in" id="collapseBM" aria-expanded="true">
                     <div class="list-group">
                        <a href="" class="list-group-item">January</a>

                     </div>
                  </div>
               </div>
            </div>

         </div>
      </div>
   </div>
   <div class="col-md-9">
      <div class="panel panel-default">
         <div class="panel-body">


            <input type="file" ngf-select ng-model="UFR.match" name="file">
            <input type="file" ngf-select ng-model="UFR.source" name="file">

            <button ng-click="UFR.uploadFraser()">Submit</button>
            

<!--            <div class="progress">
               <div class="progress-bar {{UFR.files[Format.ISBN13]['progress']['color']}}" 
                    role="progressbar" aria-valuenow="0" aria-valuemin="0" 
                    aria-valuemax="100" ng-style="{width: c.files[Format.ISBN13]['progress']['width'] + '%' }">
                  {{c.files[Format.ISBN13]['progress']['percentage']}}
               </div>
            </div>-->


            <span ng-show="picFile.result">Upload Successful</span>
            <span class="err" ng-show="errorMsg">{{errorMsg}}</span>

            <br>

         </div>
      </div>
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Apps/Utilities/FraserReport.js?cache=<?php echo rand(1000, 9000); ?>"></script>