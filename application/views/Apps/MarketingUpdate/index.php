<div id="MU" ng-controller="MarketingUpdateCtrl as mu">
   <div class="row">
      <div class="col-md-12">
         <div class="panel panel-default">
            <div class="panel-body">
               <div class="row">
                  <div class="col-md-3">
                     <h4>AtlasBooks</h4>
                     <div class="panel-group" id="accordionAtlas">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionAtlas" style="display: block;cursor: pointer;" data-target="#collapseAtlas">2015</a>
                              </h4>
                           </div>
                           <div class="panel-collapse collapse in" id="collapseAtlas">
                              <div class="list-group">
                                 <a href="#" class="list-group-item"><span class="badge">1</span> First Item</a>
                                 <a href="#" class="list-group-item"><span class="badge">12</span> Second Item</a>
                              </div>
                           </div>
                        </div>
                     </div>
                     <h4>Bookmasters</h4>

                     <div class="panel-group" id="accordionBM">
                        <div class="panel panel-default">
                           <div class="panel-heading">
                              <h4 class="panel-title">
                                 <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionBM" style="display: block;cursor: pointer;" data-target="#collapseBM">2015</a>
                              </h4>
                           </div>
                           <div class="panel-collapse collapse in" id="collapseBM">
                              <div class="list-group">
                                 <a href="" class="list-group-item">January</a>
                                 <a href="" class="list-group-item">February</a>
                                 <a href="" class="list-group-item">3</a>
                                 <a href="" class="list-group-item">4</a>
                                 <a href="" class="list-group-item">5</a>
                                 <a href="" class="list-group-item">6</a>
                                 <a href="" class="list-group-item">7</a>
                                 <a href="" class="list-group-item">8</a>
                                 <a href="" class="list-group-item">9</a>
                                 <a href="" class="list-group-item">10</a>
                                 <a href="" class="list-group-item">11</a>
                                 <a href="" class="list-group-item">12</a>
                              </div>
                           </div>
                        </div>
                     </div>

                  </div>
                  <div class="col-md-9">
                     <h4>Entries</h4>
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
                           <tr>
                              <td><span class="fa fa-star"></span></td>
                              <td>Soldiers and Suffragettes: The Photography of Christina Broom</td>
                              <td>978-1-78130-038-1</td>
                              <td>I.B.Tauris</td>
                              <td>
                                 <a href="http://bookmasters.com/MU/entry/edit/319" class="btn btn-sm btn-primary EditEntry"><span class="fa fa-edit"></span></a>
                                 <a href="http://bookmasters.com/MU/entry/remove/319" class="btn btn-sm btn-danger DeleteEntry"><span class="fa fa-times"></span></a>
                              </td>
                           </tr>
                           <tr>
                              <td><span class="fa fa-star"></span></td>
                              <td>Soldiers and Suffragettes: The Photography of Christina Broom</td>
                              <td>978-1-78130-038-1</td>
                              <td>I.B.Tauris</td>
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

<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/marketingupdate/muform.js?cache=<?php echo rand(1000,9000);?>"></script>