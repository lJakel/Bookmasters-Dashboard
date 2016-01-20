<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Marketing.showEndorsementDialog" class="modal fade"  data-backdrop="static"> 
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="EndorsementModalForm" ng-repeat="em in [NTF.Marketing.EndorsementModal]">
         <div class="modal-header" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add / Edit Endorsement</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-6 form-group required" data-show-errors>
                  <label for="EMName" class="control-label">Name of Endorser</label>
                  <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Endorser's Name and Affiliation" data-placement="top" data-content='The name and credentials of the person who gave the Endorsement. '>?</a>
                  <input type="text" class="form-control" name="EMName" ng-model="em.Name" ng-required="true">
               </div>
               <div class="col-md-6 form-group required" data-show-errors>
                  <label for="EMAffiliation" class="control-label">Affiliation</label>
                  <input type="text" class="form-control" name="EMAffiliation" ng-model="em.Affiliation" ng-required="true">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="EMText" class="control-label">Endorsement Description</label>
                  <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Endorsement Description" data-placement="right" data-content='An Endorsement is usually from a celebrity or expert in the field of the content of the book. They are endorsing the contributor or book, but not reviewing the book. Example: "This book is great!" - George Washington, First President of the United States of America. (To clarify, please do not submit fake Endorsements like this example! Only submit real endorsements that were given to you with permission to use.)'>?</a>
                  <summernote class="form-control" name="em.Text" config="{toolbar: [['style', ['bold', 'italic', 'underline', 'clear']],['para', ['ul', 'ol']]]}" height="180" ng-model="em.Text"></summernote>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-changes" ng-disabled="!EndorsementModalForm.$valid" ng-click="NTF.Marketing.onMarketingItemModalAction('Endorsement')">Add Endorsement</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>