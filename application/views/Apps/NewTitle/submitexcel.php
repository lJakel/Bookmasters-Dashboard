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
                     {{se.errorMsg}}
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12">
                     <table class="table table-responseive table-bordered">
                        <thead>
                           <tr>
                              <th>ISBN</th>
                              <th>Title</th>
                           </tr>
                        </thead>
                        <tbody>
                           <tr ng-repeat="blah in se.blah">
                              <td>{{blah.isbn}}</td>
                              <td>{{blah.title}}</td>

                           </tr>
                        </tbody>
                     </table>
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
      self.uploadFiles = function (file, errFiles) {
         self.f = file;
         self.errFile = errFiles && errFiles[0];
         if (file) {
            file.upload = Upload.upload({
               url: 'newtitle/submitexcelupload',
               data: {file: file}
            });
            file.upload.then(function (response) {
               $timeout(function () {
                  file.result = response.data;
               });
            }, function (response) {
               console.log(response.data)
               if (response.status > 0) {
                  self.blah = $.map(response.data.failed, function (item) {
                     return item;
                  })
                  self.errorMsg = response.data.errorCount + ' Failed';
               }
            }, function (evt) {
               file.progress = Math.min(100, parseInt(100.0 * evt.loaded / evt.total));
            });
         }
      }

      self.blah = '';
   });
</script>
<!--<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/share/components.js?cache=<?php echo rand(1000, 9000); ?>"></script>-->