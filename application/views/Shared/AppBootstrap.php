<div id="container" ng-controller="BMAppController as BMA">
   <header class="header fixed-top clearfix" data-ng-include="'<?php echo site_url('Shared/appNavbar'); ?>'"></header>
   <div class="sidebar sidebar-left" data-bm-navigation>
      <!--sidebar left-->
      <div data-bm-sidebar-scroll style="height: 100%;">
         <div id="innersidebar" style="position: relative;">
            <ul class="application-items">
               <li>
                  <a data-ui-sref="bm.app.page({ 'app': 'main','page': 'index', child: null })"><span class="fa fa-dashboard fa-fw"></span>Dashboard</a>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#sidebar-apps" data-toggle="collapse" href="#"><span class="fa fa-cubes fa-fw"></span>Apps<span class="fa fa-plus-circle plusmin"></span></a>
                  <ul id="sidebar-apps" class="collapse">
                     <!--Admin-->
                     <!--CSR-->
                     <!--Sales-->
                     <!--Client-->
                     <li><a data-ui-sref="bm.app.page({ 'app': 'marketingupdate','page': 'index', child: null })">Marketing Update</a></li>
                     <li><a data-ui-sref="bm.app.page({ 'app': 'newtitle','page': 'home', child: null })">Title Management</a></li>
                  </ul>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#sidebar-devapps" data-toggle="collapse" href="#"><span class="fa fa-info-circle fa-fw"></span>Developer Apps<span class="fa fa-plus-circle plusmin"></span></a>
                  <ul id="sidebar-devapps" class="collapse">
                     <li><a data-ui-sref="bm.app.page({ 'app': 'devfeedback','page': 'home', child: null })">Site Feedback <span class="label label-default" style="color:white;">4</span></a></li>
                     <li><a data-ui-sref="bm.app.page({ 'app': 'devusermanagement','page': 'home', child: null })">User Management</a></li>
                     <li><a data-ui-sref="bm.app.page({ 'app': 'devdebug','page': 'index', child: null })">Debug</a></li>
                  </ul>
               </li>
               <li><a data-ui-sref="bm.app.page({ 'app': 'utilities','page': 'home', child: null })"><span class="fa fa-wrench fa-fw"></span>Utilities</a></li>
            </ul>
            
            <div data-ui-view="appItems"></div>
            <div class="bugfeedback">
               <a href="" ng-click="BMA.Feedback.showFeedbackModal()"> <span class="fa fa-bug"></span> Report a Problem</a>
            </div>
         </div>
      </div>
      <!--sidebar left-->
   </div>

   <!--<div class="chat-sidebar" data-sn-chat-sidebar data-ng-include="'views/partials/chat.html'"></div>-->
   <div id="main-content">
      <div class="wrapper content view-animate fade-up" role="main" data-ui-view="mainContent">

      </div>
   </div>
   <?php $this->load->view('Apps/Main/Modals/FeedBackModal'); ?>
</div>