var Drafts = function (data, Dependencies) {
   console.log(data);

   var self = this;
   self.Drafts = [];
   self.EmptyCache = function () {
      Dependencies.NewTitleDraftsFactory.EmptyCache().then(function (r) {
         self.Drafts = [];
         self.Drafts = r.Drafts;
      });
   };

   self.GetDrafts = function () {
      Dependencies.NewTitleDraftsFactory.GetDrafts().then(function (r) {
         self.Drafts = [];
         self.Drafts = r.Drafts;
      });
   };
   self.GetDrafts();
   self.SaveDraft = function () {
      Dependencies.NewTitleDraftsFactory.SaveDraft(JSON.stringify({
         "DraftId": data.Form.DraftId,
         "ProductGroupId": data.Form.ProductGroupId,
         "CreationDate": data.Form.CreationDate,
         "Content": {
            "BasicInfo": data.BasicInfo.Model,
            "Contributors": data.Contributors.Model,
            "Formats": data.Formats.Model,
            "Demographics": data.Demographics.Model,
            "Marketing": data.Marketing.Model,
         }
      })).then(function (r) {
         self.Drafts = r.Drafts;
      });

   };

};