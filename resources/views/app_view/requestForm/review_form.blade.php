<div class="modal fade" tabindex="-1" role="dialog" id="write_review">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Write Review</h4>
      </div>
      <div class="modal-body">
        <form id="send_request_form" action="{{url('/write_review')}}" method="post">
          {{csrf_field()}}
            <div class="control-group" id="date">
                <label class="control-label" for="inputCity">Rating</label>
                    <div class="controls" id="rate">
                        
                    </div>
                <label class="control-label" for="inputCity">Review</label>
                    <div class="controls">
                        <textarea class="form-control quo" rows="5" id="message" name="review" required></textarea>
                         <input type="hidden" name="rating" class="form-control input-lg " id = "rating" value="" required/>
                         <input type="hidden" name="reviewers_name" class="form-control input-lg " id = "reviewers_name" value="{{$reviewers_name or ''}}" readonly/>
                         <input type="hidden" name="reviewers_email" class="form-control input-lg " id = "reviewers_name" value="{{$reviewers_email or ''}}" readonly/>
                         <input type="hidden" name="review_for" class="form-control input-lg " id = "reviewers_name" value="{{$review_for}}" readonly/>
                    </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary" id="send_quote">Post Review</button>
            </div>
         </form>
            <!---->
    </div>
     
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>