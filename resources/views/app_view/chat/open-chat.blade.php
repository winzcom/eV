<div class="modal fade" tabindex="-1" role="dialog" id="chat-vendor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
          {{ csrf_field() }}
          <div class="messages">
          
          </div>
          <div class="controls">
              <input type="text" class="form-control quo" name="" id="chat-message">
          </div>
          <input type="hidden" id="vendor_id" name="vendor_id"></input>
          <input type="hidden" id="request_id" name="request_id"></input>
     </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" id="send_chat_message">Send</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>