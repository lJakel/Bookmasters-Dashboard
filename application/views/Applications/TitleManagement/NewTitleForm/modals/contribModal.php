<!-- Modal Start -->
<div style="z-index: 1050; height:100%;" modal-show modal-visible="NTF.Contributors.showDialog" class="modal fade" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="ContributorsModalForm" ng-repeat="cm in [NTF.Contributors.ContributorModal]">
         <div class="modal-header" modal-open="NTF.Contributors.showDialog" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
               <span ng-if="cm.Method == 'edit'">Edit</span>
               <span ng-if="cm.Method == 'add'">Add</span>  Contributor
            </h4>
         </div>
         <div class="modal-body" >
            <form action="" id="contribModalID">
               <div class="row">
                  <div class="col-md-4 form-group required" data-show-errors>
                     <label for="" class="control-label">First Name</label>
                     <input type="text" class="form-control" name="FirstName" ng-required="true" ng-model="cm.FirstName">
                  </div>
                  <div class="col-md-4 form-group">
                     <label for="" class="control-label">Middle Name</label>
                     <input type="text" class="form-control" ng-model="cm.MiddleName">
                  </div>
                  <div class="col-md-4 form-group required">
                     <label for="" class="control-label">Last Name</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Last Name" data-placement="left" data-content="If the Contributor is an organization and not a person, list that organization's name here.">?</a>
                     <input type="text" class="form-control" ng-required="true" ng-model="cm.LastName">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <label class="control-label" for="">Prefix</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Prefix" data-placement="top" data-content="Example: Dr., Rev., Judge">?</a>
                     <input type="text" class="form-control" ng-model="cm.Prefix">
                  </div>
                  <div class="col-md-6 form-group">
                     <label for="" class="control-label">Suffix</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Suffix" data-placement="top" data-content="Example: III, Jr., Ph.D.">?</a>
                     <input type="text" class="form-control" ng-model="cm.Suffix">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group required">
                     <label for="" class="control-label">Hometown</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Hometown" data-placement="top" data-content="The town with which the contributor is most identified. Used to identify regional purchasing opportunities. Include city and state / country.">?</a>
                     <input type="text" class="form-control" ng-required="true" ng-model="cm.Hometown">
                  </div>
                  <div class="col-md-3 form-group required">
                     <label for="" class="control-label">Role</label>
                     <select ng-required="true" class="form-control" ng-model="cm.Role" ng-options="role.Name for role in cm.FixedAuthorRoles track by role.Id" ></select>
                  </div>
                  <div class="col-md-3 form-group required">
                     <label class="control-label" for="">Primary Role</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Is Primary Contributor for Title" data-placement="top" data-content="The book's primary contributor. This name will be listed first.">?</a>
                     <div class="checkbox checkbox-primary">
                        <input id="IsTitlePrimary" type="checkbox" ng-model="cm.IsTitlePrimary">
                        <label for="IsTitlePrimary"> Primary Role for Title </label>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 form-group required">
                     <label for="" class="control-label">Biography</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Bio" data-placement="top" data-content='Gives more information about the book&apos;s contributors. Must be written in the third person ("she" instead of "I") and give a short introduction to the contributor&apos;s life and credentials. Must be be no more than 2,000 characters (including spaces) and written in the primary language of the book.'>?</a>
                     <summernote class="form-control" ng-required="true" name="cm.Biography" config="{toolbar: [['style', ['bold', 'italic', 'underline', 'clear']],['para', ['ul', 'ol']]]}" height="180" ng-model="cm.Biography"></summernote>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 form-group">
                     <label for="" class="control-label">Additional Titles</label>
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th style="width: 50%;">Title <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Title" data-placement="top" data-content="Title of any other books to which the contributor has contributed.">?</a></th>
                                 <th style="width: 50%;">ISBN <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="ISBN" data-placement="top" data-content="ISBN of any other books to which the contributor has contributed.">?</a></th>
                                 <th class="onebtn">
                                    <button class="btn btn-primary pull-right btn-block"  ng-click="cm.addAdditionalTitle()"><span class="fa fa-fw fa-plus"></span></button>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr ng-repeat="AdditionalTitles in cm.AdditionalTitles" ng-form="ContributorsModalForm.AdditionalTitleForm[{{$index}}]">
                                 <td>
                                    <div class="form-group" data-show-errors>
                                       <input type="text" class="form-control" name="AdditionalTitleTitle" ng-required="true" ng-model="AdditionalTitles.Title">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group" data-show-errors>
                                       <div class="input-group">
                                          <input type="text" class="form-control" data-bm-validate data-bm-validate-options="['isbn']" ng-required="true" name="AdditionalTitleISBN" ng-model="AdditionalTitles.ISBN" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1000, 'blur': 0 } }">
                                          <span class="input-group-addon">
                                             <i class="fa fa-question fa-fw"></i>
                                          </span>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="onebtn">
                                    <button class="btn btn-danger" ng-click="cm.removeAdditionalTitle($index)"><span class="fa fa-fw fa-minus"></span></button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary" ng-disabled="!ContributorsModalForm.$valid" ng-click="NTF.Contributors.onContributorModalAction()">
              Save Contributor</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
<!-- Modal End -->