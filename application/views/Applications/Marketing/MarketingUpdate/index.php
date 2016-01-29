<div id="MU" ng-controller="MarketingUpdateCtrl as mu">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-2">
                     {{mu.entries}}
                     <div ng-repeat="e in mu.entries">
                        <h4>{{e.distributor}}</h4>
                        <div ng-repeat="y in e.years">
                           <h5>{{y.year}}</h5>
                           <ul class="list-group">
                              <li class="list-group-item" ng-repeat="m in y.months">{{m.name}}</li>
                           </ul>
                        </div>
                     </div>


                  </div>
                  <div class="col-md-10">
                     <h4>Entries</h4>
                     <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                           <thead>
                              <tr>
                                 <th><span class="fa fa-star"></span></th>
                                 <th>Title</th>
                                 <th>ISBN</th>
                                 <th>Publisher</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <tr ng-repeat="e in mu.entries">
                                 <td><span ng-if="e.important == '1'" class="fa fa-star"></span></td>
                                 <td>{{e.title}}</td>
                                 <td>{{e.isbn}}</td>
                                 <td>{{e.publisher}}</td>
                                 <td>
                                    <a href="http://bookmasters.com/MU/entry/edit/319" class="btn btn-sm btn-primary EditEntry"><span class="fa fa-edit"></span></a>
                                    <a href="http://bookmasters.com/MU/entry/remove/319" class="btn btn-sm btn-danger DeleteEntry"><span class="fa fa-times"></span></a>
                                 </td>
                              </tr>

                           </tbody>
                        </table>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <?php
//   $this->load->view('Apps/NewTitle/modals/AppearancesandEventsModal');
      ?>
   </div>
</div>
<style>


   th:nth-child(1){
      width: 30px;
   }
   th:nth-child(5){
      width: 90px;
      min-width: 90px;
      max-width: 90px;
   }
   td:nth-child(2){
      white-space: nowrap;
   }

   td{
      vertical-align: middle !important;
   }
   .table-responsive{
      overflow: auto;
   }
   table tbody tr:hover{
      cursor: pointer;
   }
   .file{
      cursor: pointer;
      display:block;
      width:120px;
      float:left;margin-right: 10px;
      border:solid thin rgba(0,0,0,0.2);
      border-radius: 10px;
      margin-bottom: 10px;
      padding:10px;

   }


   .file span.fa{
      display:block;
      margin:0 auto;
      font-size:50px;
      width:45px;
      margin-bottom: 10px;
   }
   .file span.filetext{
      text-align: center;
      display:block;
      margin:0 auto;
      word-wrap: break-word;
   }
</style>

<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Apps/MarketingUpdate/muform.js?cache=<?php echo rand(1000, 9000); ?>"></script>