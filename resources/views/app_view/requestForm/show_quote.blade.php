<div class="modal fade" tabindex="-1" role="dialog" id="show_quote">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Request</h4>
      </div>
      <div class="modal-body">
        @include('app_view.shared.showfewrequestforclient',['request'=>$request,'cats'=>$cats])
     </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="send_quote">Send Quote</button>-->
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>