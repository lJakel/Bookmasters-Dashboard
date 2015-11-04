<div style="z-index: 999999; height:100%;" id="feedbackModal" modal-show modal-visible="BMA.Feedback.FeedbackModalVisible" class="modal fade">

   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Report a Problem</h4>
         </div>

         <div class="modal-body" ng-show="BMA.Feedback.success">
            <div class="row">
               <div class="col-md-12">
                  <h1 style="font-size: 200px; text-align: center;" class="text-success"><i class="fa fa-check"></i></h1>
                  <h2 style="text-align: center;">Thank You!</h2>
               </div>
            </div>
         </div>
         <div class="modal-body" ng-show="!BMA.Feedback.success" ng-form="FeedbackForm">
            <div class="row">
               <div class="col-md-12 form-group">      
                  The following items will also be submitted
               </div>
            </div>
            <div class="row">
               <div class="col-md-4">
                  <label for="">Username</label>
                  <p>{{BMA.Feedback.feedback.username}}</p>

               </div>
               <div class="col-md-4">
                  <label for="">Email Address</label>
                  <p>{{BMA.Feedback.feedback.email}}</p>

               </div>
               <div class="col-md-4">
                  <div class="checkbox checkbox-primary">
                     <input id="FeedbackContact" type="checkbox" ng-model="BMA.Feedback.feedback.contact" class="ng-pristine ng-untouched ng-valid">
                     <label for="FeedbackContact"> May we contact you? </label>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 form-group">
                  <label for="">URL</label>
                  <p style="word-wrap: break-word; ">{{BMA.Feedback.feedback.url}}</p>
               </div>
               <div class="col-md-4 form-group">
                  <label for="">User Agent</label>
                  <p>{{BMA.Feedback.feedback.useragent}}</p>
               </div>
               <div class="col-md-4 form-group">
                  <label for="">Platform</label>
                  <p>{{BMA.Feedback.feedback.platform}}</p>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <label for="">Description</label>
                  <textarea name="" ng-required="true" placeholder="Please describe the situation as thoroughly as possible." id="" cols="30" rows="10" class="form-control" ng-model="BMA.Feedback.feedback.message"></textarea>
               </div>
            </div>

         </div>

         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-changes" ng-disabled="!FeedbackForm.$valid" ng-click="BMA.Feedback.submitFeedback()">{{BMA.Feedback.submitBtn}}</button>
         </div>
      </div>
   </div>
</div>