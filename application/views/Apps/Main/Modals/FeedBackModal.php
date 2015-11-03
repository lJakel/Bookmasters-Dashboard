<div style="z-index: 999999; height:100%;" id="feedbackModal"  modal-visible="" class="modal fade" ng-controller="FeedbackController as FB" >

   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Submit Feedback</h4>
         </div>
         <div class="modal-body">
            <div class="row">
               <div class="col-md-12 form-group">      

                  The following items will also be submitted
               </div>
            </div>
            <div class="row">
               <div class="col-md-4 form-group">
                  <label for="">URL</label>
                  <span style="word-wrap: break-word; ">{{FB.url}}</span>

               </div>
               <div class="col-md-4 form-group">
                  <label for="">User Agent</label>
                  <span>{{FB.useragent}}</span>
               </div>
               <div class="col-md-4 form-group">
                  <label for="">Platform</label>
                  <span>{{FB.platform}}</span>
               </div>
            </div>
            <style>
               
            </style>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="save-changes" ng-click="">Submit</button>
         </div>
      </div>
      <!-- /.modal-content -->
   </div>
   <!-- /.modal-dialog -->
</div>
