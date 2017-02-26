<div id="id03" class="w3-modal" style="display:none;">
    <div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:600px">

      <div class="w3-center"><br>
        <span onclick="document.getElementById('id03').style.display='none'" class="w3-closebtn w3-hover-red w3-container w3-padding-8 w3-display-topright" title="Close Modal">&times;</span>
      </div>

      <form class="w3-container" id = "review_form" 
                method ="post" 
                action="{{url('/write_review')}}"
    >
         {{ csrf_field() }}

        <div class="w3-section">
            <input type="hidden" name="review_for" value="{{$userd->id}}">

            @if(session('search_url'))
            <input type="hidden" name="search_url" value="{{session('search_url')}}" id="input_with_session_var">
            @else
            <input type="hidden" name="search_url" value="{{URL::previous()}}">
            @endif

          <label class="w3-label w3-validate">Name</label>
          <input type="text"class="form-control" name="reviewers_name" required>

          <label class="w3-label w3-validate">Email</label>
          <input type="text"class="form-control" name="reviewers_email" required>

          <label class="w3-label w3-validate"><b>Rating</b></label>
          <select name="rating" class="form-control">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
          </select></br>

          <label class="w3-label w3-validate">Review</label>
          <textarea name="review" rows="5" cols="60" class="form-control" required></textarea>

          <input class=" w3-btn w3-blue" type="submit">
        </div>
      </form>

      <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
        <button  onclick="document.getElementById('id03').style.display='none'" type="button" class="w3-btn w3-red">Cancel</button>
      </div>

    </div>
  </div>