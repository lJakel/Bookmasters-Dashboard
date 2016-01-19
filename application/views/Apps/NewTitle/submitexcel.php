<div ng-controller="SubmitExcel as se">
   <div class="row">

      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <h4>Upload on file select</h4>
                     <button class='btn btn-primary' type="file" ngf-select="se.uploadFiles($file, $invalidFiles)" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" ngf-max-size="100MB">Select File</button>
                     <br><br>
                     File:
                     <div style="font:smaller">{{se.f.name}} {{se.errFile.name}} {{se.errFile.$error}} {{se.errFile.$errorParam}}
                        <div class="progress">
                           <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width:{{se.f.progress}}%;">
                              {{se.f.progress}}%
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 form-group">

                     <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                           <a href="#" data-target="#success" aria-controls="success" role="tab" data-toggle="tab">Success <span class="badge">{{se.success.count}}</span> </a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#failed" aria-controls="failed" role="tab" data-toggle="tab">Failed
                              <button id="showme" style="visibility: hidden; width:0px; padding:0px;margin:0px; border:none; height:0px;" type="button" class="" data-container="body" data-toggle="popover" data-placement="top" 
                                      title="Errors" 
                                      data-content="You have errors in the file you submitted. You can view the errors here."></button>
                              <span class="badge">{{se.failed.count}}</span>
                           </a>
                        </li>

                     </ul>
                     <div class="tab-content" id="printThis">
                        <!--basic-->
                        <div role="tabpanel" class="tab-pane active" id="success">
                           <table class="table table-responseive table-bordered">
                              <thead>
                                 <tr>
                                    <th>Row</th>
                                    <th>Title</th>
                                    <th>ISBN</th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <tr ng-repeat="row in se.success.items">
                                    <td>{{row.row}}</td>
                                    <td>{{row.title}}</td>
                                    <td>{{row.isbn}}</td>
                                 </tr>
                              </tbody>
                           </table>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="failed">


                           <div class="panel panel-default" ng-repeat="row in se.failed.items">
                              <div class="panel-heading"> Row: {{row.row}} - Title: {{row.title}}</div>
                              <div class="panel-body">
                                 <p>Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                              </div>
                              <ul class="list-group">
                                 <li class="list-group-item" ng-repeat="error in row.errors"> 
                                    <strong>{{error.field}}</strong> {{error.message}}
                                 </li>
                              </ul>
                           </div>


                        </div>
                     </div>
                  </div>
               </div>
               <div class="row" ng-if="se.errorMsg">
                  <div class="col-md-12 form-group">
                     <div class="alert alert-danger" role="alert"> <strong>Error!</strong> {{se.errorMsg}} </div>

                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<style>
   .thumb {
      width: 24px;
      height: 24px;
      float: none;
      position: relative;
      top: 7px;
   }
</style>
<script>

   BMApp.register.controller("SubmitExcel", function (Upload, $timeout) {

      var self = this;
      self.success = {
         items: [],
         count: null
      }
      self.failed = {
         items: [],
         count: null,
      }



      self.uploadFiles = function (file, errFiles) {
         self.f = file;
         self.errFile = errFiles && errFiles[0];
         if (file) {
            file.upload = Upload.upload({
               url: 'TitleManagement/submitexcelupload',
               data: {file: file}
            });
            file.upload.then(function (response) {
               $timeout(function () {
                  file.result = response.data.data;
               });
            }, function (response) {
               
               if (response.status > 0) {
                  self.failed.items = $.map(response.data.data.error, function (item) {
                     return item;
                  })
                  self.success.items = $.map(response.data.data.success, function (item) {
                     return item;
                  })
                  self.failed.count = self.failed.items.length;
                  self.success.count = self.success.items.length;
                  self.errorMsg = response.data.message.error;

                  $timeout(function () {
                     $('#showme').popover('show');
                  }).then(function () {
                     $timeout(function () {
                        $('#showme').popover('hide');
                     }, 5000);
                  });
               }
            }, function (evt) {
               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
         }
      }
   });

</script>
<!--<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/share/components.js?cache=<?php echo rand(1000, 9000); ?> "></script>-->