<div class="row" ng-controller="AnonMailerController as amc">
   <div class="col-md-12">
      <div class="panel panel-default">
         <div class="panel-body">
            <h1>AnonMailer</h1>
            <h4>Send e-mails from no-reply</h4>
            <div class="form-group">
               <input type="text" ng-model="amc.data.to" placeholder="Person's email address" class="form-control">
            </div>
            <div class="form-group">
               <input type="text" ng-model="amc.data.subject" placeholder="Subject" class="form-control">
            </div>
            <div class="form-group">
               <summernote class="form-control" name="em.Text" config="{toolbar: [['style', ['bold', 'italic', 'underline', 'clear']],['para', ['ul', 'ol']]]}" height="180" ng-model="amc.data.message"></summernote>
            </div>
            <div class="form-group">
               <button class="btn-primary btn" ng-click="amc.send()">Send</button>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript-lazy" data-append="partial" data-src="assets/js/views/Applications/Utilities/AnonMailer/AnonMailer.js?cache=<?php echo rand(1000, 9000); ?>"></script>