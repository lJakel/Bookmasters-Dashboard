<div style="z-index: 999999; height:100%;" modal-show modal-visible="NTF.Marketing.showReviewDialog" class="modal fade">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add / Edit Reviews</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="" class="control-label">Name</label>
                        <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Reviewser's Name">?</a>
                        <input type="text" class="form-control" ng-model="NTF.Marketing.ReviewModal.Name">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="" class="control-label">Publication</label>
                        <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Reviewsing Publication">?</a>
                        <input type="text" class="form-control" ng-model="NTF.Marketing.ReviewModal.Publication">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label for="" class="control-label">Reviews Description</label>
                        <a tabindex="-1" class="badge badge-light" role="button" title="Reviews - Text">?</a>
                        <textarea name="" data-summernote id="" cols="30" rows="10" class="summernote form-control" ng-model="NTF.Marketing.ReviewModal.Text"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save-changes" ng-click="NTF.Marketing.onReviewModalAction()">Save changes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
