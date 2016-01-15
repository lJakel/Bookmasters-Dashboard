<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Marketing.showAppearanceAndEventDialog" class="modal fade"  data-backdrop="static"> 

   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="AppearanceAndEventModalForm" ng-repeat="am in [NTF.Marketing.AppearanceAndEventModal]">
         <div class="modal-header">
            <button type="button" class="close"  data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add / Edit Appearances and Events</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-4 form-group required" data-show-errors>
                  <label for="AMEventName" class="control-label">Event Name</label>
                  <input type="text" class="form-control" name="AMEventName" ng-model="am.EventName" ng-required="true">
               </div>
               <div class="col-md-4 form-group required" data-show-errors>
                  <label for="AMLocation" class="control-label">Locaiton</label>
                  <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Appearances and Event Location" data-placement="top" data-content="Include city and state. Also include a building or store name if applicable.">?</a>
                  <input type="text" class="form-control" name="AMLocation" ng-model="am.Location" ng-required="true">
               </div>
               <div class="col-md-4 form-group required" data-show-errors>
                  <label for="AMDate" class="control-label">Date</label>
                  <div class="input-group input-group-sm date">
                     <input type="text" class="form-control" name='AMDate' ng-required='true' datetimepicker-options="{format:'MM/DD/YYYY'}" datetimepicker ng-model="am.Date">
                     <span class="input-group-addon">
                        <span class="fa fa-calendar"></span>
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="AMText" class="control-label">Description</label>
                  <summernote class="form-control" name="am.Text" config="{toolbar: [['style', ['bold', 'italic', 'underline', 'clear']],['para', ['ul', 'ol']]]}" height="180" ng-model="am.Text"></summernote>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!AppearanceAndEventModalForm.$valid" ng-click="NTF.Marketing.onMarketingItemModalAction('AppearanceAndEvent')" id="save-changes">Save changes</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
