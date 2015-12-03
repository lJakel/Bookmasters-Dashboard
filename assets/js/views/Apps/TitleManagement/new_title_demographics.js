var Demographics = function (data, FixedReferences) {

   var self = this;
   //juv and jnf forces (children audience, makes age range required)  young adult, age range required
   self.AgeFrom = data.AgeFrom || '';
   self.AgeTo = data.AgeTo || '';
   self.GradeFrom = data.GradeFrom || '';
   self.GradeTo = data.GradeTo || '';
   self.Bisacs = data.Bisacs || [];

   self.Audience = data.Audience || '';
   self.LockAudience = false;

   self.FixedList = [];
   self.FixedAudienceTypes = [];
   self.FixedIsoCodesPoop = [];

   self.UpdateBisacCodes = function (index) {
      FixedReferences.lookupBisac(self.Bisacs[index].BisacGroup.Id).then(function (response) {
         $.each(self.Bisacs, function (k, v) {
            if (v.BisacGroup.Id == 24 || v.BisacGroup.Id == 25) {
               $.each(self.FixedAudienceTypes, function (k, v) {
                  if (v.Name == "Children/juvenile") {
                     self.Audience = v;
                     self.LockAudience = true;
                  }
               });
            } else {
               self.LockAudience = false;
            }
         });
         self.Bisacs[index].FixedList2 = response.data;
      });
   };

   self.addBisac = function () {
      self.Bisacs.push(new Components.Bisac(self.FixedList || ''));
   };

   self.removeBisac = function (index) {
      self.Bisacs.splice(index, 1);
   };
};