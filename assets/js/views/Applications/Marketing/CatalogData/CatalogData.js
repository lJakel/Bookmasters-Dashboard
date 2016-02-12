BMApp.register.controller('GeneratedController', [function () {
      var self = this;
      self.Titles = [0, 102, 30];

      self.Title = function (data) {
         var t = this;
         t.Title = data.Title || '';
         t.Subtitle = data.Subtitle || '';
         t.Authors = data.Authors || [];
         t.Publisher = data.Publisher || '';
         t.Imprint = data.Imprint || '';
         t.ISBN = data.ISBN || '';
         t.Format = data.Format || '';
         t.USPrice = data.USPrice || '';
         t.CANPrice = data.CANPrice || '';
         t.Trim = data.Trim || '';
         t.Pages = data.Pages || '';
         t.Bisac = data.Bisac || '';
         t.Discount = data.Discount || '';
         t.Ages = data.Ages || '';
         t.PublicationDate = data.PublicationDate || '';
         t.Illustrations = data.Illustrations || '';
         t.MainDesc = data.MainDesc || '';
      };


   }]);