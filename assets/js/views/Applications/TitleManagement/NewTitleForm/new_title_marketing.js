var Marketing = function (data) {

   var self = this;

   self.Model = {
      Websites: data.Websites || [],
      MarketingAndPublicitys: data.MarketingAndPublicitys || [],
      Reviews: data.Reviews || [],
      Endorsements: data.Endorsements || [],
      AppearanceAndEvents: data.AppearanceAndEvents || [],
   }

   self.addSingleMarketingItem = addSingleMarketingItem;
   self.addMarketingItem = addMarketingItem;
   self.showMarketingItemModal = showMarketingItemModal;
   self.onMarketingItemModalAction = onMarketingItemModalAction;
   self.removeMarketingItem = removeMarketingItem;

   self.ReviewModal = new Modals.ReviewModal('');
   self.showReviewDialog = false;

   self.EndorsementModal = new Modals.EndorsementModal('');
   self.showEndorsementDialog = false;

   self.AppearanceAndEventModal = new Modals.AppearanceAndEventModal('');
   self.showAppearanceAndEventDialog = false;

   function addSingleMarketingItem(Component) {
      self.Model[Component + 's'].push(new Components[Component]());
   }

   function addMarketingItem(Component) {
      self.showMarketingItemModal(new Components[Component], Component, 'add');
   }

   function showMarketingItemModal(entryDataViewModel, Component, Method) {
      self[Component + 'Modal'].Method = Method || 'edit';
      self[Component + 'Modal'].entryData = entryDataViewModel;

      $.each(entryDataViewModel, function (k, v) {
         self[Component + 'Modal'][k] = entryDataViewModel[k] || null;
      });
      self['show' + Component + 'Dialog'] = true;
   }

   function onMarketingItemModalAction(Component) {
      $.each(self[Component + 'Modal'].entryData, function (k, v) {
         self[Component + 'Modal'].entryData[k] = self[Component + 'Modal'][k];
      });
      if (self[Component + 'Modal'].Method === 'add') {
         self.Model[Component + 's'].push(self[Component + 'Modal'].entryData);
      }
      self['show' + Component + 'Dialog'] = false;
   }

   function removeMarketingItem(Component, index) {
      self.Model[Component + 's'].splice(index, 1);
   }

};