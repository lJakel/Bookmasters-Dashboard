<div style="z-index: 1050; height:100%;" modal-show modal-visible="cd.showTitleDialog" class="modal fade" data-backdrop="static"> 
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="EditTitleModal" ng-repeat="m in [cd.TitleModal]">
         <div class="modal-header" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" modal-open="cd.showTitleDialog" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add / Edit Title</h4>
         </div>
         <div class="modal-body"> 
            <div class="row">
               <div class="col-md-2 form-group" data-show-errors>
                  <label for="mID" class="control-label">ID</label>
                  <input type="text" class="form-control" disabled="" name="mID" ng-model="m.ID" >
               </div>
               <div class="col-md-3 form-group required" data-show-errors>
                  <label for="mISBN" class="control-label">ISBN</label>
                  <div class="input-group">
                     <input type="text" data-bm-validate-options="['isbn']" class="form-control" name="mISBN" ng-model="m.ISBN" ng-required="true" ng-model-options="{ updateOn: 'blur' }">
                     <span class="input-group-addon">
                        <i class="fa fa-question fa-fw"></i>
                     </span>
                  </div>
               </div>
               <div class="col-md-4 form-group required" data-show-errors>
                  <label class="control-label" for="">Description Set</label>
                  <select name="mSet" class='form-control' ng-model="m.Catalog" id="mSet" ng-required='true'
                          ng-options="set.Year + ' ' + set.Name for set in cd.DescriptionSets track by set.ID"></select>
               </div>
               <div class="col-md-2 form-group">
                  <label class="control-label" for=""> </label>
                  <div class="checkbox checkbox-primary">
                     <input id="mComplete" type="checkbox" ng-model="m.Complete">
                     <label for="mComplete"> Complete </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 form-group required" data-show-errors>
                  <label for="mTitle" class="control-label">Title</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="mTitle" ng-model="m.Title" ng-required="true">   
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" ng-click="m.ToTitleCase('Title')"><i class="fa fa-text-height fa-fw"></i></button>
                     </span>
                  </div>
               </div>
               <div class="col-md-6 form-group" data-show-errors>
                  <label for="mSubTitle" class="control-label">SubTitle</label>
                  <div class="input-group">
                     <input type="text" class="form-control" name="mSubTitle" ng-model="m.SubTitle">
                     <span class="input-group-btn">
                        <button class="btn btn-default" type="button" ng-click="m.ToTitleCase('SubTitle')"><i class="fa fa-text-height fa-fw"></i></button>
                     </span>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="mAuthors" class="control-label">Authors</label>
                  <input type="text" class="form-control" name="mAuthors" ng-model="m.Authors" ng-required="true">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="mPublisher" class="control-label">Publisher</label>
                  <input type="text" class="form-control" name="mPublisher" ng-model="m.Publisher" ng-required="true">
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="mMainDescription" class="control-label">MainDescription</label>
                  <div text-angular ng-model="m.MainDescription" name='mMainDescription'  ta-toolbar="[['bold','italics','underline','clear'],['ul','ol'],['html'],['wordcount','charcount']]" name="mMainDescription"></div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12 form-group required" data-show-errors>
                  <label for="mAuthorBios"  class="control-label">AuthorBios</label>
                  <div text-angular name='mAuthorBios' ng-model="m.AuthorBios" ta-toolbar="[['bold','italics','underline','clear'],['ul','ol'],['html'],['wordcount','charcount']]" name="mMainDescription"></div>
               </div>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!EditTitleModal.$valid" ng-click="cd.onItemModalAction('Title')">Save</button>
         </div>
      </div>
   </div>
</div>
