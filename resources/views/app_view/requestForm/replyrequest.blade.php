<div class="modal fade" tabindex="-1" role="dialog" id="reply_request">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Request Reply</h4>
      </div>
      <div class="modal-body">
        <form id="send_request_form">
            <div class="control-group" id="date">
                <label class="control-label" for="inputCity">Cost</label>
                    <div class="controls">
                        <input type="number" name="cost" class="form-control input-lg quo" id = "cost" value="" required/>
                    </div>
                  <label class="control-label" for="inputCity">Down Payment( percentage ) <span>%</spa></label>
                    <div class="controls">
                        <input type="number" min="1" max= "100" name="down_payment" class="form-control input-lg quo" id = "down_payment" value="" required>
                    </div>
                <label class="control-label" for="inputCity">Message (break-down analysis,recommendation)</label>
                    <div class="controls">
                        <textarea class="form-control quo" rows="5" id="message" name="message" required></textarea>
                    </div>
            </div>
         </form>
            <!---->
    </div>
     
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send_quote">Send Quote</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>