<div class="modal fade" tabindex="-1" role="dialog" id="contact_vendor">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Contact Vendor</h4>
      </div>
      <div class="modal-body">
        <h4>Message To Vendor</h4>
       <label class="control-label" for="inputCity">Message To Vendor</label>
        <div class="controls">
            <textarea class="form-control quo" rows="5" id="message_to_vendor" name="message_to_vendor" required></textarea>
        </div>
        <input type="hidden" id="vendor_id" name="vendor_id"></input>
     </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" id="send_vendor_message">Send Message</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>