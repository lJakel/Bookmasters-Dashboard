BMApp.register.controller('GeneratedController', ['$state', function ($state) {
      console.log($state.params);
      var self = this;
      self.Pages = [];
      self.Titles = [0, 102, 30];
      self.AddPage = function () {
         self.Pages.push(new self.Page(''));
      };
      self.RefreshJSON = function () {
         self.JSON = JSON.stringify(self.Pages);
      };

      self.Title = function (data) {
         var t = this;
         t.Title = data.Title || '';
         t.Subtitle = data.Subtitle || '';
         t.Authors = data.Authors || [new self.Author('')];
         t.MainDesc = data.MainDesc || 'BlankDes';

         t.Publisher = data.Publisher || '';
         t.ISBN = data.ISBN || '';
         t.Imprint = data.Imprint || '';
         t.Format = data.Format || '';
         t.Trim = data.Trim || '';
         t.USPrice = data.Price || '';
         t.CalcPrice = function () {

            var newPrice = t.USPrice;
            newPrice = newPrice.replace(/[^.0-9]+/g, "");
            newPrice = newPrice * 1.3;
            var locale = 'en';
            var options = {minimumFractionDigits: 2, maximumFractionDigits: 2};
            var formatter = new Intl.NumberFormat(locale, options);
            newPrice = formatter.format(newPrice);
            var priceArray, dollar, cents;
            priceArray = newPrice.split(".");
            dollar = priceArray[0];
            cents = priceArray[1];
            dollar = dollar.replace(/,/g, "");
            if (cents <= 45) {
               cents = 95;
               dollar = dollar - 1;
            } else if (cents >= 46 && cents <= 100) {
               cents = 95;
            }
            t.CANPrice = '\$' + dollar + "." + cents;

         };
         t.CANPrice = data.Price || '';
         t.Illlustrations = data.Illlustrations || '';
         t.AgeRange = data.AgeRange || '';

         t.ExtraSpecs = data.ExtraSpecs || [];
         t.Cover = data.Cover || 'http://bonniemeadowpublishing.com/images/themurder.svg';

         t.AddSpec = function () {
            t.ExtraSpecs.push(new self.Node(''));
         };
         t.AddAuthor = function () {
            t.Authors.push(new self.Author(''));
         };
      };
      self.Author = function (data) {
         var a = this;
         a.Prefix = data.Prefix || '';
         a.Suffix = data.Suffix || '';
         a.FirstName = data.FirstName || '';
         a.LastName = data.LastName || '';
         a.MiddleName = data.MiddleName || '';
         a.Description = data.Description || 'BlankBio';
         a.Role = data.Role || '';
      };
      self.Node = function (data) {
         var n = this;
         n.Order = data.Order || 0;
         n.Key = data.Key || '';
         n.Value = data.Value || '';
      };
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
   }]);