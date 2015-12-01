var Components = {
   AdditionalTitle: function (data) {
      var vm = this;
      vm.ISBN = data.ISBN || '';
      vm.Title = data.Title || '';
   },
   Contributor: function (data) {
      var vm = this;
      vm.FirstName = data.FirstName || '';
      vm.MiddleName = data.MiddleName || '';
      vm.LastName = data.LastName || '';
      vm.Prefix = data.Prefix || '';
      vm.Suffix = data.Suffix || '';
      vm.Hometown = data.Hometown || '';
      vm.Role = data.Role || '';
      vm.Biography = data.Biography || '';
      vm.IsRolePrimary = data.IsRolePrimary || false;
      vm.IsTitlePrimary = data.IsTitlePrimary || false;
      vm.AdditionalTitles = data.AdditionalTitles || [];
   },
   Bisac: function (data) {
      var vm = this;
      vm.FixedList = [];
      vm.FixedList2 = [];
      vm.BisacGroup = '';
      vm.Code = '';
      vm.Text = '';
      vm.Group = '';
      vm.LongName = '';
      vm.BisacID = '';
   },
   Review: function () {
      var self = this;
      self.Name = '';
      self.Publication = '';
      self.Text = '';
   },
   MarketingandPublicity: function () {
      var self = this;
      self.Type = '';
      self.Description = '';
   },
   AppearanceAndEvent: function () {
      var self = this;
      self.Name = '';
      self.Date = '';
      self.Location = '';
      self.Description = '';
   },
   Website: function () {
      var self = this;

      self.URL = '';
      self.Type = '';
   },
   Endorsement: function () {
      var self = this;
      self.Name = '';
      self.Affiliation = '';
      self.Text = '';
   },
   Format: function (data) {
      var self = this;

      self.ProductType = data.ProductType || '';
      self.ProductForm = data.ProductForm || '';
      self.ProductDetail = data.ProductDetail || '';
      self.ProductBinding = data.ProductBinding || '';
      self.ISBN13 = data.ISBN13 || '';
      self.Width = data.Width || '';
      self.Height = data.Height || '';
      self.Spine = data.Spine || '';
      self.Weight = data.Weight || '';
      self.PublicationDate = data.PublicationDate || '';
      self.Copyright = data.Copyright || '';
      self.StockDueDate = data.StockDueDate || '';
      self.TradeSales = data.TradeSales || '';
      self.Pages = data.Pages || '';
      self.CartonQuantity = data.CartonQuantity || '';
      self.USPrice = data.USPrice || '';
      self.DiscountCode = data.DiscountCode || '';
      self.CustomsValue = data.CustomsValue || '';
      self.Edition = data.Edition || '';
      self.EditionNumber = data.EditionNumber || '';
      self.EditionType = data.EditionType || '';
      self.CountryofOrigin = data.CountryofOrigin || '';
      self.PublicationLocation = data.PublicationLocation || '';
      self.ComparableTitles = data.ComparableTitles || [];
   },
   ComparableTitle: function (data) {
      var self = this;
      self.ISBN = data.ISBN || '';
      self.Title = data.Title || '';
   },
   Illustration: function (data) {
      var self = this;
      self.Type = data.Type || '';
      self.Description = data.Description || '';
      self.Number = data.Number || '';

   }
};