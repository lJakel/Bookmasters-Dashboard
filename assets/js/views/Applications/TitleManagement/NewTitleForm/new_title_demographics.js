var Demographics = function (data, Dependencies, References) {
   console.log(References);
   var self = this;

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



   Dependencies.$scope.$watchCollection(function () {
      return self.Model.Audience;
   }, function (newVal, oldVal) {
      if (newVal.Name == "Children/juvenile") {
         self.AgeRangeRequired = true;
         self.AgeRangeDisabled = false;

      } else {
         self.AgeRangeRequired = false;
         self.AgeRangeDisabled = true;


      }

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