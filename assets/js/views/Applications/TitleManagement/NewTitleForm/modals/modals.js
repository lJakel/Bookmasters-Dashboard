var Modals = {
   ContributorBSModal: function (data, Dependencies, References) {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      Dependencies.$timeout(function () {
         Dependencies.$scope.$watch(Dependencies.$scope.NTFNGForm.ContributorsModalForm.AdditionalTitleForm, function (newVal, oldVal) {
            console.log(newVal, oldVal);
         });
      });


      self.FirstName = '';
      self.MiddleName = '';
      self.LastName = '';
      self.Prefix = '';
      self.Suffix = '';
      self.Hometown = '';
      self.Role = '';
      self.Biography = '';

      self.FixedAuthorRoles = References.FixedAuthorRoles;

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
   FormatBSModal: function (data, $scope, References) {
      var self = this;
      self.entryData = undefined;

      self.Method = '';
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

      self.TerritoryRights = data.TerritoryRights || "world";

      self.ComparableTitles = data.ComparableTitles || [];
      self.Illustrations = data.Illustrations || [];

      self.FixedProductTypesNew = [];
      self.FixedProductTypes = References.FixedProductTypes;
      self.FixedProductForms = [];
      self.FixedProductFormDetails = [];
      self.FixedProductFormDetailSpecifics = [];

      self.FixedIsoCodes = References.FixedISOCountryCodes;
      self.FixedDiscountCodes = References.FixedDiscountCodes


      self.FixedEditionTypes = [];

      self.DynamicProductTypes = [];
      self.DynamicProductForms = [];
      self.DynamicProductFormDetails = [];
      self.DynamicProductFormDetailSpecifics = [];
      self.GetDynamicProductForms = GetDynamicProductForms;
      self.GetDynamicProductDetails = GetDynamicProductDetails;

      self.addIllustration = addIllustration;
      self.removeIllustration = removeIllustration;
      self.addComparableTitle = addComparableTitle;
      self.removeComparableTitle = removeComparableTitle;
      self.uncheckAllSalesRights = uncheckAllSalesRights;
      self.checkAllSalesRights = checkAllSalesRights;




      self.openCalendar = function (e) {
         e.preventDefault();
         e.stopPropagation();

         self.CalendarIsOpen = true;
      };

      self.CalendarIsOpen = false;

      function uncheckAllSalesRights() {
         $.each(self.FixedIsoCodes, function (k, v) {
            v.checked = false;
         });
      }

      function checkAllSalesRights() {
         $.each(self.FixedIsoCodes, function (k, v) {
            v.checked = true;
         });
      }

      self.GetMediaTypes = function () {
         var ar = [];
         $.each(self.FixedProductTypes, function (k, item) {
            var elementpos = ar.map(function (x) {
               return x.MediaType;
            }).indexOf(item.MediaType);

            if (elementpos < 0) {
               item.MediaType !== null && ar.push({MediaType: item.MediaType});
            }
         });
         self.FixedProductTypesNew = ar;
      };


      function GetDynamicProductForms() {
         var array = self.FixedProductTypes.filter(function (item) {
            return self.ProductType && item.MediaType == self.ProductType.MediaType;
         });
         var newArray = [];

         $.each(array, function (k, item) { //for each product type
            var elementpos = newArray.map(function (x) {
               return x.Form;
            }).indexOf(item.Form);
            if (elementpos < 0) {
               item.Form !== null && newArray.push({Form: item.Form});
            }
         });
         self.DynamicProductForms = newArray;
      }

      function GetDynamicProductDetails() {

         var array = self.FixedProductTypes.filter(function (item) {
            return self.ProductForm && item.Form == self.ProductForm.Form;
         });
         var newArray = [];

         $.each(array, function (k, item) { //for each product type
            var elementpos = newArray.map(function (x) {
               return x.Form;
            }).indexOf(item.Detail);
            if (elementpos < 0) {
               item.Detail !== null && newArray.push({Detail: item.Detail});
            }
         });
         self.DynamicProductFormDetails = newArray;
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
      self.Method = '';

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
   AppearanceAndEventModal: function () {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

      self.Name = '';
      self.Date = '';
      self.Location = '';
      self.Text = '';
   }
};