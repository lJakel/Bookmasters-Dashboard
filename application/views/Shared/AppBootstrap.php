<div id="container" ng-controller="BMAppController as BMA">
   <header class="header fixed-top clearfix" data-ng-include="'Shared/appNavbar'"></header>
   <div class="sidebar sidebar-left" data-bm-navigation>
      <!--sidebar left-->
      <div data-bm-sidebar-scroll style="height: 100%;">
         <div id="innersidebar" style="position: relative;">
            <ul class="application-items">
               <li>
                  <a class="submenu collapsed" data-target="#DashboardList" data-toggle="collapse" href="#"><span class="fa fa-globe fa-fw"></span>Dashboard<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="DashboardList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({ 'app': 'main','page': 'index', child: null })">Dashboard</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'main', page: 'submit' })">Calendar</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'main', page: 'view' })">Notes</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'main', page: 'view' })">Settings</a></li>
                  </ul>
               </li>
            </ul>
            <span class="listheader">Applications</span>
            <ul class="application-items">
               <li>
                  <a class="submenu collapsed" data-target="#TitleManagementList" data-toggle="collapse" href="#"><span class="fa fa-globe fa-fw"></span>Title Management<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="TitleManagementList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({app:'TitleManagement', page: 'index', child: null})">Title Submission Details</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'TitleManagement', page: 'submit', child: null})">Submit New Title</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'TitleManagement', page: 'submitexcel', child: null})">Submit Title Spreadsheet</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'TitleManagement', page: 'view', child: null })">View Titles</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'TitleManagement', page: 'view', child: null })">Settings</a></li>
                  </ul>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#MarketingUpdateList" data-toggle="collapse" href="#"><span class="fa fa-microphone fa-fw"></span>Marketing Update<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="MarketingUpdateList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({app:'marketingupdate', page: 'index', child: null})">View All Entries</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'marketingupdate', page: 'create', child: null})">Create Entry</a></li>
                     <li><a data-ui-sref="bm.app.page({app:'marketingupdate', page: 'settings', child: null })">Settings</a></li>
                  </ul>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#SalesToolsList" data-toggle="collapse" href="#"><span class="fa fa-bar-chart fa-fw"></span>Sales Tools<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="SalesToolsList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({app:'sales', page: 'top100', child: null})">Top100</a></li>

                  </ul>
               </li>
            </ul>
            <span ng-if="user.roles[0] == 'Developer'" class="listheader">Developer Applications</span>
            <ul class="application-items" ng-if="user.roles[0] == 'Developer'">
               <li><a data-ui-sref="bm.app.page({ 'app': 'devfeedback','page': 'home', child: null })"><span class="fa fa-comment fa-fw"></span>Site Feedback <span class="label label-default" style="color:white;">4</span></a></li>
               <li><a data-ui-sref="bm.app.page({ 'app': 'devusermanagement','page': 'home', child: null })"><span class="fa fa-user fa-fw"></span>User Management</a></li>
               <li><a data-ui-sref="bm.app.page({ 'app': 'devdebug','page': 'index', child: null })"><span class="fa fa-bug fa-fw"></span>Debug</a></li>
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