<span class="listheader">Account Settings</span>
<ul class="">
   <li>
      <a class="submenu collapsed" data-target="#<?= $appName; ?>-signin" data-toggle="collapse" href="#">
         <span class="fa fa-lock"></span>Sign-in & Security<span class="fa fa-plus-circle plusmin"></span>
      </a>
      <ul id="<?= $appName; ?>-signin" class="collapse">
         <li><a data-ui-sref="bm.app.page({ 'app': '<?= $appName; ?>','page': 'index', child: null })">Signing in to Bookmasters</a></li>
         <li><a data-ui-sref="bm.app.page({ 'app': '<?= $appName; ?>','page': 'SigningIn', child: null })">Account Activity</a></li>
         <li><a data-ui-sref="bm.app.page({ 'app': '<?= $appName; ?>','page': 'SigningIn', child: null })">Notifications</a></li>
      </ul>
   </li>
   <li><a data-ui-sref="bm.app.page({app:'<?= $appName; ?>', page: 'index1', child: null})"><span class="fa fa-list-alt"></span>Personal Info & Privacy</a></li>
   <li><a data-ui-sref="bm.app.page({app:'<?= $appName; ?>', page: 'index1', child: null})"><span class="fa fa-list-alt"></span>Account Preferences</a></li>
</ul>