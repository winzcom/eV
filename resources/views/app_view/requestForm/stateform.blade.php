<div class="form-wrapper">
    <form id = "start_request">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    <select class="form-control input-lg" id="state" name="state" placeholder="State"
                        required >
                        
                        <option value="" disabled>State...</option>
                        @foreach ($states as $state)
                        <option 
                            value = "{{$state->state}}" data-id = "{{$state->id}}"
                            <?php echo $state->state == $current_state ? 'selected' : ''?> 
                        >
                            {{$state->state}}
                        </option>
                        @endforeach
                    </select>
                    <!--<input type="text" class="form-control input-lg" id="yourName" placeholder="State" name="state" >-->
                </div>
            </div>
            <!-- <div class="col-md-5">
                <div class="form-group">
                    <select class="form-control input-lg" id="vicinity" name="vicinity_id" placeholder="Vicinity">
                        <option value="all">All</option>
                        @foreach ($vicinities as $vicinity)
                        <option value = "{{$vicinity->id}}"data-state-id = "{{$vicinity->state_id}}"class="vicinities form-control ">{{$vicinity->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div> -->
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
                <button type="button" 
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