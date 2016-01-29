var Drafts = function (parent, Dependencies) {
   console.log(parent);

   var self = this;
   self.Drafts = [];
   self.EmptyCache = function () {
      Dependencies.NewTitleDraftsFactory.EmptyCache().then(function (r) {
         self.Drafts = [];
         self.Drafts = r.Drafts;
      });
   };
   self.LoadDraft = function ($draft) {
      parent.LoadDraft($draft);
   }

   self.RemoveDraft = function ($index) {
      Dependencies.NewTitleDraftsFactory.RemoveDraft($index);
   };
   self.GetDrafts = function () {
      Dependencies.NewTitleDraftsFactory.GetDrafts().then(function (r) {
         self.Drafts = [];
         self.Drafts = r.Drafts;
      });
   };

   self.FormatDate = function (date, format) {
      return moment(date, "X").format("dddd, MMMM Do YYYY, h:mm:ss a");
   };
   self.GetDrafts();
   self.SaveDraft = function () {
      Dependencies.NewTitleDraftsFactory.SaveDraft(JSON.stringify({
         "DraftId": parent.Form.DraftId,
         "ProductGroupId": parent.Form.ProductGroupId,
         "CreationDate": parent.Form.CreationDate,
         "Content": {
            "BasicInfo": parent.BasicInfo.Model,
            "Contributors": parent.Contributors.Model,
            "Formats": parent.Formats.Model,
            "Demographics": parent.Demographics.Model,
            "Marketing": parent.Marketing.Model,
         }
      })).then(function (r) {
         self.Drafts = r.Drafts;
      });
   };
};