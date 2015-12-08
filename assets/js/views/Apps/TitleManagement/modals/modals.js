var Modals = {
   ContributorBSModal: function (data) {
      var self = this;
      self.entryData = undefined;
      self.Method = '';

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
   FormatBSModal: function (data, $scope) {
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

      self.FixedProductTypes = [];
      self.FixedProductForms = [];
      self.FixedProductFormDetails = [];
      self.FixedProductFormDetailSpecifics = [];

      self.FixedIsoCodes = [];
      self.FixedIsoCodesPoop = [];

      self.FixedDiscountCodes = [];


      self.FixedEditionTypes = [];

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

      function GetDynamicProductForms() {
         if (typeof self.ProductType != 'undefined' || self.ProductType == '' || self.ProductType == null) {
            var SelectedProductType = self.ProductType;
            var newdata = self.FixedProductForms;
            self.DynamicProductForms = [];
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductForm = "";
            self.ProductDetail = "";
            self.ProductBinding = "";
            self.DynamicProductForms = newdata.filter(function (el) {
               return el.MediaTypeId == SelectedProductType.Id;
            });
         }
      }

      function GetDynamicProductDetails() {
         if (typeof self.ProductForm != 'undefined' || self.ProductForm == '' || self.ProductForm == null) {
            var SelectedProductForm = self.ProductForm;
            var newdata = self.FixedProductFormDetails;
            self.DynamicProductFormDetails = [];
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductDetail = "";
            self.ProductBinding = "";
            self.DynamicProductFormDetails = newdata.filter(function (el) {
               return el.FormId == SelectedProductForm.Id;
            });
         }
      }

      function GetDynamicProductFormDetailSpecifics() {
         if (typeof self.ProductDetail != 'undefined' || self.ProductDetail == '' || self.ProductDetail == null) {
            var SelectedProductFormDetail = self.ProductDetail;
            var newdata = self.FixedProductFormDetailSpecifics;
            self.DynamicProductFormDetailSpecifics = [];
            self.ProductBinding = "";
            self.DynamicProductFormDetailSpecifics = newdata.filter(function (el) {
               return el.FormDetailId == SelectedProductFormDetail.Id;
            });
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