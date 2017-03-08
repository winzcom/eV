<div class="modal fade" tabindex="-1" role="dialog" id="reply_review">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Reply Review</h4>
      </div>
      <div class="modal-body">
        <form id="send_review_reply" action="{{url('/reply_review')}}" method="post">
            <div class="control-group" id="date">
                <label class="control-label" for="inputCity">Reviewer's Name</label>
                    <div class="controls">
                        <input type="text" name="reviewers_name"  class="form-control input-lg quo" 
                            value="" readonly id="reviewers_name" required
                        >
                        <input type="hidden" name="review_id" value="" readonly id="review_id">
                    </div>
                <label class="control-label" for="inputCity">Review</label>
                    <div class="controls">
                        <textarea class="form-control quo" rows="5" id="textarea" name="reply" required></textarea>
                    </div>
            </div>
         </form>
            <!---->
    </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="reply_review_submit">Reply</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
























