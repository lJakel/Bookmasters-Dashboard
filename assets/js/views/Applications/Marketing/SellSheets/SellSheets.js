BMApp.register.controller('SellSheetUploadController', ['$scope', 'toasty', 'Upload', '$http', '$timeout',function ($scope, toasty, Upload, $http,$timeout) {
      var self = this;
      self.password = '';
      self.uploaded = [];

      $scope.$watch(function () {
         return self.files;
      }, function () {
         self.upload(self.files);
      });
      $scope.$watch(function () {
         return self.file;
      }, function () {
         if (self.file != null) {
            self.files = [self.file];
         }
      });
      self.log = '';

      self.formatBytes = function (bytes, decimals) {
         if (bytes == 0)
            return '0 Byte';
         var k = 1000;
         var dm = decimals + 1 || 3;
         var sizes = ['bytes', 'kb', 'mb', 'gb', 'tb', 'pb', 'eb', 'eb', 'yb'];
         var i = Math.floor(Math.log(bytes) / Math.log(k));
         return (bytes / Math.pow(k, i)).toPrecision(dm) + ' ' + sizes[i];
      };

      self.clear = function () {
         $http.get('logout.php').then(function () {
            location.href = './';

         });
      };

      self.upload = function (files) {
         self.progress = {
            progressPercentage: 0,
            ngProgressPercentage: 0 + '%',
         };
         if (files && files.length) {
            for (var i = 0; i < files.length; i++) {
               var file = files[i];
               if (!file.$error) {
                  Upload.upload({
                     url: 'Marketing/SellSheets/Upload',
                     data: {
                        "uploadedfiles[]": file
                     }
                  }).then(function (resp) {
                     $timeout(function () {
                        toasty.success({title: 'Success!', msg: 'Your file ' + resp.config.data.file.name + ' was uploaded successfully.', theme: 'bootstrap', timeout: 5000});
                        self.uploaded.push({
                           name: resp.config.data.file.name,
                           path: resp.data,
                           size: self.formatBytes(resp.config.data.file.size),
                        });
                        console.log(resp.data, resp);
                     });
                  }, function (resp) {

                     toasty.error({title: 'Error!', msg: resp.data, theme: 'bootstrap', timeout: 8000});
                  }, function (evt) {
                     var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
                     self.progress = {
                        progressPercentage: progressPercentage,
                        ngProgressPercentage: progressPercentage + '%',
                     };
                     self.log = 'progress: ' + progressPercentage + '% ' + evt.config.data.file.name + '\n' + self.log;
                  });
               }
            }
         }
      };
   }]);