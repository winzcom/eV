<div id="myModal" class="modal request_modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-body my-space">
        <form id="myWizard" type="get" action="{{url('/quotes_request')}}" class="form-horizontal" method="post">
             {{ csrf_field() }}
             <!--<div>-->
             <!--<div class="row hide" data-step="1" data-title="This is the first step!">-->
                 <h3></h3>
                 <section>
                     <div class="control-group" id="eventtype">
                        <label class="control-label" for="inputCity">
                        Hello what type of event are you planning? <small style="color:red">*</small>
                        </label>
                            <div class="controls" id="div_event">
                                <select class="form-control input-lg select2" required name="event" id="event" placeholder="pick the type of event">
                                    
                                    @foreach($events as $event)
                                        <option>{{$event->name}}</option>
                                    @endforeach
                                    
                                </select>
                            </div>
                            <small>popular events <i>Birthday | Party | Wedding | Conferences | Concert</i></small>
                    </div>

                 </section>
                <h3>Step 1</h3>
                <section class="currentSection">
                     <div class="control-group" >
                    <label class="control-label" for="inputCity">
                         Please select a category you want from the options? <small style="color:red">*</small>
                         <span ><i class="vendor_available"></i></span>
                    </label>
                        <div class="controls">
                            <select class="form-control input-lg select2" required name="category" id="category" placeholder="select a category">
                                <option></option>
                                @foreach ($categories as $cate)
                                    @if(isset($category_id))
                                        <option value = "{{$cate->id}}" <?php 
                                            if($cate->id== $category_id)
                                                echo 'selected'
                                        ?>>
                                            {{$cate->name}}
                                        </option>
                                    @else
                                    <option value = "{{$cate->id}}">
                                            {{$cate->name}}
                                        </option>
                                    @endif
                                @endforeach
                                
                            </select>
                            <small>popular categories: <i>Cake | SmallChops | Caterers | Decoration | CupCakes</i></small>
                        </div>
                                
                </section>
               
            <!--</div>--><!-- data-step="1" -->
            <!--<div class="row hide" data-step="2" data-title="This is the first step!">-->
                <h3>Step 2</h3>
                <section>
                    <div class="control-group" id="date">
                        <label class="control-label" for="inputCity">Event Date <small style="color:red">*</small></label>
                            <div class="controls">
                                <input type="text" required name="date" id="datepicker" class="form-control input-lg"/>
                            </div>

                        <label class="control-label" for="inputCity">Start Time <small style="color:red">*</small></label>
                            <div class="controls">
                                <input type="time"id="start_time" required name="start_time" class="form-control input-lg"/>
                            </div>
                        <label class="control-label" for="inputCity">Duration in hours</label>
                            <div class="controls">
                                <input type="number" name="duration_in_hours" class="form-control input-lg"/>
                            </div>
                    </div>
                </section>
                
            <!--</div>--><!--step-2-->

            <!--<div class="row hide" data-step="3" data-title="This is the first step!">-->
                <h3>Step 3</h3>
                <section>
                    <div class="control-group" id="venue">
                        <label class="control-label" for="">Venue <small style="color:red">*</small></label>
                            <div class="controls">
                                <input id="pac-input"  required name="venue" type="text" class="form-control input-lg venue" placeholder="Enter a location"/>
                            </div>
                        <label class="control-label">Number of Guests <small style="color:red">*</small></label>
                            <div class="controls">
                                <input type="text" required class="form-control no_of_guest"  name="number_of_guests">
                                <!--<input type="number" name="numberofguests" class="form-control input-lg"/>-->

                                <!--<div class="spinedit"><i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down"></i></div>-->
                            </div>
                            <div id="delivery_option">
                                <label class="control-label">Do you want delivery</label>
                                <div class="controls">
                                    <select name="delivery_option" class="form-control">
                                        <option value="No" selected>No</option>
                                        <option value="No">Yes</option>
                                    </select>
                                </div>
                            </div>
                            
                    </div>
                    <div id="normalbudget">
                        <p>
                            <span style="text-align:center; color:green;">Price range:</span>
                            <div class="row">
                                <div class="col-sm-6">
                                    <label for="amount">Min:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            '&#8358';
                                        </span>
                                        <input type="number" class="form-control price_budget" name ="my_budget[]" id="min_amount">
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                    <label for="amount">Max:</label>
                                    <div class="input-group">
                                        <span class="input-group-btn">
                                            '&#8358';
                                        </span>
                                        <input type="number" class="form-control price_budget" name ="my_budget[]" id="max_amount">
                                    </div>
                                </div>
                            </div>
                            
                            
                        </p>
                        <div id="slider-range"></div>

                    </div>

                    <div id="publicbudget">
                        <label>How do You Want to Work With Vendors? <small style="color:red">*</small></label>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="budget" id="optionsRadios2" value="We will pay vendors"><ins class="iCheck-helper"></ins>
                                </div>
                            We will pay vendors
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="budget" id="optionsRadios2" value="free to attend and send to guests"><ins class="iCheck-helper"></ins>
                                </div>
                                Free to attend and sell to guests
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="budget" id="optionsRadios2" value="free to attend"><ins class="iCheck-helper"></ins>
                                </div>
                            Free to attend and sell to Guest
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="budget" id="optionsRadios2" value="there is a fee to attend"><ins class="iCheck-helper"></ins>
                                </div>
                            There is a fee to attend
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="budget" id="optionsRadios2" value="we are open to how it will work"><ins class="iCheck-helper"></ins>
                                </div>
                            We are open to how this will work
                            </label>
                        </div>
                    </div><!-- id publicbudget-->
                </section>
            <!--</div>--><!--step-3-->

           <!-- <div class="row hide" data-step="4" data-title="This is the first step!" >-->
                <h3>Step 4</h3>
                <section>

                    <div id="whatstage">
                        <label>What Stage <small style="color:red">*</small></label>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio"  name="what_stage" id="optionsRadios2" value="Need to book asap"><ins class="iCheck-helper"></ins>
                                </div>
                            Need to book asap
                            </label>
                        </div>
                        <div class="radio">
                            <label class="">
                                <div class="iradio_square">
                                    <input type="radio" name="what_stage" id="optionsRadios2" value="Just need Quotes"><ins class="iCheck-helper"></ins>
                                </div>
                        Just interested in quotes
                            </label>
                        </div>
                    </div><!--whatstage-->
                    <!--personal message-->
                    <div class="control-group" id="personalmessagae">
                        <label class="control-label" for="inputCity">Tell us more about your needs </label>
                            <div class="controls">
                                <textarea name="personal_message" class="form-control" id="personalmessage"  rows="5" placeholder="tell us more about the your event needs include key details e.g type of meal(fried rice, small chops, jollof rice) it a standing event, customer are going to pay" ></textarea>
                            </div>
                     </div><!--personal message end -->
                </section>
                
        <!-- </div>--> <!--step-4-->

            <!--<div class="row hide" data-step="5" data-title="This is the first step!">-->
                <!--<h3>Step 5</h3>
                <section>
                    
                </section>-->
                
            <!--</div>-->

            @if(!Auth::guard('client')->check())
            <!--<div class="row hide" data-step="6" data-title="This is the first step!" id="personal">-->
                
                <h3>Step 6</h3>
                <section>
                    <span class="message"></span>
                    <p><b>Contact details<small>(so you can be notified when vendors reply with quotes and login to see quotes)</small><small style="color:red">*</small></b></p>
                    <label class="control-label" for="inputCity">First Name</label>
                    <div class="controls">
                        <input  name="first_name" class="form-control" type="text" required/>
                    </div>

                    <label class="control-label" for="inputCity">Last Name</label>
                    <div class="controls">
                        <input name="last_name"  class="form-control" type="text" required/>
                    </div>

                    <label class="control-label" for="inputCity">Email</label>
                    <div class="controls">
                        <input name="email" id="request_email" class="form-control email" type="email" required/>
                        <span id="status"></span>
                    </div>

                    <label class="control-label" for="inputCity" id="step5password">Password</label>
                    <div class="controls">
                        <input name="password" class="form-control" type="password" id="step5password" required/>
                    </div>
                    <label class="control-label" for="inputCity" id="step5password">Phone Number</label>
                    <div class="controls">
                        <input name="phone_no" min="0" class="form-control" type="number" id="step5password" required/>
                    </div>
                </section>


        <!--<label class="control-label" for="inputCity" id="step5password">Confirm Password</label>
        <div class="controls">
            <input name="confirm_password" class="form-control" type="password" id="step5confirm_password" required/>
        </div>-->

        <!-- State and Locality-->
         <!--<input type="text" id="administrative_area_level_1" value="" name="state"/>
         <input type="text" id="locality" value="" name="vicinity"/>-->
       <!-- End of State and Locality-->
            <!--</div>--><!--step-6-->
           @endif
        </form>
        <div class="modal-footer">
            <button type="button" class="btn-xs btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal">Cancel</button>
            <!--<button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
            <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>-->
        </div>
      </div><!-- Modal Body-->
   </div><!--Modal content-->
  </div><!--modal-dialog-->
</div><!--#myModal-->
