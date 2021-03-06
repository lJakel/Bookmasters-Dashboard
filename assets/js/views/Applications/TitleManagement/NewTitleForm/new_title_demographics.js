var Demographics = function (data, Dependencies, References) {

   var self = this;
   self.ValidSubject = false;

   self.ValidWatch = [
      'NTFNGForm.DemographicsFormPanel.$valid',
      'NTFNGForm.DemographicsFormPanel.AddBisacs.$valid',
      'NTFNGForm.DemographicsFormPanel.AddBisacs.AddBisacsRepeat.$valid',
      function () {
         return(self.Model.Bisacs.length > 0);
      },
   ];


   Dependencies.$scope.$watchGroup(self.ValidWatch, function (newValues) {
      if (newValues.indexOf(false) == -1) {
         self.ValidSubject = true;
      } else {
         self.ValidSubject = false;
      }
   });

   self.Model = {
      Audience: data.Audience || '',
      Bisacs: data.Bisacs || [],
      AgeRange: data.AgeFrom || '',
   };
   self.FixedBisacListContainer = [];

   self.AgeRangeRequired = false;
   self.AgeRangeDisabled = true;

   self.AudienceRequired = false;
   self.AudienceDisabled = false;

   self.FixedList = References.FixedBisacGroups;
   self.FixedAudienceTypes = References.FixedAudienceTypes;
   self.FixedAgeRanges = References.FixedAgeRanges;

   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Audience;
   }, function (newVal, oldVal) {
      switch (newVal.Name) {
         case "Children/juvenile":
            self.AgeRangeRequired = true;
            self.AgeRangeDisabled = false;
            break;
         case "Young adult":
            self.AgeRangeRequired = true;
            self.AgeRangeDisabled = false;
            break;
         default :
            self.AgeRangeRequired = false;
            self.AgeRangeDisabled = true;
            break;
      }
      self.DynamicAgeRanges = self.FixedAgeRanges.filter(function (item) {
         return self.Model.Audience && item.AudienceTypeId == self.Model.Audience.Id;
      });

   });
   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Bisacs;
   }, function (newVal, oldVal) {

      if (self.Model.Bisacs.length == 0) {
         self.CheckJuv();
      }

      $.each(self.Model.Bisacs, function (k, v) {
         Dependencies.$scope.$watchCollection(function () {
            return v;
         }, function (newVal, oldVal) {
            self.CheckJuv();
         });
      });
   });



   self.UpdateBisacCodes = function (index) {
      Dependencies.$timeout(function () {
         Dependencies.FixedReferences.lookupBisac(self.Model.Bisacs[index].BisacGroup.Id, function (response) {
            self.FixedBisacListContainer[index] = response.data;
         }, function (response) {
            alert();
         });
      });
   };

   //init values
   $.each(self.Model.Bisacs, function (k, v) {
      self.UpdateBisacCodes(k);
   });
   self.addBisac = function () {
      self.Model.Bisacs.push(new Components.Bisac(self.FixedList || ''));
   };

   self.removeBisac = function (index) {
      self.Model.Bisacs.splice(index, 1);
   };
   self.CheckJuv = function () {
      var found = false;
      $.each(self.Model.Bisacs, function (k, v) {
         if (v.BisacGroup.Prefix == "JUV" || v.BisacGroup.Prefix == "JNF") {
            found = true;
         }
      });

      if (found) {
         $.each(self.FixedAudienceTypes, function (k, v) {
            if (v.Name == "Children/juvenile") {
               self.Model.Audience = v;
            }
         });
         self.AudienceDisabled = true;
         self.AudienceRequired = false;
         self.AgeRangeRequired = true;
         self.AgeRangeDisabled = false;
      } else {
         self.AudienceDisabled = false;
         self.AudienceRequired = true;
         self.AgeRangeRequired = false;
         self.AgeRangeDisabled = true;
      }
   }
};