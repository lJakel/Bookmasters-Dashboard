<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Marketing.showReviewDialog" class="modal fade">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="ReviewModalForm" ng-repeat="rm in [NTF.Marketing.ReviewModal]">
         <div class="modal-header" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" modal-open="NTF.Marketing.showReviewDialog" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
               <span ng-if="rm.Method == 'edit'">Edit</span>
               <span ng-if="rm.Method == 'add'">Add</span>  Review
            </h4>
         </div>
         <div class="modal-body"> 
            <div class="row">
               <div class="col-md-6 form-group required" data-show-errors>
                  <label for="RMName" class="control-label">Reviewer Name</label>
                  <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Reviewser's Name">?</a>
                  <input type="text" class="form-control" name="RMName" ng-model="rm.Name" ng-required="true">
               </div>
               <div class="col-md-6 form-group required" data-show-errors>
                  <label for="RMPublication" class="control-label">Publication</label>
                  <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Reviewsing Publication">?</a>
                  <input type="text" class="form-control" name="RMPublication" ng-model="rm.Publication" ng-required="true">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="RMText" class="control-label">Text</label>
                  <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Text">?</a>
                  <summernote class="form-control" name="rm.Text" config="{toolbar: [['style', ['bold', 'italic', 'underline', 'clear']],['para', ['ul', 'ol']]]}" height="180" ng-model="rm.Text"></summernote>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!ReviewModalForm.$valid" ng-click="NTF.Marketing.onMarketingItemModalAction('Review')">Add Review</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
