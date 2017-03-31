<div class="form-wrapper">
    <form id = "start_request">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    <select class="form-control input-lg" id="state" name="state" 
                        required >
                        <option></option>
                        @foreach ($states as $state)
                        <option value = "{{$state->state}}" data-id = "{{$state->id}}">{{$state->state}}</option>
                        @endforeach
                    </select>
                    <!--<input type="text" class="form-control input-lg" id="yourName" placeholder="State" name="state" >-->
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <select class="form-control" id="vicinity" name="vicinity_id">
                        <option value="all">All</option>
                        @foreach ($vicinities as $vicinity)
                        <option value = "{{$vicinity->id}}"data-state-id = "{{$vicinity->state_id}}"class="vicinities form-control input-lg">{{$vicinity->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <!--<div class="col-md-3">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" id="yourProfession" placeholder="Category">
                </div>
            </div>-->
           <!-- <div class="col-md-8">
                <div class="form-group">
                    <input type="text" class="form-control input-lg" id="browse-input" placeholder="Type City, State" name="state" >
                </div>
            </div>-->
            
            <div class="col-md-2">
                <button type="submit" 
                    class="btn btn-primary btn-lg btn-block start"
                    data-toggle="modal" data-target="#myModal"
                >
                        Start
                </button>


            </div>
        </div>
    </form>
</div>









 <!---->