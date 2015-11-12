<div class="row" ng-controller="DevUserManagementViewCtrl as d">
   <div class="col-md-12">
      <ul class="nav nav-tabs" id="authmodal" role="tablist">
         <li class="active"><a href="" role="tab" data-target="#ProfileOverview" data-toggle="tab">Profile Overview</a></li>
         <li><a href="" role="tab" data-target="#AccountSettings" data-toggle="tab">Account Settings</a></li>
      </ul>
      <div class="panel panel-default">
         <div class="panel-body">
            <div class="tab-content">
               <div class="tab-pane active fade in" id="ProfileOverview">
                  <div class="row">
                     <div class="col-md-2">
                        <img src="http://www.bookmasters.com/CDN/resources/img/badger.png" width="100%" alt="" class="thumbnail">
                     </div>
                     <div class="col-md-7">
                        <h1 style="line-height: 50px;    font-family: 'Open Sans',sans-serif;    font-size: 45px;    font-weight: 300;">Jake Ihasz</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Distinctio, voluptatem, repellat vitae reprehenderit earum beatae voluptatum 
                           nobis numquam veniam iure non nemo in perspiciatis. Ullam, tempore id suscipit ea quidem? Lorem ipsum dolor sit amet, consectetur adipisicing
                           elit. Dolore, architecto, sit, sint, suscipit natus nulla sapiente optio reprehenderit dicta assumenda laudantium quaerat
                           earum amet repudiandae voluptatum quis minus nisi placeat. Lorem ipsum dolor sit amet, consectetur adipisicing elit. At, sint, qui delectus dignissimos quisquam vero optio recusandae praesentium eum dolorem neque nam unde quam impedit reprehenderit ducimus eius natus est.</p>
                        <a href="#">www.bookmasters.com/JakeAi</a>
                        <p style="font-size:25px;">
                           <i class="fa fa-facebook"></i>
                           <i class="fa fa-twitter"></i>
                           <i class="fa fa-linkedin"></i>
                        </p>
                     </div>
                     <div class="col-md-3">
                        <ul class="list-group">
                           <li class="list-group-item">
                              <span class="badge">14</span>
                              Cras justo odio
                           </li>
                           <li class="list-group-item">
                              <span class="badge">2</span>
                              Dapibus ac facilisis in
                           </li>
                           <li class="list-group-item">
                              <span class="badge">1</span>
                              Morbi leo risus
                           </li>
                           <li class="list-group-item">
                              <span class="badge">1</span>
                              Morbi leo risus
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
               
               <div class="tab-pane fade in" id="AccountSettings">
                  <label for=""></label>
                  <input type="text" ng-model="d.child" class="form-control">
               </div>
               
            </div>
         </div>
      </div>  
   </div>
</div>
<script>
   BMApp.register.controller('DevUserManagementViewCtrl', function ($state, $http, $stateParams) {
      if ($stateParams.child) {
      }

      var self = this;
      self.child = $stateParams.child;
   });
</script>
<style>
   .tab-pane{
      border: none !important;
      border-top: none !important;
      padding: 0px !important;
   }
   .nav.nav-tabs{
      border-bottom: none !important;
   }
   .panel{
      border-top-left-radius: 0px !important;
   }

</style>