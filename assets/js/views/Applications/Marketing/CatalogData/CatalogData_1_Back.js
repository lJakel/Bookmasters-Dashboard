BMApp.register.controller('GeneratedController', ['$state', '$http', 'toasty', '$timeout', '$rootScope', function ($state, $http, toasty, $timeout, $rootScope) {
      console.log($state.params);
      var self = this;

      
      $timeout(function () {
app.state["sidebar-left"] = !app.state["sidebar-left"];
         self.Pages = [];
         self.Titles = [0, 102, 30];
         self.AddPage = function () {
            self.Pages.push(new self.Page(''));
         };
         self.RefreshJSON = function () {
            self.JSON = JSON.stringify(self.Pages);
         };
         self.Collapse = function () {
            app.state["sidebar-left"] = !app.state["sidebar-left"];
         }

         $http.post('Marketing/CatalogData/GetAllTitles').then(function (successResponse) {
            self.Titles = $.map(successResponse.data.data, function (item, i) {
               console.log(item, i);
               return new self.Title(item);
            });
            console.log(self.Titles);
//            self.Titles = successResponse.data.data;
         }, function (errorResponse) {
            $.each(errorResponse.data.errors, function (k, item) {
               toasty.error({title: 'Error!', msg: item.message, theme: 'bootstrap', timeout: 8000});
            });
         });
         self.Page = function (data) {

            var p = this;
            p.PageClass = 'cat-page-twoper';
            p.PageHeader = data.PageHeader || '';
            p.PageNumber = data.PageNumber || 0;
            p.PageFooter = data.PageFooter || '';
            p.Titles = data.Titles || [new self.Title('')];
            p.PerPage = data.PerPage || 1;
            p.CalcPerPage = 0;
            p.Tab = data.Tab || '';

            p.AddTitle = function () {
               p.Titles.push(new self.Title(''));
               p.calc();

            };
            p.calc = function () {
               switch (p.Titles.length) {
                  case 1:

                     p.PerPage = 1;
                     break;
                  case 2:

                     p.PerPage = 2;
                     break;
                  case 3:

                     p.PerPage = 3;
                     break;
                  case 4:

                     break;
                  case 6:

                     break;
                  case 8:

                     break;
                  case 10:

                     break;
                  case 12:

                     break;
                  default:

                     break;
               }
            }
            p.calc();

         };




         self.Title = function (data) {
            var t = this;
            t.ID = data.ID || '';
            t.Page = data.Page || '';
            t.PageRank = data.PageRank || '';
            t.PerPage = data.PerPage || '';
            t.Title = data.Title || '';
            t.Subtitle = data.Subtitle || '';
            t.Publisher = data.Publisher || '';
            t.Imprint = data.Imprint || '';
            t.ISBN = data.ISBN || '';
            t.Format = data.Format || '';
            t.USPrice = data.USPrice || '';
            t.CANPrice = data.CANPrice || '';
            t.TrimW = data.TrimW || '';
            t.TrimH = data.TrimH || '';
            t.Pages = data.Pages || '';
            t.BisacCode = data.BisacCode || '';
            t.BisacDesc = data.BisacDesc || '';
            t.PublicationDate = data.PublicationDate || '';
            t.IllustrationsCount = data.IllustrationsCount || '';
            t.IllustrationsType = data.IllustrationsType || '';
            t.AgeFrom = data.AgeFrom || '';
            t.AgeTo = data.AgeTo || '';
            t.MainDesc = data.MainDesc || '';
            t.Author1Name = data.Author1Name || '';
            t.Author1Bio = data.Author1Bio || '';
            t.Author2Name = data.Author2Name || '';
            t.Author2Bio = data.Author2Bio || '';
            t.Author3Name = data.Author3Name || '';
            t.Author3Bio = data.Author3Bio || '';
            t.Author4Name = data.Author4Name || '';
            t.Author4Bio = data.Author4Bio || '';
            t.Author5Name = data.Author5Name || '';
            t.Author5Bio = data.Author5Bio || '';
            t.Catalog = data.Catalog || '';
            t.Updated = data.Updated || '';

         };
      }, 1000);
   }]);
