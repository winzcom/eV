
<?php 
     
     $request_categories = Request::query('category');
     $request_states = Request::query('state');
     $request_vicinities = Request::query('vicinity');
?>
<div class="w3-margin-bottom">
    <form method = "get" action = "{{url('/search')}}" class="form-inline" >
                            {{ csrf_field() }}
                            <div class="input-group">
                                <!--<label for="Category" class="cat">Categories</label>-->
                                <span class="input-group-addon">What do you need?</span>
                                <select   placeholder = "Select Categories"
                                class="form-control  cc chzn-select" id="combobox" name="category[]" selected ="{{old('category')}}"  required>
                                    <option></option>
                                        

                                            @foreach ($category as $key=>$cate)

                                            
                                                <option value = "{{$cate->id}}"

                                                        <?php 
                                                            if(!is_null($request_categories)){
                                                                    if(in_array($cate->id,$request_categories))
                                                                    echo 'selected';
                                                            }

                                                        ?>
                                                >{{$cate->name}}</option>;
                                            @endforeach
                                        
                                    </select>
                                </div>

                                <div class="input-group">
                                <!-- <label for="State" class="cat">States</label>-->
                                    <span class="input-group-addon">State</span>
                                    <select placeholder = "Select State" class="form-control cc " onchange = "changeVicinitySelect(this)"
                                    id="state" name="state"  required>

                                    <option value = "all">All</option>
                                    @foreach($states as $state)
                                        <option value= "{{$state->state}}"
                                        data-id = "{{$state->id}}"
                                            <?php 
                                            if( !is_null($request_categories))
                                                        if($state->state == $request_states)
                                                            echo 'selected';
                                                    ?>

                                        >{{$state->state}}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="input-group">
                                <!-- <label for="State" class="cat">States</label>-->
                                    <span class="input-group-addon">Vicinity</span>
                                    <select placeholder = "Select Vicinity" 
                                    class="form-control cc " id="vicinity" name="vicinity"  required>

                                        <option value = "all">All</option>
                                         @foreach($vicinities as $vicinity)
                                        <option value= "{{$vicinity->id}}"
                                        class="vicinities"
                                        data-state-id = "{{$vicinity->state_id}}"
                                            <?php 
                                                if( !is_null($request_categories))
                                                        if($vicinity->id == $request_vicinities)
                                                            echo 'selected';
                                            ?>

                                        >{{$vicinity->name}}</option>
                                    @endforeach
                                    
                                    </select>
                                </div>

                                <input type = "submit" class="btn btn-primary" value="search"/>
                            </div>
    </form>
</div>