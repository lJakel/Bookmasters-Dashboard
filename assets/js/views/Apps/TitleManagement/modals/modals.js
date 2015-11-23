var Modals = {
   ContributorBSModal: function (data) {
      var self = this;
      self.entryData = undefined;
      self.method = '';

      self.FirstName = '';
      self.MiddleName = '';
      self.LastName = '';
      self.Prefix = '';
      self.Suffix = '';
      self.Hometown = '';
      self.Role = '';
      self.Biography = '';

      self.FixedAuthorRoles = [];

      self.IsRolePrimary = false;
      self.IsTitlePrimary = false;
      self.AdditionalTitles = [];


      self.addAdditionalTitle = addAdditionalTitle;
      self.removeAdditionalTitle = removeAdditionalTitle;


      function addAdditionalTitle() {
         self.AdditionalTitles.push(new Components.AdditionalTitle(''));
      }
      function removeAdditionalTitle(index) {
         self.AdditionalTitles.splice(index, 1);
      }

   },
   FormatBSModal: function () {
      var self = this;
      self.entryData = undefined;
      self.method = '';
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
      self.Illustrations = data.Illustrations || [];

      self.FixedProductTypes = [];
      self.FixedProductForms = [];
      self.FixedProductFormDetails = [];
      self.FixedProductFormDetailSpecifics = [];


      self.DynamicProductTypes = [];
      self.DynamicProductForms = [];
      self.DynamicProductFormDetails = [];
      self.DynamicProductFormDetailSpecifics = [];


      self.GetDynamicProductForms = GetDynamicProductForms;
      self.GetDynamicProductDetails = GetDynamicProductDetails;
      self.GetDynamicProductFormDetailSpecifics = GetDynamicProductFormDetailSpecifics;
      self.addIllustration = addIllustration;
      self.removeIllustration = removeIllustration;
      self.addComparableTitle = addComparableTitle;
      self.removeComparableTitle = removeComparableTitle;



      function GetDynamicProductForms(watch) {
         var watch = watch || false;

         if (self.ProductType != '') {
            var SelectedProductType = self.ProductType; //get previously seelected item
            var myRegexp = /(\d+)\s+-\s+\w+/g; // setup regex to grab value from dropdown
            var match = myRegexp.exec(SelectedProductType); // exec the regex grab
            var newdata = self.FixedProductForms;
            self.DynamicProductForms = [];
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductForm = "";
            self.ProductDetail = "";
            self.ProductBinding = "";
         }
      }

      function GetDynamicProductDetails(watch) {
         var watch = watch || false;

         if (self.ProductForm != '') {
            var SelectedProductForm = self.ProductForm; //get previously seelected item
            var myRegexp = /(\d+)\s+-\s+\w+/g; // setup regex to grab value from dropdown
            var match = myRegexp.exec(SelectedProductForm); // exec the regex grab
            var newdata = self.FixedProductFormDetails;
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductDetail = "";
            self.ProductBinding = "";
            if (match != null) {
               match = match[1]
               self.DynamicProductFormDetails = newdata.filter(function (el) {
                  return el.FormId == match;
               });

            }
         }
      }

      function GetDynamicProductFormDetailSpecifics(watch) {
         var watch = watch || false;
         if (self.ProductDetail != '') {
            var SelectedProductFormDetail = self.ProductDetail; //get previously seelected item
            var myRegexp = /(\d+)\s+-\s+\w+/g; // setup regex to grab value from dropdown
            var match = myRegexp.exec(SelectedProductFormDetail); // exec the regex grab

            var newdata = self.FixedProductFormDetailSpecifics;
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductBinding = "";
            if (match != null) {
               match = match[1]
               self.DynamicProductFormDetailSpecifics = newdata.filter(function (el) {
                  return el.FormDetailId == match;
               });
            }
         }
      }


      function addIllustration() {
         self.Illustrations.push(new Components.Illustration(''));
      }
      function removeIllustration(index) {
         self.Illustrations.splice(index, 1);
      }
      function addComparableTitle() {
         self.ComparableTitles.push(new Components.ComparableTitle(''));
      }
      function removeComparableTitle(index) {
         self.ComparableTitles.splice(index, 1);
      }

   },
   ReviewModal: function () {
      var self = this;
      self.entryData = undefined;
      self.method = '';

      self.Method = '';
      self.Name = '';
      self.Publication = '';
      self.Text = '';

   },
   EndorsementModal: function () {
      var self = this;
      self.entryData = undefined;

      self.Method = '';
      self.Name = '';
      self.Affiliation = '';
      self.Text = '';

   },
   AppearanceandEventModal: function () {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      self.Name = '';
      self.Date = '';
      self.Location = '';
      self.Description = '';
   }
};