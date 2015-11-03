<!--header start-->
   <!--logo start-->
   <div class="brand">
      <a href="#/app/dashboard/" class="logo">
         <img src="http://www.bookmasters.com/CDN/resources/brand/bm/small/flat-horiz-white.png" alt="">
      </a>
      <div class="sidebar-toggle-box" data-bm-action='toggle-left-sidebar'>
         <div class="fa fa-bars"></div>
      </div>
   </div>
   <!--logo end-->

   <div class="nav notify-row" id="top_menu">
      <!--  notification start -->
      <ul class="nav top-menu"></ul>
      <!--  notification end -->
   </div>
   <div class="top-nav clearfix">
      <!--search & user info start-->
      <ul class="nav pull-right top-menu">
         <li>
            <input type="text" class="form-control search" placeholder=" Search">
         </li>
         <!-- user login dropdown start-->
         <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
               <img alt="" src="http://10.10.11.48/Dashboard_CI_Require/assets/resources/badger.png" width="33" height="33">
               <span class="username">{{user.userinfo.firstname}} {{user.userinfo.lastname}}</span>
                  <span class="label label-{{user.role[0].color}}" style="font-size: 10.5px;">{{user.role[0].role}}</span>
               <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
               <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
               <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
               <li><a href="" ng-click="logout()"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
         </li>
         <!-- user login dropdown end -->
         <li>
            <div class="toggle-right-box">
               <div class="fa fa-bars"></div>
            </div>
         </li>
      </ul>
      <!--search & user info end-->
   </div>

<!--header end-->
