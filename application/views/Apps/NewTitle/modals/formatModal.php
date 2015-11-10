<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Formats.showDialog" class="modal fade">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" ng-form="FormatModalForm">
      <div class="modal-header">
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
          <li role="presentation" ng-show="NTF.Formats.FormatModal.ProductForm == '3 - Electronic Print'"><a href="#" data-target="#RelatedProduct" aria-controls="RelatedProduct" role="tab" data-toggle="tab">Related Product</a></li>
          <li role="presentation"><a href="#" data-target="#Other" aria-controls="Other" role="tab" data-toggle="tab">Other</a></li>
        </ul>
        
        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="Specifications">
            <div class="row">
              <div class="col-md-3 form-group required" id="isbn13" data-show-errors>
                <label for="ISBN13" class="control-label">ISBN13</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="ISBN" data-placement="left" data-content="The International Standard Book Number (ISBN) is a unique identifier that is required for each format of a title. Example: a print book that also has an ePUB and an ePDF would require 3 unique ISBNs.">?</a>
                <input type="text" class="form-control" ng-required="true" name="ISBN13" ng-model="NTF.Formats.FormatModal.ISBN13">
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 form-group required" data-show-errors>
                <label for="ProductForm" class="control-label">Media Type</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form" data-placement="bottom" data-content="The broadest format category into which this book will fit. Print book = paper and ink, Multimedia = Audio or Video, and Digital = eBooks.">?</a>
                <select id="" class="form-control" ng-required="true" name="ProductType" ng-change="NTF.Formats.FormatModal.GetDynamicProductForms(true)" ng-model="NTF.Formats.FormatModal.ProductType">
                  <option value="{{type.Id}} - {{type.Name}}" ng-repeat="type in NTF.Formats.FormatModal.FixedProductTypes">{{type.Name}}</option>
                </select>
              </div>
              <div class="col-md-3 form-group required" data-show-errors>
                <label for="ProductForm" class="control-label">Product Form</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form" data-placement="bottom" data-content="The broadest format category into which this book will fit. Print book = paper and ink, Multimedia = Audio or Video, and Digital = eBooks.">?</a>
                <select id="" class="form-control" ng-required="true" name="ProductForm" ng-change="NTF.Formats.FormatModal.GetDynamicProductDetails(true)" ng-model="NTF.Formats.FormatModal.ProductForm">
                  <option value="" selected>Choose...</option>
                  <option value="{{form.Id}} - {{form.Name}}" ng-repeat="form in NTF.Formats.FormatModal.DynamicProductForms">{{form.Name}}</option>
                </select>
              </div>
              <div class="col-md-3 form-group {{(NTF.Formats.FormatModal.DynamicProductFormDetails.length > 1) ? 'required': ''}}" data-show-errors>
                <label for="ProductDetail" class="control-label">Product Detail</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Product Form Detail" data-placement="bottom" data-content="The more specific format category into which this book fits. This further explains how the book was made.">?</a>
                <select id="" class="form-control" ng-required="(NTF.Formats.FormatModal.DynamicProductFormDetails.length > 1)" name="ProductDetail" ng-change="NTF.Formats.FormatModal.GetDynamicProductFormDetailSpecifics(true)" ng-model="NTF.Formats.FormatModal.ProductDetail">
                  <option value="" selected>Choose...</option>
                  <option value="{{detail.Id}} - {{detail.Name}}" ng-repeat="detail in NTF.Formats.FormatModal.DynamicProductFormDetails">{{detail.Name}}</option>
                </select>
              </div>
              <div class="col-md-3 form-group {{(NTF.Formats.FormatModal.DynamicProductFormDetailSpecifics.length > 1) ? 'required': ''}}" data-show-errors>
                <label for="ProductBinding" class="control-label">Product Binding</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Bind Type" data-placement="bottom" data-content="The most specific format category into which this book will fit. This even further explains how the book was made.">?</a>
                <select id="" class="form-control" ng-required="(NTF.Formats.FormatModal.DynamicProductFormDetailSpecifics.length > 1)" name="ProductBinding" ng-model="NTF.Formats.FormatModal.ProductBinding">
                  <option value="" selected>Choose...</option>
                  <option value="{{binding.Id}} - {{binding.Name}}" ng-repeat="binding in NTF.Formats.FormatModal.DynamicProductFormDetailSpecifics">{{binding.Name}}</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Width</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trim Width" data-placement="top" data-content="The measurement from spine to cut edge of the book. The horizontal measure. Given in inches.">?</a>
                <div class="input-group">
                  <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Width">
                  <span class="input-group-addon">in</span> </div>
              </div>
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Height</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trim Height" data-placement="top" data-content="The measurement from top to bottom of spine. The vertical measure. Given in inches.">?</a>
                <div class="input-group">
                  <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Height">
                  <span class="input-group-addon">in</span> </div>
              </div>
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Spine</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Spine Thickness " data-placement="top" data-content="The depth of the spine of the book. Given in inches.">?</a>
                <div class="input-group">
                  <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Spine">
                  <span class="input-group-addon">in</span> </div>
              </div>
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Weight</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Book Weight" data-placement="top" data-content="The finished weight of the book. Give this amount in decimal pounds, to the nearest hundredth of a pound. Example: 1.25 lbs, 1.6 lbs">?</a>
                <div class="input-group">
                  <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Weight">
                  <span class="input-group-addon">lbs</span> </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Publication Date</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Publication Date" data-placement="top" data-content="The date that you consider to be the official release date for the book. This must be at least 30 days AFTER the arrival of stock in Bookmasters' warehouse for print books. In addition, to be included in the buying cycles of the print book trade, this date must also be at least 180 days AFTER the day you submit this form.">?</a>
                <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.PublicationDate">
              </div>
              <div class="col-md-3 form-group required">
                <label for="" class="control-label">Copyright Year</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Copyright Date (year)" data-placement="top" data-content="The year in which the initial copyright for the material was filed.">?</a>
                <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Copyright">
              </div>
              <div class="col-md-3 form-group">
                <label for="" class="control-label">Stock Due Date</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Warehouse/Stock Due Date" data-placement="top" data-content="This is the date when you expect stock to arrive at Bookmasters' warehouse. This date must be at least 30 days before the publication date.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.StockDueDate">
              </div>
              <div class="col-md-3 form-group">
                <label for="">Trade Sales</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Trade Sales" data-placement="top" data-content='Check this box if you have a distribution contract with Bookmasters to distribute/sell this book to the trade. If this box is not checked, Bookmasters will only fulfill orders for the title; Bookmasters will not distribute/sell.'>?</a>
                <div class="checkbox checkbox-primary">
                  <input id="Trade" type="checkbox" ng-model="NTF.Formats.FormatModal.TradeSales">
                  <label for="Trade"> To be sold to the Trade? </label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 required">
                <label for="" class="control-label">Pages</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Page Count" data-placement="top" data-content="The numbered pages of a book, including frontmatter + body text + endmatter. Do not include blank pages in the count. Since eBooks include the cover image as a page, add one page accordingly.">?</a>
                <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.Pages">
              </div>
              <div class="col-md-3 form-group">
                <label for="" class="control-label">Carton Quantity</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Carton Quantity " data-placement="top" data-content="The number of books contained in a full carton. Your printer can give you this information.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.CartonQuantity">
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="Prices">
            <div class="row">
              <div class="col-md-4 form-group required">
                <label for="" class="control-label">US Price</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="USD Price" data-placement="top" data-content="The price of your book in U.S. Dollars. Other currencies will be determined from this USD amount, if applicable. eBook pricing must end in .99.">?</a>
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" class="form-control" ng-required="true" ng-model="NTF.Formats.FormatModal.USPrice">
                </div>
              </div>
              <div class="col-md-4 form-group">
                <label for="" class="control-label">Discount Code</label>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.DiscountCode">
              </div>
              <div class="col-md-4 form-group">
                <label for="" class="control-label">Customs Value</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Customs Value" data-placement="top" data-content='The worth of one copy of this book, to be declared on customs forms if the book is shipped outside the US.'>?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.CustomsValue">
              </div>
            </div>
            <div class="row" ng-show="NTF.Formats.FormatModal.ProductForm == '3 - Electronic Print'">
              <div class="col-md-4">
                <label for="" class="control-label">Corresponding Print Book US Price</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="US Print Price " data-placement="top" data-content="The eBook market wants to know if this content is also available as a print book, and if so, at what price does it sell.">?</a>
                <div class="input-group"> <span class="input-group-addon"><i class="fa fa-usd"></i></span>
                  <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.USPrice">
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
                        <th>Title <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Comparable Title - Title" data-placement="top" data-content="The title of a book that is similar to your title in both subject and potential sales.">?</a></th>
                        <th>ISBN <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Comparable Title - ISBN" data-placement="top" data-content="The 13-digit ISBN of the Comparable title.">?</a></th>
                        <th class="onebtn"> <button class="btn btn-primary pull-right btn-block btn-sm" ng-click="NTF.Formats.FormatModal.addComparableTitle()"><span class="fa fa-plus"></span></button>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr ng-repeat="CTitle in NTF.Formats.FormatModal.ComparableTitles">
                        <td><input type="text" class="form-control" ng-model="CTitle.Title"></td>
                        <td><input type="text" class="form-control" ng-model="CTitle.ISBN"></td>
                        <td><button class="btn-danger btn btn block btn-small" ng-click="NTF.Formats.FormatModal.removeComparableTitle($index)"><span class="fa fa-minus"></span></button></td>
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
                      <th>Type</th>
                      <th>Description</th>
                      <th>Number</th>
                      <th class="onebtn"> <button class="btn btn-primary btn-block btn-sm" ng-click="NTF.Formats.FormatModal.addIllustration()"><span class="fa fa-plus"></span></button>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr ng-repeat="illus in NTF.Formats.FormatModal.Illustrations">
                      <td><select name="" id="" class="form-control" ng-model="illus.Type">
                          <option value=""></option>
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
                        </select></td>
                      <td><input type="text" class="form-control" ng-model="illus.Description"></td>
                      <td><input type="text" class="form-control" ng-model="illus.Number"></td>
                      <td><button class="btn-danger btn btn block btn-small" ng-click="NTF.Formats.FormatModal.removeIllustration($index)"><span class="fa fa-minus"></span></button></td>
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width:50%; text-align: center;">Country(s)</th>
                      <th style="width:50%; text-align: center;">Region(s)</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                         <select multiple="multiple" id="multi-select">
                          <option>Lorem</option>
                          <option>Unde</option>
                          <option>Saepe</option>
                          <option>Harum</option>
                          <option>Enim</option>
                          <option>Aliquid</option>
                          <option>Recusandae</option>
                          <option>Esse</option>
                          <option>Laborum</option>
                          <option>Quo</option>
                          <option>Quo</option>
                          <option>Maiores</option>
                          <option>Architecto</option>
                          <option>Sapiente</option>
                          <option>Placeat</option>
                          <option>Officiis</option>
                          <option>Obcaecati</option>
                          <option>Aliquid</option>
                          <option>Explicabo</option>
                          <option>Aliquam</option>
                          <option>Vero</option>
                          <option>Voluptates</option>
                          <option>Similique</option>
                          <option>Minima</option>
                          <option>Ipsum</option>
                          <option>Nemo</option>
                          <option>Omnis</option>
                          <option>Fuga</option>
                          <option>Iste</option>
                          <option>Possimus</option>
                        </select>
                         <select name="" multiple="multiple" id="" class="form-control">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                            <option value="">6</option>
                         </select>
                      </td>
                      <td></td>
                    </tr>
                  </tbody>
                </table>
                <style>
                           td span.badge{ margin-bottom: 3px;}
                        </style>
              </div>
            </div>
          </div>
          <div role="tabpanel" class="tab-pane" id="Other">
            <div class="row">
              <div class="form-group col-md-4">
                <label for="" class="control-label">Edition</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Edition" data-placement="top" data-content="An edition tells the reader that this book's content has been revised in some way. Example #1: The second edition includes charts that have been updated since the first edition. Example #2: The large print edition features the same content as the previous edition, but it's presented in an easier-to-read font.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.Edition">
              </div>
              <div class="form-group col-md-4">
                <label for="" class="control-label">Edition Number</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Edition Number" data-placement="top" data-content="Indicates that the version of content in this book differs from the previously numbered edition's content. Numbers only, no letters. If the book is a first edition, you are not required to put that here.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.EditionNumber">
              </div>
              <div class="form-group col-md-4">
                <label for="" class="control-label">Edition Type</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Edition Type" data-placement="top" data-content="Indicates that the content of the book is closely related to another book's content but has been changed for a specific reason. It also implies the audience or market for the content of the book.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.EditionType">
              </div>
            </div>
            <div class="row">
              <div class="form-group col-md-6 required">
                <label for="" class="control-label">Country of Origin</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Country of Origin" data-placement="top" data-content="The country in which the book was printed.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.CountryofOrigin">
              </div>
              <div class="form-group col-md-6">
                <label for="" class="control-label">Publication Location</label>
                <a tabindex="-1" class="badge badge-light" role="button" data-toggle="popover" data-trigger="focus" title="Publication Location" data-placement="top" data-content="The country in which the publisher of the book is located.">?</a>
                <input type="text" class="form-control" ng-model="NTF.Formats.FormatModal.PublicationLocation">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="save-changes" ng-disabled="!FormatModalForm.$valid" ng-click="NTF.Formats.onFormatModalAction()">Save changes</button>
      </div>
    </div>
    <!-- /.modal-content --> 
  </div>
  <!-- /.modal-dialog -->
  <link rel="stylesheet" href="http://avenger.kaijuthemes.com/assets/plugins/form-multiselect/css/multi-select.css">
  
  <script src="http://loudev.com/js/jquery.multi-select.js"></script> 
</div>
