<div style="z-index: 1050; height:100%;" modal-show modal-visible="gc.showTitleDialog" class="modal fade" data-backdrop="static"> 
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="EditTitleModal" ng-repeat="m in [gc.EditTitleModal]">
         <div class="modal-header" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" modal-open="gc.showTitleDialog" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add / Edit Title</h4>
         </div>
         <div class="modal-body"> 
            <div class="row">
               <div class="col-md-2 form-group">
                  <label for="mID" class="control-label">ID</label>
                  <input type="text" class="form-control" disabled="" name="mID" ng-model="m.ID" >
               </div>

               <div class="col-md-5 form-group">
                  <label for="mID" class="control-label">Title</label>
                  <input type="text" class="form-control" name="m.Title" ng-model="m.Title" >
               </div>

               <div class="col-md-5 form-group">
                  <label for="mID" class="control-label">Subtitle</label>
                  <input type="text" class="form-control"  name="m.Subtitle" ng-model="m.Subtitle" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group">
                  <label for="mID" class="control-label">Author Names</label>
                  <input type="text" class="form-control" name="m.Author1Name" ng-model="m.Author1Name" >
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group">
                  <label for="mID" class="control-label">Title Description</label>
                  <summernote config='{"toolbar":[["style",["bold","italic","underline","clear"]],["para",["ul","ol"]],["view",["fullscreen","codeview"]]]}' height="180" ng-model="m.MainDesc"></summernote>

               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group">
                  <label for="mID" class="control-label">Author Bios</label>
                  <summernote name="lolcats" config='{"toolbar":[["style",["bold","italic","underline","clear"]],["para",["ul","ol"]],["view",["fullscreen","codeview"]]]}' height="180" ng-model="m.Author1Bio"></summernote>

               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!EditTitleModal.$valid" ng-click="gc.onEditTitleModalAction()">Save</button>
         </div>
      </div>
   </div>
</div>
