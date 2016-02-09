var Drafts = function (parent, Dependencies) {
   var self = this;
   self.Drafts = [];
   self.EmptyCache = function () {
      if (confirm('Are you sure you want to delete all your saved drafts?')) {
         Dependencies.NewTitleDraftsFactory.EmptyCache().then(function (r) {
            self.Drafts = [];
            self.Drafts = r.Drafts;
         });
      }
   };
   self.LoadDraft = function ($draft) {
      parent.LoadDraft($draft);
   };

   self.RemoveDraft = function ($index) {
      Dependencies.NewTitleDraftsFactory.RemoveDraft($index);
   };
   self.Submit = function ($index) {
      Dependencies.toasty.success({title: 'Success!', msg: 'Thank you for submitting your title data. We will email you a receipt.', theme: 'bootstrap', timeout: 8000});
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