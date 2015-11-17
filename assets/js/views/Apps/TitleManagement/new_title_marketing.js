var Marketing = function (data) {

   var vm = this;
   vm.Websites = data.Websites || [];
   vm.addWebsite = addWebsite;



   vm.MarketingandPublicities = [];
   vm.addMarketingandPublicity = addMarketingandPublicity;



   vm.Reviews = data.Reviews || [];
   vm.ReviewModal = new Modals.ReviewModal('');
   vm.showReviewDialog = false;
   vm.addReview = addReview;
   vm.showReviewModal = showReviewModal;
   vm.onReviewModalAction = onReviewModalAction;

   vm.EndorsementModal = new Modals.EndorsementModal('');
   vm.Endorsements = data.Endorsements || [];
   vm.showEndorsementDialog = false;
   vm.addEndorsement = addEndorsement;
   vm.showEndorsementModal = showEndorsementModal;
   vm.onEndorsementModalAction = onEndorsementModalAction;


   vm.AppearanceandEventModal = new Modals.AppearanceandEventModal('');
   vm.showAppearanceandEventDialog = false;
   vm.AppearanceandEvents = data.AppearanceandEvents || [];
   vm.addAppearanceandEvent = addAppearanceandEvent;
   vm.showAppearanceandEventModal = showAppearanceandEventModal;
   vm.onAppearanceandEventModalAction = onAppearanceandEventModalAction;

   vm.remove = removeMarketingItem;


   function addReview() {
      vm.showReviewModal(new Components.Review, 'add');
   }
   function showReviewModal(entryDataViewModel, method) {
      vm.ReviewModal.Method = method || 'edit';
      vm.ReviewModal.entryData = entryDataViewModel;
      vm.ReviewModal.Name = entryDataViewModel.Name || null;
      vm.ReviewModal.Publication = entryDataViewModel.Publication || null;
      vm.ReviewModal.Text = entryDataViewModel.Text || null;
      vm.showReviewDialog = true;
   }

   function onReviewModalAction() {

      vm.ReviewModal.entryData.Name = vm.ReviewModal.Name;
      vm.ReviewModal.entryData.Publication = vm.ReviewModal.Publication;
      vm.ReviewModal.entryData.Text = vm.ReviewModal.Text;
      if (vm.ReviewModal.Method === 'add') {
         vm.Reviews.push(vm.ReviewModal.entryData);
      }
      vm.showReviewDialog = false;
   }




   function addAppearanceandEvent() {

      vm.showAppearanceandEventModal(new Components.AppearanceAndEvent, 'add');
   }
   function showAppearanceandEventModal(entryDataViewModel, method) {
      vm.AppearanceandEventModal.Method = method || 'edit';
      vm.AppearanceandEventModal.entryData = entryDataViewModel;
      vm.AppearanceandEventModal.Name = entryDataViewModel.Name || null;
      vm.AppearanceandEventModal.Date = entryDataViewModel.Date || null;
      vm.AppearanceandEventModal.Location = entryDataViewModel.Location || null;
      vm.AppearanceandEventModal.Description = entryDataViewModel.Description || null;
      vm.showAppearanceandEventDialog = true;
   }

   function onAppearanceandEventModalAction() {

      vm.AppearanceandEventModal.entryData.Name = vm.AppearanceandEventModal.Name;
      vm.AppearanceandEventModal.entryData.Date = vm.AppearanceandEventModal.Date;
      vm.AppearanceandEventModal.entryData.Location = vm.AppearanceandEventModal.Location;
      vm.AppearanceandEventModal.entryData.Description = vm.AppearanceandEventModal.Description;

      if (vm.AppearanceandEventModal.Method === 'add') {
         vm.AppearanceandEvents.push(vm.AppearanceandEventModal.entryData);
      }
      vm.showAppearanceandEventDialog = false;
   }





   function addMarketingandPublicity() {
      vm.MarketingandPublicities.push(new Components.MarketingandPublicity());
   }


   function addWebsite() {
      console.log('lol')
      vm.Websites.push(new Components.Website());
   }




   function addEndorsement() {
      vm.showEndorsementModal(new Components.Endorsement(), 'add');
   }
   function showEndorsementModal(entryDataViewModel, method) {

      vm.EndorsementModal.Method = method || 'edit';
      vm.EndorsementModal.entryData = entryDataViewModel;
      vm.EndorsementModal.Name = entryDataViewModel.Name || null;
      vm.EndorsementModal.Affiliation = entryDataViewModel.Affiliation || null;
      vm.EndorsementModal.Text = entryDataViewModel.Text || null;
      vm.showEndorsementDialog = true;
   }
   function onEndorsementModalAction() {

      vm.EndorsementModal.entryData.Name = vm.EndorsementModal.Name;
      vm.EndorsementModal.entryData.Affiliation = vm.EndorsementModal.Affiliation;
      vm.EndorsementModal.entryData.Text = vm.EndorsementModal.Text;
      if (vm.EndorsementModal.Method === 'add') {
         vm.Endorsements.push(vm.EndorsementModal.entryData);
      }
      vm.showEndorsementDialog = false;
   }



   function removeMarketingItem(item, index) {
      vm[item].splice(index, 1);
   }
};