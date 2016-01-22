<div class="row" ng-controller="Top100 as t">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">


            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
               <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
               <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
               <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
               <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
               <div role="tabpanel" class="tab-pane active" id="home">...</div>
               <div role="tabpanel" class="tab-pane" id="profile">...</div>
               <div role="tabpanel" class="tab-pane" id="messages">...</div>
               <div role="tabpanel" class="tab-pane" id="settings">...</div>
            </div>



         </div>
      </div>
   </div>
</div>
<script>
           BMApp.register.controller('Top100', [function () {
           var self = this;
           }]);
</script>