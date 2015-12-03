<div id="NTF" ng-controller="NewTitleForm as NTF" ng-form="NTFNGForm">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="container-fluid">
                     <div class="jumbotron" style="position: static; z-index: auto;">
                        <h1>Submit New Title <i class="fa fa-fw fa-check-circle" style="color: #5cb85c;"></i> </h1>
                        <div>
                           <h4> <strong>{{NTF.BasicInfo.Title}}</strong><strong style="display: none;">:</strong> <em>{{NTF.BasicInfo.Subtitle}}</em> <span style="color: #a8a8a8;"> - Publisher: {{NTF.BasicInfo.Publisher}}</span> </h4>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-12">
                     <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                           <a href="#" data-target="#basic" aria-controls="basic" role="tab" data-toggle="tab"
                              ng-style="!NTFNGForm.BasicInfoFormPanel.$pristine && NTFNGForm.BasicInfoFormPanel.$invalid ? {'background-color' : '#f2dede'} : {'background-color' : 'none'}">Basic Information</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#formats" aria-controls="formats" role="tab" data-toggle="tab">Formats</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#contributors" aria-controls="contributors" role="tab" data-toggle="tab">Contributors</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#text" aria-controls="text" role="tab" data-toggle="tab">Text</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#subject" aria-controls="subject" role="tab" data-toggle="tab">Subject</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#marketing" aria-controls="marketing" role="tab" data-toggle="tab">Marketing</a>
                        </li>
                        <li role="presentation">
                           <a href="#" data-target="#json" aria-controls="json" role="tab" data-toggle="tab">JsonDebug</a>
                        </li>
                     </ul>
                     <div class="tab-content">
                        <!--basic-->
                        <div role="tabpanel" class="tab-pane active" id="basic" ng-form="BasicInfoFormPanel" ng-repeat="bi in [NTF.BasicInfo]">

                           <div class="row">
                              <div class="col-md-12">
                                 <div class="form-group" data-show-errors>
                                    <label for="title" class="control-label">Title</label>
                                    <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Title" data-placement="top" data-content="The unique name for your book. The subtitle (if applicable) should be given separately.">?</a>
                                    <input type="text" name="title" class="form-control" ng-minlength="4" ng-required="true" ng-model="bi.Title">
                                 </div>
                                 <div class="form-group " data-show-errors>
                                    <label for="subtitle" class="control-label">Subtitle</label>
                                    <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Subtitle" data-placement="top" data-content="A subtitle should further explain your book's title. It should not include words that explain the format or edition. Not all books have subtitles, so if this book doesn't have one, leave this blank.">?</a>
                                    <input name="Subtitle" type="text" class="form-control" ng-model="bi.Subtitle">
                                 </div>
                                 <div class="form-group required" data-show-errors>
                                    <label for="publisher" class="control-label">Publisher</label>
                                    <input name="Publisher" type="text" class="form-control" readonly ng-model="bi.Publisher">
                                 </div>
                                 <div class="form-group required" data-show-errors>
                                    <label for="imprint" class="control-label">Imprint</label>
                                    <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Imprint" data-placement="top" data-content="The name under which this book will be distributed. An imprint is a specific brand managed by the publisher and can be the same as the publisher name.">?</a>
                                    <input name="Imprint" type="text" class="form-control" ng-required="true" ng-model="bi.Imprint">
                                 </div>
                                 <div class="form-group required" data-show-errors>
                                    <label for="" class="control-label">Content Language</label>
                                    <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Content language" data-placement="top" data-content="The primary language in which the book is written.">?</a>
                                    <input name="ContentLanguage" type="text" class="form-control" ng-required="true" ng-model="bi.ContentLanguage">
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-md-6" data-show-errors>
                                       <label for="" class="control-label">Series Name</label>
                                       <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Series" data-placement="top" data-content="An indefinite number of titles, published over an indefinite time period, and grouped together under a series title. Primarily for marketing purposes. ">?</a>
                                       <input name="SeriesName" type="text" class="form-control" ng-model="bi.Series">
                                    </div>
                                    <div class="form-group col-md-6" data-show-errors>
                                       <label for="" class="control-label">Number in Series</label>
                                       <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Number in Series" data-placement="top" data-content="The number of this particular book within the series. Numbers only.">?</a>
                                       <input name="NumberinSeries" type="text" class="form-control" ng-model="bi.NumberinSeries">
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end basic-->
                        <!--contributors-->
                        <div role="tabpanel" class="tab-pane" id="contributors" ng-form="ContributorsPanel"  ng-repeat="c in [NTF.Contributors]">
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Contributors</h3>
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>Prefix</th>
                                             <th>First Name</th>
                                             <th>Middle Name</th>
                                             <th>Last Name</th>
                                             <th>Suffix</th>
                                             <th>Hometown</th>
                                             <th>Role</th>
                                             <th class="twobtn">
                                                <button class="btn btn-primary pull-right btn-block" id="btnlol" ng-click="c.addContributor()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="contributor in c.Contributors">
                                             <td>{{contributor.Prefix}}</td>
                                             <td>{{contributor.FirstName}}</td>
                                             <td>{{contributor.MiddleName}}</td>
                                             <td>{{contributor.LastName}}</td>
                                             <td>{{contributor.Suffix}}</td>
                                             <td>{{contributor.Hometown}}</td>
                                             <td>{{contributor.Role.Name}}</td>
                                             <td class="twobtn">
                                                <button class="btn btn-primary" ng-click="c.showContributorModal(contributor, 'edit')"><span class="fa fa-fw fa-edit"></span></button>
                                                <button class="btn btn-danger" ng-click="c.removeContributor($index)"><span class="fa fa-fw fa-minus"></span></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <hr>
                              </div>
                           </div>
                        </div>
                        <!--end contributors-->
                        <!--subject-->
                        <div role="tabpanel" class="tab-pane" id="subject" ng-repeat="dm in [NTF.Demographics]">
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Add Bisacs</h3>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <table class="table table-bordered">
                                    <thead>
                                       <tr>
                                          <th style="width:20px;">#</th>
                                          <th style="width: 50%;">Category</th>
                                          <th style="width: 50%;">Code <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="BISAC Subject Code" data-placement="left" data-content='BISAC codes are used by the publishing industry to clearly identify a book&apos;s subject. The Book Industry Study Group (BISG) maintains these codes. (link) <bulleted list> - Always list your most important and specific BISAC code first. Think about who you are trying to sell to and what your book is trying to say. The more specific you are, the better chance your reader has of finding your book.  -Don&apos;t use "general" BISAC codes because they make it more difficult for people to find your book. -You cannot mix Fiction and Non Fiction codes; it&apos;s either fiction or it&apos;s not. -You cannot mix Children&apos;s (Juvenile) and General Audience codes; the book is either for Children or it&apos;s not. -The MEDICAL BIASCs are ONLY for scholarly books aimed at medical professionals. The HEALTH and BODY, MIND, SPIRIT BISACs are for the general public. - Book retailers will interpret these BISAC codes and apply them to how they organize their stores. Choose specific BISACs to help them make better decisions. - Supply at least 1 BISAC, preferably 3, and no more than 5 BISAC codes.'>?</a></th>
                                          <th class="onebtn">
                                             <button class="btn btn-primary pull-right btn-block" ng-click="dm.addBisac()"><span class="fa fa-fw fa-plus"></span></button>
                                          </th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr ng-repeat="Bisac in dm.Bisacs">
                                          <td>{{$index + 1}}</td>
                                          <td>
                                             <ol class="nya-bs-select form-control" ng-model="Bisac.BisacGroup" data-size="6" data-live-search="true" ng-change="dm.UpdateBisacCodes($index)">
                                                <li nya-bs-option="bis in dm.FixedList">
                                                   <a>
                                                      {{bis.Name}}
                                                      <span class="fa fa-check check-mark"></span>
                                                   </a>
                                                </li>
                                             </ol>
                                          </td>
                                          <td>
                                             <ol class="nya-bs-select form-control" ng-model="Bisac.Code" data-size="6" data-live-search="true" ng-change="dm.UpdateBisacCodes($index)">
                                                <li nya-bs-option="bis in Bisac.FixedList2">
                                                   <a>
                                                      {{bis.Code}} - {{bis.Text}}
                                                      <span class="fa fa-check check-mark"></span>
                                                   </a>
                                                </li>
                                             </ol>
                                          </td>
                                          <td class="onebtn">
                                             <button class="btn btn-danger btn-block" ng-click="dm.removeBisac($index)"><span class="fa fa-fw fa-minus"></span></button>
                                          </td>
                                       </tr>
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Audience</h3>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6 form-group">
                                 <label for="" class="control-label">Target Audience</label>
                                 <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Audience/Target Group" data-placement="top" data-content="Who is your target group of readers? Most books fall under the General Audience. If you've supplied Juvenile BISACs, the audience must be Children and you must provide an Age Range.">?</a>
                                 <select name="" id="" ng-model="dm.Audience" class="form-control" ng-options="at.Name for at in dm.FixedAudienceTypes track by at.Id" ng-disabled="dm.LockAudience">
                                    <option value="">Choose...</option>
                                 </select>
                                 <pre>{{dm.Audience|json}}</pre>
                              </div>
                              <div class="col-md-6 form-group">
                                 <label for="" class="control-label">Age Range From / To</label>
                                 <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Age Range " data-placement="top" data-content="If you've added Juvenile BISACs, the Audience must be Children and you must provide an Age Range. This tells book buyers, retailers, and librarians the level at which this book is written so they can make an informed purchasing decision.">?</a>
                                 <select name="" id="" class="form-control">
                                    <option value="1">Choose...</option>
                                    <option value="1">&nbsp;&nbsp;0 — &nbsp;&nbsp;2 &nbsp;&nbsp;Infant</option>
                                    <option value="1">&nbsp;&nbsp;2 — &nbsp;&nbsp;4 &nbsp;&nbsp;Toddler</option>
                                    <option value="1">&nbsp;&nbsp;4 — &nbsp;&nbsp;6 &nbsp;&nbsp;Emergent Reader</option>
                                    <option value="1">&nbsp;&nbsp;6 — &nbsp;&nbsp;8 &nbsp;&nbsp;Early Reader</option>
                                    <option value="1">&nbsp;&nbsp;8 — 10 &nbsp;&nbsp;Reader</option>
                                    <option value="1">10 — 14 &nbsp;&nbsp;Early Teen</option>
                                    <option value="1">14 — 18 &nbsp;&nbsp;Young Adult</option>
                                 </select>
                              </div>
                           </div>
                        </div>
                        <!--end subject-->
                        <!--text-->
                        <div role="tabpanel" class="tab-pane" id="text" ng-repeat="bi in [NTF.BasicInfo]">
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Descriptions</h3>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <label for="">Main Description</label>
                                 <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Main Title Description" data-placement="top" data-content="The Main Description is the primary summary of your book. It should tell the reader what your book is about and why they should read your book. This text will be shown to potential readers and book buyers, so double (and triple) check your spelling! Must be between 350 - 2,000 characters (including spaces) and written in the primary language of the book.">?</a>
                                 <textarea name="" id="" cols="30" rows="10" class="form-control" data-summernote ng-model="bi.MainDescription"></textarea>
                              </div>
                              <div class="col-md-6">
                                 <label for="">Short Description</label>
                                 <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Short Description" data-placement="top" data-content="The Short Description is a more concise summary of your book. It is generally used for sales catalogs and some promotional material. Must be no more than 800 characters (including spaces).">?</a>
                                 <textarea name="" id="" cols="30" rows="10" class="form-control" data-summernote ng-model="bi.ShortDescription"></textarea>
                              </div>
                           </div>
                        </div>
                        <!--end text-->
                        <!--formats-->
                        <div role="tabpanel" class="tab-pane" id="formats">
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Formats</h3>
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th>Binding</th>
                                             <th>ISBN13</th>
                                             <th>Pub Date</th>
                                             <th>US Price</th>
                                             <th class="twobtn">
                                                <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Formats.addFormat()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="Format in NTF.Formats.Formats">
                                             <td>
                                                {{Format.ProductType.Name}} / 
                                                {{Format.ProductForm.Name}} / 
                                                {{Format.ProductDetail.Name}} / 
                                                {{Format.ProductBinding.Name}}
                                             </td>
                                             <td>{{Format.ISBN13}}</td>
                                             <td>{{Format.PublicationDate}}</td>
                                             <td>{{Format.USPrice}}</td>
                                             <td class="twobtn">
                                                <button class="btn btn-primary" ng-click="NTF.Formats.showFormatModal(Format, 'edit')"><span class="fa fa-fw fa-edit fa-fw"></span></button>
                                                <button class="btn btn-danger" ng-click="NTF.Formats.removeFormat($index)"><span class="fa fa-fw fa-minus fa-fw"></span></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                                 <hr>
                              </div>
                           </div>
                        </div>
                        <!--end formats-->
                        <!--marketing-->
                        <div role="tabpanel" class="tab-pane" id="marketing">
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Websites</h3>
                                 <div class="table-responsove">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width:50%;">Website URL</th>
                                             <th style="width:50%;">Type</th>
                                             <th class="onebtn">
                                                <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Marketing.addWebsite()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="Website in NTF.Marketing.Websites" ng-form="WebsiteRepeat">
                                             <td>
                                                <div class="form-group" data-show-errors>
                                                   <input type="text" class="form-control" ng-required="true" name="websiteurl" ng-model="Website.URL" data-bm-validate data-bm-validate-options="['bmwebsite']" ng-model-options="{updateOn: 'default blur', debounce: {'default': 1000, 'blur': 0}}">
                                                </div>
                                             </td>
                                             <td>
                                                <select name="" id="" class="form-control">
                                                   <option value="">Choose...</option>
                                                   <option value="1">Publisher Website</option>
                                                   <option value="2">Book Website / Blog</option>
                                                   <optgroup label="Social Media">
                                                      <option value="3">Facebook</option>
                                                      <option value="4">Twitter</option>
                                                      <option value="5">YouTube</option>
                                                      <option value="6">Other</option>
                                                   </optgroup>
                                                </select>
                                             </td>
                                             <td><button class="btn btn-danger" ng-click="NTF.Marketing.remove('Websites', $index)"><span class="fa fa-fw fa-minus"></span></button></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Reviews</h3>
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width:25%">Name</th>
                                             <th style="width:25%">Publication</th>
                                             <th>Text</th>
                                             <th class="twobtn">
                                                <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Marketing.addReview()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="Review in NTF.Marketing.Reviews">
                                             <td>{{Review.Name}}</td>
                                             <td>{{Review.Publication}}</td>
                                             <td>{{Review.Text}}</td>
                                             <td>
                                                <button class="btn btn-primary" ng-click="NTF.Marketing.showReviewModal(Review, 'edit')"><span class="fa fa-fw fa-edit"></span></button>
                                                <button class="btn btn-danger" ng-click="NTF.Marketing.remove('Reviews', $index)"><span class="fa fa-fw fa-minus"></span></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <hr>
                                 <h3>Endorsements</h3>
                                 <div class="table-responsive">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width:25%">Name</th>
                                             <th style="width:25%">Affiliation</th>
                                             <th>Text</th>
                                             <th class="twobtn">
                                                <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Marketing.addEndorsement()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="Endorsement in NTF.Marketing.Endorsements">
                                             <td>{{Endorsement.Name}}</td>
                                             <td>{{Endorsement.Affiliation}}</td>
                                             <td>{{Endorsement.Text}}</td>
                                             <td>
                                                <button class="btn btn-primary" ng-click="NTF.Marketing.showEndorsementModal(Endorsement, 'edit')"><span class="fa fa-fw fa-edit"></span></button>
                                                <button class="btn btn-danger" ng-click="NTF.Marketing.remove('Endorsements', $index)"><span class="fa fa-fw fa-minus"></span></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Marketing and Publicity</h3>
                                 <div class="table-responsove">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width:50%;">Type</th>
                                             <th style="width:50%;">Description</th>
                                             <th class="onebtn">
                                                <button class="btn btn-primary pull-right btn-block" ng-click="NTF.Marketing.addMarketingandPublicity()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="MarketingandPublicity in NTF.Marketing.MarketingandPublicities">
                                             <td>
                                                <select name="" id="" class="form-control">
                                                   <option value="1">Print</option>
                                                   <option value="2">Radio</option>
                                                   <option value="3">TV</option>
                                                   <option value="4">Internet</option>
                                                   <option value="5">Assisting Marketing, Advertising, or Publicity Firm</option>
                                                   <option value="6">Other</option>
                                                </select>
                                             </td>
                                             <td><textarea name="" id="" cols="30" rows="3" class="form-control"></textarea></td>
                                             <td><button class="btn btn-danger" ng-click="NTF.Marketing.remove('MarketingandPublicities', $index)"><span class="fa fa-fw fa-minus"></span></button></td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <hr>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <h3>Appearances and Events</h3>
                                 <div class="table-responsove">
                                    <table class="table table-bordered">
                                       <thead>
                                          <tr>
                                             <th style="width:33%;">Event Name</th>
                                             <th style="width:33%;">Location </th>
                                             <th style="width:33%;">Date</th>
                                             <th class="twobtn">
                                                <button class="btn btn-primary btn-block" ng-click="NTF.Marketing.addAppearanceandEvent()"><span class="fa fa-fw fa-plus"></span></button>
                                             </th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                          <tr ng-repeat="Event in NTF.Marketing.AppearanceandEvents">
                                             <td>{{Event.Name}}</td>
                                             <td>{{Event.Location}}</td>
                                             <td>{{Event.Date}}</td>
                                             <td>
                                                <button class="btn btn-primary" ng-click="NTF.Marketing.showAppearanceandEventModal(Event, 'edit')"><span class="fa fa-fw fa-edit"></span></button>
                                                <button class="btn btn-danger" ng-click="NTF.Marketing.remove('AppearanceandEvents', $index)"><span class="fa fa-fw fa-minus"></span></button>
                                             </td>
                                          </tr>
                                       </tbody>
                                    </table>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!--end formats-->
                        <!--Json-->
                        <div role="tabpanel" class="tab-pane" id="json">
                           <div class="row">
                              <div class="col-md-12">
                                 <pre id="jsonPre"></pre>
                                 <button class="btn btn-primary btn-block" ng-click="NTF.RefreshJson()">Refresh</button>
                              </div>
                           </div>
                        </div>
                        <!--end Json-->
                     </div>
                  </div>
               </div>
               <hr>
               <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                     <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                           <button class="btn btn-block" ng-click="NTF.save()">Submit</button>
                           <button class="btn btn-primary btn-block" ng-click="NTF.LoadDraft()">Load Draft</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php
   $this->load->view('Apps/NewTitle/modals/AppearancesandEventsModal');
   $this->load->view('Apps/NewTitle/modals/contribModal');
   $this->load->view('Apps/NewTitle/modals/endorsementModal');
   $this->load->view('Apps/NewTitle/modals/formatModal');
   $this->load->view('Apps/NewTitle/modals/ReviewModal');
   ?>
</div>
<style>
   .jumbotron {
      background: url("http://www.bookmasters.com/CDN/resources/img/login/moonship.jpg") 0px 78% no-repeat;
      margin-bottom: 0px;
   }
   .jumbotron h1 {
      color: white;
   }
   .jumbotron div h4 strong {
      color: white;
   }
   .jumbotron div h4 em {
      color: white;
   }
   .jumbotron div h4 span {
      color: #f2f2f2;
   }
</style>
<link rel="stylesheet" href="http://www.bookmasters.com/CDN/js/angular-ui-datetime-picker/bootstrap-datetimepicker.min.css?cache=<?php echo rand(1000, 9000); ?>">
<link rel="stylesheet" href="http://www.bookmasters.com/CDN/js/summernote/dist/summernote.css" />
<link rel="stylesheet" href="http://www.bookmasters.com/CDN/js/nya-bootstrap-select-2.1.2/css/nya-bs-select.min.css">
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/share/components.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_factory.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/modals/modals.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_basic.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_contributors.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_formats.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_demographics.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_marketing.js?cache=<?php echo rand(1000, 9000); ?>"></script>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/apps/TitleManagement/new_title_form.js?cache=<?php echo rand(1000, 9000); ?>"></script>