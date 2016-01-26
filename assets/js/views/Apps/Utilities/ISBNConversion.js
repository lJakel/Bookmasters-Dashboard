BMApp.register.controller('UtilitiesISBNConversion', ['$http', '$scope', 'toasty', '$timeout', function ($http, $scope, toasty, $timeout) {
      var self = this;
      self.model = {
         input: '',
         output: '',
         isbns: []
      }
      self.Convert = function () {
         $http.post('Utilities/ISBNConversionAPI', self.model).then(function (response) {
            self.model.output = '';
            $.each(response.data.data, function (k, item) {
               console.log(item);
               self.model.output += (item.isbn13 || "") + "\n";
            });
            self.model.isbns = response.data.data;
 toasty.success({title: 'Success!', msg: 'Fake Success msg', theme: 'bootstrap', timeout: 8000});
         }, function (response) {
            toasty.Warning({title: 'Warning!', msg: 'An error occured.', theme: 'bootstrap', timeout: 5000});
         });
      };

   }]);