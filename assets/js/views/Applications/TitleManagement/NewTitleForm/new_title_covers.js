function Covers(data, Dependencies) {
   var self = this;
   self.Model = {
      Covers: []
   };
   self.log = '';
   self.files = {};

   self.upload = function (file, isbn) {

      if (file) {
         var argisbn = isbn;
         self.files[argisbn] = {};
         self.files[argisbn]['status'] = null;

         Dependencies.Upload.upload({
            url: '//api.bookmasters.com/Files/Cover',
            data: {
               username: 'poop',
               isbn13: isbn,
               CoverFile: file
            }
         }).then(function (resp) {

            self.files[argisbn]['name'] = resp.config.data.CoverFile.name;
            self.files[argisbn]['type'] = resp.config.data.CoverFile.type;
            self.files[argisbn]['size'] = resp.config.data.CoverFile.size;
            self.files[argisbn]['status'] = true;

            self.files[isbn]['progress'] = {
               percentage: "100%",
               width: 100,
               color: "progress-bar-success"

            };
         }, function (resp) {
            self.files[argisbn]['status'] = false;
            self.files[isbn]['progress'] = {
               percentage: "Error",
               width: 100,
               color: "progress-bar-danger"
            };
         }, function (evt) {
            var progressPercentage = parseInt(100.0 * evt.loaded / evt.total);
            self.files[isbn]['progress'] = {
               percentage: progressPercentage + "%",
               width: progressPercentage,
               color: "progress-bar-info"

            };
         });
      }
   };

   self.formatBytes = function (bytes, decimals) {
      if (bytes == 0)
         return '0 Byte';
      var k = 1000;
      var dm = decimals + 1 || 3;
      var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];
      var i = Math.floor(Math.log(bytes) / Math.log(k));
      return (bytes / Math.pow(k, i)).toPrecision(dm) + ' ' + sizes[i];
   };

}