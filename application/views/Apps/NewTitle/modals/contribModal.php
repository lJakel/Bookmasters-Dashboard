<!-- Modal Start -->
<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Contributors.showDialog" class="modal fade" data-backdrop="static">

   <div class="modal-dialog modal-lg">
      <div class="modal-content" ng-form="ContribModalForm">
         <div class="modal-header">
            <button type="button" data-dismiss="modal" class="close" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Add / Edit Contributor</h4>
         </div>
         <div class="modal-body" >
            <form action="" id="contribModalID">
               <div class="row">
                  <div class="col-md-4 form-group required" data-show-errors>
                     <label for="" class="control-label">First Name</label>
                     <input type="text" class="form-control" name="FirstName" ng-required="true" ng-model="NTF.Contributors.ContributorModal.FirstName">

                  </div>
                  <div class="col-md-4 form-group">
                     <label for="" class="control-label">Middle Name</label>
                     <input type="text" class="form-control" ng-model="NTF.Contributors.ContributorModal.MiddleName">
                  </div>
                  <div class="col-md-4 form-group required">
                     <label for="" class="control-label">Last Name</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Last Name" data-placement="left" data-content="If the Contributor is an organization and not a person, list that organization's name here.">?</a>
                     <input type="text" class="form-control" ng-required="true" ng-model="NTF.Contributors.ContributorModal.LastName">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <label class="control-label" for="">Prefix</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Prefix" data-placement="top" data-content="Example: Dr., Rev., Judge">?</a>
                     <input type="text" class="form-control" ng-model="NTF.Contributors.ContributorModal.Prefix">
                  </div>
                  <div class="col-md-6 form-group">
                     <label for="" class="control-label">Suffix</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Suffix" data-placement="top" data-content="Example: III, Jr., Ph.D.">?</a>
                     <input type="text" class="form-control" ng-model="NTF.Contributors.ContributorModal.Suffix">
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group required">
                     <label for="" class="control-label">Hometown</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Hometown" data-placement="top" data-content="The town with which the contributor is most identified. Used to identify regional purchasing opportunities. Include city and state / country.">?</a>
                     <input type="text" class="form-control" ng-required="true" ng-model="NTF.Contributors.ContributorModal.Hometown">
                  </div>
                  <div class="col-md-6 form-group required">
                     <label for="" class="control-label">Role</label>
                     <select ng-required="true" class="form-control" ng-model="NTF.Contributors.ContributorModal.Role" ng-options="role.Name for role in NTF.Contributors.ContributorModal.FixedAuthorRoles track by role.Id" ></select>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-12 form-group required">
                     <label for="" class="control-label">Biography</label>
                     <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Contributor Bio" data-placement="top" data-content='Gives more information about the book&apos;s contributors. Must be written in the third person ("she" instead of "I") and give a short introduction to the contributor&apos;s life and credentials. Must be be no more than 2,000 characters (including spaces) and written in the primary language of the book.'>?</a>
                     <textarea data-summernote ng-model="NTF.Contributors.ContributorModal.Biography" ng-required="true"></textarea>
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
                                    <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Contributors.ContributorModal.addAdditionalTitle()"><span class="fa fa-fw fa-plus"></span></button>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr ng-repeat="AdditionalTitles in NTF.Contributors.ContributorModal.AdditionalTitles" ng-form="AdditionalTitleForm">
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
                                    <button class="btn btn-danger" ng-click="NTF.Contributors.ContributorModal.removeAdditionalTitle($index)"><span class="fa fa-fw fa-minus"></span></button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6 form-group">
                     <div class="checkbox checkbox-primary">
                        <input id="IsTitlePrimary" type="checkbox" ng-model="NTF.Contributors.ContributorModal.IsTitlePrimary" bsradio>
                        <label class="control-label" for="IsTitlePrimary">
                           Is Primary for Title <span class="required">*</span>
                        </label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Is Primary Contributor for Title" data-placement="top" data-content="The book's primary contributor. This name will be listed first.">?</a>
                     </div>
                  </div>
                  <div class="col-md-6 form-group">
                     <div class="checkbox checkbox-primary">
                        <input id="IsRolePrimary" type="checkbox" ng-model="NTF.Contributors.ContributorModal.IsRolePrimary" bsradio>
                        <label for="IsRolePrimary">
                           Is Primary for Role <span class="required">*</span>
                        </label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Is Primary Contributor for Role" data-placement="top" data-content="The book's primary contributor within the role. Example: Jane Smith, Bob Roberts, and Bill Williams are all illustrators for this book, but since Jane Smith is the primary illustrator, she will be listed first.">?</a>
                     </div>
                  </div>
               </div>
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" ng-disabled="!ContribModalForm.$valid" ng-click="NTF.Contributors.onContributorModalAction()">Save changes</button>
         </div>
      </div><!-- /.modal-content -->
   </div><!-- /.modal-dialog -->
</div>
<!-- Modal End -->