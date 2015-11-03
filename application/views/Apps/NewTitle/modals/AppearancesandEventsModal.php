<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Marketing.showAppearanceandEventDialog" class="modal fade"  data-backdrop="static"> 

   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add / Edit Appearances and Events</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-4 form-group">
                  <label for="" class="control-label">Event Name</label>
                  <input type="text" class="form-control" ng-model="NTF.Marketing.AppearanceandEventModal.Name">
               </div>
               <div class="col-md-4 form-group">
                  <label for="" class="control-label">Location <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Appearances and Event Location" data-placement="top" data-content="Include city and state. Also include a building or store name if applicable.">?</a></label>
                  <input type="text" class="form-control" ng-model="NTF.Marketing.AppearanceandEventModal.Location">
               </div>

               <div class="col-md-4 form-group">
                  <label for="" class="control-label">Date</label>
                  <input type="text" class="form-control" ng-model="NTF.Marketing.AppearanceandEventModal.Date">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label for="" class="control-label">Description</label>
                  <textarea name="" id="" cols="30" data-summernote rows="10" class="form-control" ng-click="NTF.Marketing.AppearanceandEventModal.Text"></textarea>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            <button type="button" class="btn btn-primary" ng-click="NTF.Marketing.onAppearanceandEventModalAction()" id="save-changes">Save changes</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
