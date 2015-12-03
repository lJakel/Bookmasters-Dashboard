var Demographics = function (data, FixedReferences) {

   var self = this;

   self.Model = {
      Audience: data.Audience || '',
      Bisacs: data.Bisacs || [],
      AgeRange: data.AgeFrom || '',
   };


   self.AgeRangeRequired = false;
   self.AgeRangeDisabled = true;


   self.AudienceRequired = false;
   self.AudienceDisabled = false;

   self.FixedList = [];
   self.FixedAudienceTypes = [];
   self.FixedIsoCodesPoop = [];

   self.UpdateBisacCodes = function (index) {
      FixedReferences.lookupBisac(self.Model.Bisacs[index].BisacGroup.Id).then(function (response) {
         $.each(self.Model.Bisacs, function (k, v) {
            if (v.BisacGroup.Id == 24 || v.BisacGroup.Id == 25) { //if juv
               $.each(self.FixedAudienceTypes, function (k, v) {
                  if (v.Name == "Children/juvenile") {
                     self.Model.Audience = v;
                     self.AudienceDisabled = true;
                     self.AudienceRequired = false;
                     self.AgeRangeRequired = true;
                     self.AgeRangeDisabled = false;
                  }
               });
            } else {
               self.AudienceDisabled = false;
               self.AudienceRequired = false;
               self.AgeRangeRequired = false;
               self.AgeRangeDisabled = true;

            }
         });
         self.Model.Bisacs[index].FixedList2 = response.data;
      });
   };

   self.addBisac = function () {
      self.Model.Bisacs.push(new Components.Bisac(self.FixedList || ''));
   };

   self.removeBisac = function (index) {
      self.Model.Bisacs.splice(index, 1);
   };
};