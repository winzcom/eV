
<div class="w3-margin">
  <form method = "get" action="{{url('/type_search')}}">
      {{ csrf_field() }}
      <div class="input-group input-group-sm">
        <input type="text" id="search" value= "" name = "name" class="form-control" placeholder="Search for...">

        <span class="input-group-btn">
          <button class="btn btn-default" type="submit">
              <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div><!-- /input-group -->
  </form>
</div>