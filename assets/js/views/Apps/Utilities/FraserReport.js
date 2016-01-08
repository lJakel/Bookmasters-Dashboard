BMApp.register.controller('UtilitiesFraserReport', function ($state, $http, $q, $scope, toasty, $timeout, Upload) {
   var self = this;


   self.files = [];
   self.match = "";
   self.source = "";
   self.uploadFraser = function () {




      Upload.upload({
         url: 'http://10.10.11.48/Bookmasters-Dashboard/api/post',
         data: {
            match: self.match,
            source: self.source,
         
            data: "lol"

         }
      }).then(function (resp) {
//         self.files[isbn]['progress'] = {
//            percentage: "100%",
//            width: 100,
//            color: "progress-bar-success"
//         };
      }, function (resp) {
//         self.files[argisbn]['status'] = false;
//         self.files[isbn]['progress'] = {
//            percentage: "Error",
//            width: 100,
//            color: "progress-bar-danger"
//         };
      }, function (evt) {
         var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);

      });


   }
});