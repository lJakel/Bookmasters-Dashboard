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
            
            
            
            
            <?php
            $Applications = [

                [
                    'name' => 'Applications',
                    'role' => '',
                    'applications' => [
                        [
                            'name' => 'Title Management',
                            'icon' => 'fa-globe',
                            'href' => NULL,
                            'extra' => NULL,
                            'applications' => [
                                [
                                    'name' => 'Title Submission Details',
                                    'extra' => NULL,
                                    'href' => [
                                        'folder' => 'TitleManagement',
                                        'app' => 'NewTitleForm',
                                        'page' => 'Index',
                                    ]
                                ],
                                [
                                    'name' => 'Submit New Title',
                                    'extra' => NULL,
                                    'href' => [
                                        'folder' => 'TitleManagement',
                                        'app' => 'NewTitleForm',
                                        'page' => 'Submit',
                                    ]
                                ],
                                [
                                    'name' => 'Submit Title Spreadsheet',
                                    'extra' => NULL,
                                    'href' => [
                                        'folder' => 'TitleManagement',
                                        'app' => 'NewTitleForm',
                                        'page' => 'SubmitExcel',
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
                [
                    'name' => 'Developer Applications',
                    'role' => 'Developer',
                    'applications' => [
                        [
                            'name' => 'Site Feedback',
                            'icon' => 'fa-comment',
                            'href' => [
                                'folder' => 'Developer',
                                'app' => 'Feedback',
                                'page' => 'Index',
                            ],
                            'extra' => '<span class="label label-default" style="color:white;">4</span>',
                            'applications' => NULL
                        ],
                        [
                            'name' => 'User Management',
                            'icon' => 'fa-user',
                            'extra' => NULL,
                            'href' => [
                                'folder' => 'Developer',
                                'app' => 'Feedback',
                                'page' => 'Index',
                            ],
                            'applications' => NULL
                        ],
                        [
                            'name' => 'Debug',
                            'icon' => 'fa-bug',
                            'extra' => NULL,
                            'href' => [
                                'folder' => 'Developer',
                                'app' => 'Debug',
                                'page' => 'Index',
                            ],
                            'applications' => NULL
                        ],
                        [
                            'name' => 'Utilities',
                            'icon' => 'fa-microphone',
                            'href' => NULL,
                            'applications' => [
                                [
                                    'name' => 'ISBN Utility',
                                    'extra' => NULL,
                                    'href' => [
                                        'folder' => 'Utilities',
                                        'app' => 'ISBN',
                                        'page' => 'Information',
                                    ]
                                ],
                            ]
                        ],
                    ]
                ],
            ];
            ?>

            <?php foreach ($Applications as $ApplicationList) { ?>     
               <span class="listheader"><?= $ApplicationList['name'] ?></span>
               <ul class="application-items">
                  <?php foreach ($ApplicationList['applications'] as $Application) { ?>
                     <li>
                        <?php if ($Application['href']) { ?>
                           <a data-ui-sref="bm.app.page({folder: '<?= $Application['href']['folder'] ?>', 'app': '<?= $Application['href']['app'] ?>','page': '<?= $Application['href']['page'] ?>' })"><span class="fa fa-fw <?= $Application['icon'] ?>"></span><?= $Application['name'] ?> <?= $Application['extra'] ?></a>
                        <?php } else { ?>
                           <a class="submenu collapsed" data-target="#<?= str_replace(' ', '', $Application['name']) ?>List" data-toggle="collapse" href="#"><span class="fa fa-fw <?= $Application['icon'] ?>"></span><?= $Application['name'] ?><span class="fa fa-angle-down plusmin"></span></a>
                           <ul id="<?= str_replace(' ', '', $Application['name']) ?>List" class="collapse">
                              <?php foreach ($Application['applications'] as $SubApplication) { ?>

                                 <li><a data-ui-sref="bm.app.page({folder: '<?= $SubApplication['href']['folder'] ?>', app:'<?= $SubApplication['href']['app'] ?>', page: '<?= $SubApplication['href']['page'] ?>'})"><?= $SubApplication['name'] ?></a></li>
                              <?php } ?>

                           </ul>
                        <?php } ?>
                     </li>
                  <?php } ?>
               </ul>
            <?php } ?>
            
            
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