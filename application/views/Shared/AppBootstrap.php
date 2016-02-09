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
                     <li><a data-ui-sref="bm.app.page({folder: 'Dashboard', app: 'Main', page: 'Index'})">Dashboard</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'Dashboard', app: 'Main', page: 'Index'})">Calendar</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'Dashboard', app: 'Main', page: 'Index'})">Notes</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'Dashboard', app: 'Main', page: 'Index'})">Settings</a></li>
                  </ul>
               </li>
            </ul>
            
            <span class="listheader">Applications</span>
            <ul class="application-items">
               <li>
                  <a class="submenu collapsed" data-target="#TitleManagementList" data-toggle="collapse" href="#"><span class="fa fa-globe fa-fw"></span>Title Management<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="TitleManagementList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({folder: 'TitleManagement', app:'NewTitleForm', page: 'Index'})">Title Submission Details</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'TitleManagement', app:'NewTitleForm', page: 'Submit'})">Submit New Title</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'TitleManagement', app:'NewTitleForm', page: 'SubmitExcel'})">Submit Title Spreadsheet</a></li>
                  </ul>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#MarketingUpdateList" data-toggle="collapse" href="#"><span class="fa fa-microphone fa-fw"></span>Marketing Update<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="MarketingUpdateList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({folder: 'Marketing', app:'MarketingUpdate', page: 'Index'})">View All Entries</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'Marketing', app:'MarketingUpdate', page: 'Create'})">Create Entry</a></li>
                     <li><a data-ui-sref="bm.app.page({folder: 'Marketing', app:'MarketingUpdate', page: 'Settings' })">Settings</a></li>
                  </ul>
               </li>
               <li>
                  <a class="submenu collapsed" data-target="#SalesToolsList" data-toggle="collapse" href="#"><span class="fa fa-bar-chart fa-fw"></span>Sales Tools<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="SalesToolsList" class="collapse">
                     <li><a data-ui-sref="bm.app.page({folder: 'Sales', app: 'SalesReports', page: 'Top100'})">Top100</a></li>

                  </ul>
               </li>
            </ul>
            <span ng-if="user.roles[0] == 'Developer'" class="listheader">Developer Applications</span>
            <ul class="application-items" ng-if="user.roles[0] == 'Developer'">
               <li><a data-ui-sref="bm.app.page({folder: 'Developer', 'app': 'Feedback','page': 'Index' })"><span class="fa fa-comment fa-fw"></span>Site Feedback <span class="label label-default" style="color:white;">4</span></a></li>
               <li><a data-ui-sref="bm.app.page({folder: 'Developer', 'app': 'UserManagement','page': 'Index' })"><span class="fa fa-user fa-fw"></span>User Management</a></li>
               <li><a data-ui-sref="bm.app.page({folder: 'Developer', 'app': 'Debug','page': 'Index' })"><span class="fa fa-bug fa-fw"></span>Debug</a></li>
               <li>
                  <a class="submenu collapsed" data-target="#DevUtilities" data-toggle="collapse" href=""><span class="fa fa-microphone fa-fw"></span>Utilities<span class="fa fa-angle-down plusmin"></span></a>
                  <ul id="DevUtilities" class="collapse">
                     <li><a data-ui-sref="bm.app.page({folder: 'Utilities',app:'ISBN', page: 'Information'})">ISBN Conversion</a></li>
                  </ul>
               </li>
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
   <?php $this->load->view('Dashboard/Dashboard/Main/Modals/FeedBackModal'); ?>

</div>