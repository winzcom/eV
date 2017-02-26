<div id="id01" class="reply_form" style="display:none;">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span  class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" id = "review_reply" 
      method ="post" 
      action="{{url('/review_reply')}}">

         {{ csrf_field() }}

        <div class="w3-section">
            <input type="text" name="reviewers_name" value="" readonly id="reviewers_name">
             <input type="hidden" name="review_id" value="" readonly id="review_id">
             </br>
          <label class="w3-label w3-validate">Content</label>
          <textarea name="reply_content" rows="6" cols="40" class="form-control" id="content" required></textarea>

          <input class="w3-btn-block w3-blue" value="Post Reply" type="submit" id="submit">
        </div>

      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button  type="button" class="w3-closebtn w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>