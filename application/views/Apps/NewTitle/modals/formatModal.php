<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Formats.showDialog" class="modal fade" data-backdrop="static">
   <div class="modal-dialog modal-lg">
      <div class="modal-content"  ng-form="FormatModalForm" ng-repeat="fm in [NTF.Formats.FormatModal]">
         <div class="modal-header" modal-open="NTF.Formats.showDialog" style="cursor: -moz-grab; cursor: -webkit-grab; cursor: grab;" data-draggable>
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add / Edit Format</h4>
         </div>
         <div class="modal-body">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#" data-target="#Specifications" aria-controls="Specifications" role="tab" data-toggle="tab">Specifications</a></li>
               <li role="presentation"><a href="#" data-target="#Prices" aria-controls="Prices" role="tab" data-toggle="tab">Prices</a></li>
               <li role="presentation"><a href="#" data-target="#ComparableTitles" aria-controls="ComparableTitles" role="tab" data-toggle="tab">Comparable Titles</a></li>
               <li role="presentation"><a href="#" data-target="#Illustrations" aria-controls="Illustrations" role="tab" data-toggle="tab">Illustrations</a></li>
               <li role="presentation"><a href="#" data-target="#SalesRights" aria-controls="SalesRights" role="tab" data-toggle="tab">Sales Rights</a></li>
               <li role="presentation" ng-show="fm.ProductForm == '3 - Electronic Print'"><a href="#" data-target="#RelatedProduct" aria-controls="RelatedProduct" role="tab" data-toggle="tab">Related Product</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="Specifications">
                  <div class="row">
                     <div class="col-md-3 form-group required" id="isbn13" data-show-errors>
                        <label for="ISBN13" class="control-label">ISBN13</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="ISBN" data-placement="left" data-content="The International Standard Book Number (ISBN) is a unique identifier that is required for each format of a title. Example: a print book that also has an ePUB and an ePDF would require 3 unique ISBNs.">?</a>
                        <div class="input-group">
                           <input type="text" class="form-control" data-bm-validate-options="['isbn']" ng-required="true" name="ISBN13" ng-model="fm.ISBN13" ng-model-options="{ updateOn: 'blur' }">
                           <span class="input-group-addon">
                              <i class="fa fa-question fa-fw"></i>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="ProductForm" class="control-label">Media Type</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form" data-placement="bottom" data-content="The broadest format category into which this book will fit. Print book = paper and ink, Multimedia = Audio or Video, and Digital = eBooks.">?</a>
                        <select name="ProductType"
                                class="form-control"
                                ng-required="true"
                                ng-change="fm.GetDynamicProductForms()"
                                ng-model="fm.ProductType"
                                ng-options="type.Name for type in fm.FixedProductTypes track by type.Id" >
                           <option value="">Choose...</option>
                        </select>
                     </div>
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="ProductForm" class="control-label">Product Form</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form" data-placement="bottom" data-content="The broadest format category into which this book will fit. Print book = paper and ink, Multimedia = Audio or Video, and Digital = eBooks.">?</a>
                        <select name="ProductForm"
                                class="form-control"
                                ng-required="true"
                                ng-change="fm.GetDynamicProductDetails()"
                                ng-model="fm.ProductForm"
                                ng-options="form.Name for form in fm.DynamicProductForms track by form.Id" >
                           <option value="">Choose...</option>
                        </select>
                     </div>
                     <div class="col-md-3 form-group {{(fm.DynamicProductFormDetails.length > 1) ? 'required': ''}}" data-show-errors>
                        <label for="ProductDetail" class="control-label">Product Detail</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form Detail" data-placement="bottom" data-content="The more specific format category into which this book fits. This further explains how the book was made.">?</a>
                        <select name="ProductDetail"
                                class="form-control"
                                ng-required="(fm.DynamicProductFormDetails.length > 1)"
                                name="ProductDetail"
                                ng-change="fm.GetDynamicProductFormDetailSpecifics()"
                                ng-model="fm.ProductDetail"
                                ng-options="detail.Name for detail in fm.DynamicProductFormDetails track by detail.Id" >
                           <option value="">Choose...</option>
                        </select>
                     </div>
                     <div class="col-md-3 form-group {{(fm.DynamicProductFormDetailSpecifics.length > 1) ? 'required': ''}}" data-show-errors>
                        <label for="ProductBinding" class="control-label">Product Binding</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Bind Type" data-placement="bottom" data-content="The most specific format category into which this book will fit. This even further explains how the book was made.">?</a>
                        <select name="ProductBinding"
                                class="form-control"
                                ng-required="(fm.DynamicProductFormDetailSpecifics.length > 1)"
                                name="ProductDetail"
                                ng-model="fm.ProductBinding"
                                ng-options="binding.Name for binding in fm.DynamicProductFormDetailSpecifics track by binding.Id" >
                           <option value="">Choose...</option>
                        </select>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="" class="control-label">Width</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trim Width" data-placement="top" data-content="The measurement from spine to cut edge of the book. The horizontal measure. Given in inches.">?</a>
                        <div class="input-group">
                           <input type="number" class="form-control" ng-required="true" min="0" max="99" ng-model="fm.Width" name="Width">
                           <span class="input-group-addon">in</span> </div>
                     </div>
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="" class="control-label">Height</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trim Height" data-placement="top" data-content="The measurement from top to bottom of spine. The vertical measure. Given in inches.">?</a>
                        <div class="input-group">
                           <input type="number" class="form-control" ng-required="true" min="0" max="99" ng-model="fm.Height" name="Height">
                           <span class="input-group-addon">in</span> </div>
                     </div>
                     <div class="col-md-3 form-group" data-show-errors>
                        <label for="" class="control-label">Spine</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Spine Thickness " data-placement="top" data-content="The depth of the spine of the book. Given in inches.">?</a>
                        <div class="input-group">
                           <input type="number" class="form-control" min="0" max="99" ng-model="fm.Spine" name="Spine">
                           <span class="input-group-addon">in</span> </div>
                     </div>
                     <div class="col-md-3 form-group" data-show-errors>
                        <label for="" class="control-label">Weight</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Book Weight" data-placement="top" data-content="The finished weight of the book. Give this amount in decimal pounds, to the nearest hundredth of a pound. Example: 1.25 lbs, 1.6 lbs">?</a>
                        <div class="input-group">
                           <input type="number" class="form-control" min="0" max="99" ng-model="fm.Weight" name="Weight">
                           <span class="input-group-addon">lbs</span> </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="PublicationDate" class="control-label">Publication Date</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Publication Date" data-placement="top" data-content="The date that you consider to be the official release date for the book. This must be at least 30 days AFTER the arrival of stock in Bookmasters' warehouse for print books. In addition, to be included in the buying cycles of the print book trade, this date must also be at least 180 days AFTER the day you submit this form.">?</a>

                        <input type="text" class="form-control" 
                               name='PublicationDate'
                               ng-required='true' 
                               datetimepicker-options="{format:'MM/DD/YYYY'}"
                               datetimepicker 
                               placeholder="mm/dd/yyyy" 
                               ng-model="fm.PublicationDate">

                     </div>
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="CopyrightYear" class="control-label">Copyright Year</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Copyright Date (year)" data-placement="top" data-content="The year in which the initial copyright for the material was filed.">?</a>

                        <input name='CopyrightYear' type="text" class="form-control" ng-required='true' datetimepicker-options="{viewMode:'years',format: 'YYYY',useCurrent:'year'}" datetimepicker ng-model="fm.Copyright">

                     </div>
                     <div class="col-md-3 form-group">
                        <label for="StockDueDate" class="control-label">Stock Due Date</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Warehouse/Stock Due Date" data-placement="top" data-content="This is the date when you expect stock to arrive at Bookmasters' warehouse. This date must be at least 30 days before the publication date.">?</a>

                        <input type="text" class="form-control" 
                               name='StockDueDate'
                               ng-required='true' 
                               datetimepicker-options="{format:'MM/DD/YYYY'}"
                               datetimepicker 
                               placeholder="mm/dd/yyyy" 
                               ng-model="fm.StockDueDate">

                     </div>
                     <div class="col-md-3 form-group">
                        <label for="">Trade Sales</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trade Sales" data-placement="top" data-content='Check this box if you have a distribution contract with Bookmasters to distribute/sell this book to the trade. If this box is not checked, Bookmasters will only fulfill orders for the title; Bookmasters will not distribute/sell.'>?</a>
                        <div class="checkbox checkbox-primary">
                           <input id="Trade" type="checkbox" ng-model="fm.TradeSales">
                           <label for="Trade"> To be sold to the Trade? </label>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-md-3 form-group required" data-show-errors>
                        <label for="Pages" class="control-label">Pages</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Page Count" data-placement="top" data-content="The numbered pages of a book, including frontmatter + body text + endmatter. Do not include blank pages in the count. Since eBooks include the cover image as a page, add one page accordingly.">?</a>
                        <input name="Pages" type="number" class="form-control" ng-required="true" min="0" ng-model="fm.Pages">
                     </div>
                     <div class="col-md-3 form-group" data-show-errors>
                        <label for="CartonQuantity" class="control-label">Carton Quantity</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Carton Quantity " data-placement="top" data-content="The number of books contained in a full carton. Your printer can give you this information.">?</a>
                        <input name="CartonQuantity" type="number" class="form-control" ng-required="true" min="0" ng-model="fm.CartonQuantity">
                     </div>

                     <div class="form-group col-md-3">
                        <label for="" class="control-label">Edition Number</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Edition Number" data-placement="top" data-content="Indicates that the version of content in this book differs from the previously numbered edition's content. Numbers only, no letters. If the book is a first edition, you are not required to put that here.">?</a>
                        <input type="text" class="form-control" ng-model="fm.EditionNumber">
                     </div>
                     <div class="form-group col-md-3">
                        <label for="" class="control-label">Edition Type</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Edition Type" data-placement="top" data-content="Indicates that the content of the book is closely related to another book's content but has been changed for a specific reason. It also implies the audience or market for the content of the book.">?</a>
                        <select name="" id="" class="form-control" ng-options="ed.Name for ed in fm.FixedEditionTypes track by ed.Id" ng-model="fm.EditionType"></select>
                     </div>
                  </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="Prices">
                  <div class="row">
                     <div class="col-md-4 form-group required" data-show-errors>
                        <label for="" class="control-label">US Price</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="USD Price" data-placement="top" data-content="The price of your book in U.S. Dollars. Other currencies will be determined from this USD amount, if applicable. eBook pricing must end in .99.">?</a>
                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                           <input name="USPrice" type="text" class="form-control" data-bm-validate-options="['price']" ng-required="true" ng-model="fm.USPrice">
                        </div>
                     </div>
                     <div class="col-md-4 form-group" data-show-errors>
                        <label for="DiscountCode" class="control-label">Discount Code</label>
                        <select id="" name="DiscountCode" class="form-control" ng-model="fm.DiscountCode" ng-options="dc.Name for dc in fm.FixedDiscountCodes track by dc.Id" >
                           <option value="">Choose...</option>
                        </select>
                     </div>
                     <div class="col-md-4 form-group" data-show-errors>
                        <label for="CustomsValue" class="control-label">Customs Value</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Customs Value" data-placement="top" data-content="The worth of one copy of this book, to be declared on customs forms if the book is shipped outside the US.">?</a>
                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                           <input name="CustomsValue" type="text" class="form-control" data-bm-validate-options="['price']" ng-model="fm.CustomsValue">
                        </div>
                     </div>

                  </div>
                  <div class="row" ng-show="fm.ProductForm == '3 - Electronic Print'">
                     <div class="col-md-4">
                        <label for="" class="control-label">Corresponding Print Book US Price</label>
                        <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="US Print Price " data-placement="top" data-content="The eBook market wants to know if this content is also available as a print book, and if so, at what price does it sell.">?</a>
                        <div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                           <input type="text" class="form-control" ng-model="fm.USPrice">
                        </div>
                     </div>
                  </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="ComparableTitles">
                  <div class="row">
                     <div class="col-md-12 form-group">
                        <p>A Comparable Title is one that is similar to your book in subject, format, price, and potential sales. The Comparable Title should also have been published within the past 3-5 years. This information can inform book buyers' purchasing decisions.</p>
                        <div class="table-responsive">
                           <table class="table table-bordered">
                              <thead>
                                 <tr>
                                    <th style="width: 50%;">Title <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Comparable Title - Title" data-placement="top" data-content="The title of a book that is similar to your title in both subject and potential sales.">?</a></th>
                                    <th style="width: 50%;">ISBN <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Comparable Title - ISBN" data-placement="top" data-content="The 13-digit ISBN of the Comparable title.">?</a></th>
                                    <th class="onebtn"> <button class="btn btn-primary pull-right btn-block btn-sm" ng-click="fm.addComparableTitle()"><span class="fa fa-plus"></span></button>
                                    </th>
                                 </tr>
                              </thead>
                              <tbody>

                                 <tr ng-repeat="CTitle in fm.ComparableTitles" ng-form="FormatModalForm.ComparableTitlesForm[{{$index}}]">
                                    <td>
                                       <div class="form-group" data-show-errors>
                                          <input type="text" class="form-control" name="AdditionalTitleTitle" ng-required="true" ng-model="CTitle.Title">
                                       </div>
                                    </td>
                                    <td>
                                       <div class="form-group" data-show-errors>
                                          <div class="input-group">
                                             <input type="text" class="form-control" data-bm-validate data-bm-validate-options="['isbn']" ng-required="true" name="AdditionalTitleISBN" ng-model="CTitle.ISBN" ng-model-options="{ updateOn: 'default blur', debounce: { 'default': 1000, 'blur': 0 } }">
                                             <span class="input-group-addon">
                                                <i class="fa fa-question fa-fw"></i>
                                             </span>
                                          </div>
                                       </div>
                                    </td>
                                    <td class="onebtn">
                                       <button class="btn-danger btn btn block btn-small" ng-click="fm.removeComparableTitle($index)"><span class="fa fa-fw fa-minus"></span></button>
                                    </td>
                                 </tr>
                              </tbody>
                           </table>
                           <hr>
                        </div>
                     </div>
                  </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="Illustrations">
                  <div class="row">
                     <div class="col-md-12">
                        <table class="table table-bordered">
                           <thead>
                              <tr>
                                 <th style="width:33%;">Type</th>
                                 <th style="width:33%;">Description</th>
                                 <th style="width:33%;">Number</th>
                                 <th class="onebtn"> <button class="btn btn-primary btn-block btn-sm" ng-click="fm.addIllustration()"><span class="fa fa-plus fa-fw"></span></button>
                                 </th>
                              </tr>
                           </thead>
                           <tbody>

                              <tr ng-repeat="illus in fm.Illustrations" ng-form="FormatModalForm.IllustrationsForm[{{$index}}]">
                                 <td>
                                    <div class="form-group" data-show-errors>
                                       <select ng-required="true" name="IllustrationsType" class="form-control" ng-model="illus.Type">
                                          <option value="">Choose...</option>
                                          <option value="01">Illustrations, black and white</option>
                                          <option value="02">Illustrations, color</option>
                                          <option value="03">Halftones, black and white</option>
                                          <option value="04">Halftones, color</option>
                                          <option value="05">Line drawings, black and white</option>
                                          <option value="06">Line drawings, color</option>
                                          <option value="07">Tables, black and white</option>
                                          <option value="08">Tables, color</option>
                                          <option value="14">Maps</option>
                                          <option value="18">Charts</option>
                                       </select>
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group" data-show-errors>
                                       <input type="text" ng-required="true" name="IllustrationsDescription"  class="form-control" ng-model="illus.Description">
                                    </div>
                                 </td>
                                 <td>
                                    <div class="form-group" data-show-errors>
                                       <input type="text" ng-required="true" name="IllustrationsNumber" class="form-control" ng-model="illus.Number">
                                    </div>
                                 </td>
                                 <td class="onebtn">
                                    <button class="btn-danger btn btn block btn-small" ng-click="fm.removeIllustration($index)"><span class="fa fa-minus"></span></button>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <hr>
                     </div>
                  </div>
               </div>
               <div role="tabpanel" class="tab-pane" id="SalesRights">
                  <div class="row">
                     <div class="col-md-12">
                        <div class="row">
                           <div class="col-md-12">
                              <h3>Verify Your Publishing Territories</h3>
                              <p>Select the territories for which you hold rights.</p>
                           </div>
                        </div>
                        <div class="row">
                           <div class="form-group col-md-6 required">
                              <label for="" class="control-label">Country of Origin</label>
                              <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Country of Origin" data-placement="top" data-content="The country in which the book was printed.">?</a>
                              <input name="CountryofOrigin" ng-required="true" type="text" class="form-control" ng-model="fm.CountryofOrigin">
                           </div>
                           <div class="form-group col-md-6">
                              <label for="" class="control-label">Publication Location</label>
                              <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Publication Location" data-placement="top" data-content="The country in which the publisher of the book is located.">?</a>
                              <input type="text" class="form-control" ng-model="fm.PublicationLocation">
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <bs-radio model="fm.TerritoryRights" value="world" name="TerritoryRights" label="Worldwide rights - all territories"></bs-radio>
                              <bs-radio model="fm.TerritoryRights" value="individual" name="TerritoryRights" label="Individual territories - select territories"></bs-radio>
                           </div>
                        </div>
                        <div class="row" ng-show="fm.TerritoryRights == 'individual'">
                           <div class="col-md-12 form-group">
                              <label for="" class="control-label">Search</label>
                              <input type="text" class="form-control" ng-model="fm.IsoSearch" ng-model-options="{debounce:500}" placeholder="Filter countries..." >
                           </div>
                        </div>
                        <div class="row" ng-show="fm.TerritoryRights == 'individual'">
                           <div class="col-md-12 form-group">
                              <div style="max-height:290px; min-height:43px; border:solid thin #ddd; padding:0 10px; overflow-y: scroll;">
                                 <div class="checkbox checkbox-primary" ng-repeat="iso in fm.FixedIsoCodes | filter:fm.IsoSearch">
                                    <input id="iso{{$index}}" type="checkbox" ng-model="iso.checked">
                                    <label for="iso{{$index}}">
                                       {{iso.Name}} - {{iso.Iso2}}
                                    </label>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row" ng-show="fm.TerritoryRights == 'individual'">
                           <div class="col-md-6 form-group">
                              <button class="btn btn-primary btn-block" ng-click="fm.checkAllSalesRights()">Check All</button>
                           </div>
                           <div class="col-md-6 form-group">
                              <button class="btn btn-primary btn-block" ng-click="fm.uncheckAllSalesRights()">Un-Check All</button>
                           </div>
                        </div>
                        <style>
                           td span.badge{ margin-bottom: 3px;}
                        </style>
                     </div>
                  </div>
               </div>

            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-changes" ng-disabled="!FormatModalForm.$valid" ng-click="NTF.Formats.onFormatModalAction()">Add Format</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
