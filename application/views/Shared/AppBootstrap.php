<div id="container">
   <header class="header fixed-top clearfix" data-ng-include="'<?php echo site_url('Shared/appNavbar'); ?>'"></header>
   <div class="sidebar sidebar-left" data-bm-navigation>
      <!--sidebar left-->
      <div id="innersidebar" data-bm-sidebar-scroll style="position: relative;">

         <h5 style="color:#A2A2A2;margin: 15px 0 5px 11px;font-size: 14px;opacity: 1;-webkit-transition: opacity 0.3s ease-in-out;-o-transition: opacity 0.3s ease-in-out;transition: opacity 0.3s ease-in-out;">Main</h5>
         <ul class="">
            <li><a data-ui-sref="bm.app.page({ 'app': 'main','page': 'index', child: null })"><span class="fa fa-dashboard"></span>Dashboard</a></li>
         </ul>
         <ul>
            <li>
               <a class="submenu collapsed" data-target="#sidebar-apps" data-toggle="collapse" href="#"><span class="fa fa-cubes"></span>Apps<span class="fa fa-plus-circle plusmin"></span></a>
               <ul id="sidebar-apps" class="collapse">
                  <!--Admin-->
                  <!--CSR-->
                  <!--Sales-->
                  <!--Client-->

                  <li ng-if="user.role[0].role == 'csr'"><a data-ui-sref="bm.app.page({ 'app': 'marketingupdate','page': 'index', child: null })">Marketing Update</a></li>
                  <li><a data-ui-sref="bm.app.page({ 'app': 'newtitle','page': 'home', child: null })">Title Management</a></li>
               </ul>
            </li>
         </ul>
         <div data-ui-view="appItems"></div>
         <div class="bugfeedback">
            <a href="" data-toggle="modal" data-target="#feedbackModal"> <span class="fa fa-bug"></span> Report A Problem</a>
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