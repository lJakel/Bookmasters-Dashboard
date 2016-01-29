<div class="row" ng-controller="UtilitiesISBNConversion as uic">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">

            <div class="row">
               <div class="col-md-12">
                  <h3>ISBN Information</h3>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6 form-group">
                  <label for="">Input</label>
                  <textarea name="" id="" cols="30" rows="10" class="form-control" ng-model="uic.model.input"></textarea>
               </div>
               <div class="col-md-6 form-group">
                  <label for="">Output</label>
                  <textarea name="" id="" cols="30" rows="10" class="form-control" ng-model="uic.model.output"></textarea>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <button class="btn btn-primary btn-block" ng-click="uic.Convert()">Convert</button>
               </div>
            </div>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-12">
                  <table class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Original</th>
                           <th>EAN</th>
                           <th>ISBN13</th>
                           <th>ISBN10</th>
                           <th>Product</th>
                           <th>Country</th>
                           <th>Publisher</th>
                           <th>Publication</th>
                           <th>Checksum</th>                                 
                        </tr>
                     </thead>
                     <tbody>
                        <tr ng-repeat="item in uic.model.isbns" ng-class="{danger:item.fail}">
                           <td>{{item.original}}</td>
                           <td>{{item.ean}}</td>
                           <td>{{item.isbn13}}</td>
                           <td>{{item.isbn10}}</td>
                           <td>{{item.product}}</td>
                           <td>{{item.country}}</td>
                           <td>{{item.publisher}}</td>
                           <td>{{item.publication}}</td>
                           <td>{{item.checkSum}}</td>

                        </tr>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>

      </div>
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Apps/Utilities/ISBNConversion.js?cache=<?php echo rand(1000, 9000); ?>"></script>