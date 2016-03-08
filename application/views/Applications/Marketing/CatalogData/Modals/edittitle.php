<div style="z-index: 1050; height:100%;" modal-show modal-visible="gc.showTitleDialog" class="modal fade" data-backdrop="static"> 
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="EditTitleModal" ng-repeat="m in [gc.TitleModal]">
         <div class="modal-header" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" modal-open="gc.showTitleDialog" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add / Edit Title</h4>
         </div>
         <div class="modal-body"> 
            <div class="row">
               <div class="col-md-2 form-group" data-show-errors>
                  <label for="mID" class="control-label">ID</label>
                  <input type="text" class="form-control" disabled="" name="mID" ng-model="m.ID" >
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!EditTitleModal.$valid" ng-click="gc.SaveTitle()">Save</button>
         </div>
      </div>
   </div>
</div>
