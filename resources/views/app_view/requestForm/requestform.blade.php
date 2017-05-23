<div id="myModal" class="modal request_modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-body my-space">
        <form id="myWizard" type="get" action="{{url('/quotes_request')}}" class="form-horizontal" method="post">
             {{ csrf_field() }}
             <div class="row hide" data-step="1" data-title="This is the first step!">
                <div class="control-group" >
                    <label class="control-label" for="inputCity">
                         What are you looking for?
                         <span ><i class="vendor_available"></i></span>
                    </label>
                        <div class="controls">
                            <select class="form-control input-lg " name="category" id="category" placeholder="select a category">
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
                        </div>
                </div>
            </div><!-- data-step="2" -->
            <div class="row hide" data-step="2" data-title="This is the first step!">
                <div class="control-group" id="eventtype">
                    <label class="control-label" for="inputCity">What type of Event?</label>
                        <div class="controls" id="div_event">
                            <select class="form-control input-lg" name="event" id="event" placeholder="pick the type of event">
                                
                                @foreach($events as $event)
                                    <option>{{$event->name}}</option>
                                @endforeach
                                
                            </select>
                        </div>
                </div>

                <div class="control-group" id="date">
                    <label class="control-label" for="inputCity">Event Date</label>
                        <div class="controls">
                            <input type="text" name="date" id="datepicker" class="form-control input-lg"/>
                        </div>

                    <label class="control-label" for="inputCity">Estimated Time</label>
                        <div class="controls">
                            <input type="time" name="estimatedtime" class="form-control input-lg"/>
                        </div>
                    <label class="control-label" for="inputCity">Duration in hours</label>
                        <div class="controls">
                            <input type="number" name="duration" class="form-control input-lg"/>
                        </div>
                </div>
            </div><!--step-2-->

            <div class="row hide" data-step="3" data-title="This is the first step!">
                <div class="control-group" id="venue">
                    <label class="control-label" for="">Venue (leave blank if you don't have a confirmed venue yet')</label>
                        <div class="controls">
                            <input id="pac-input" name="venue" type="text" class="form-control input-lg" placeholder="Enter a location"/>
                        </div>
                    <label class="control-label">Number of Guests</label>
                        <div class="controls">
                            <input type="text" class="form-control spin spinedit noSelect" id="spinMd" name="numberofguests">
                            <!--<input type="number" name="numberofguests" class="form-control input-lg"/>-->

                            <!--<div class="spinedit"><i class="fa fa-chevron-up"></i><i class="fa fa-chevron-down"></i></div>-->
                        </div>
                </div>
            </div><!--step-3-->

            <div class="row hide" data-step="4" data-title="This is the first step!" >
                <div id="normalbudget">
                    <label>What sort of service are you looking for?</label>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="budget" id="optionsRadios2" value="I want a Premium Service"><ins class="iCheck-helper"></ins>
                            </div>
                        I want a Premium Service
                        </label>
                    </div>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="budget" id="optionsRadios2" value="Budget and Service are Important."><ins class="iCheck-helper"></ins>
                            </div>
                            Budget and Service are Important.
                        </label>
                    </div>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="budget" id="optionsRadios2" value=" Budget is My Concern"><ins class="iCheck-helper"></ins>
                            </div>
                        Budget is My Concern
                        </label>
                    </div>
                </div>

                <!--<div id="delivery_service">
                    <label>How do you want to get it</label>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="delivery_service" id="optionsRadios2" value="I would Want it Delivered"><ins class="iCheck-helper"></ins>
                            </div>
                        Delivery
                        </label>
                    </div>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="delivery_service" id="optionsRadios2" value="I would Come to Collect When Ready"><ins class="iCheck-helper"></ins>
                            </div>
                            Collecting
                        </label>
                    </div>
                </div>-->

                <div id="publicbudget">
                    <label>How do You Want to Work With Vendors?</label>
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

                <div id="whatstage">
                    <label>What Stage </label>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="whatstage" id="optionsRadios2" value="Need to book asap"><ins class="iCheck-helper"></ins>
                            </div>
                        Need to book asap
                        </label>
                    </div>
                    <div class="radio">
                        <label class="">
                            <div class="iradio_square">
                                <input type="radio" name="whatstage" id="optionsRadios2" value="Just need Quotes"><ins class="iCheck-helper"></ins>
                            </div>
                       Just interested in quotes
                        </label>
                    </div>
                </div><!--whatstage-->
                
         </div> <!--step-4-->

            <div class="row hide" data-step="5" data-title="This is the first step!">
                <div class="control-group" id="personalmessagae">
                    <label class="control-label" for="inputCity">Tell us more about your needs </label>
                        <div class="controls">
                            <textarea name="personalmessage" class="form-control" id="personalmessage"  rows="5" placeholder="tell us more about the your event needs include key details e.g type of meal(Africanna, buffet) it a standing event, customer are going to pay" required></textarea>
                        </div>
                </div>
            </div>

            @if(!Auth::guard('client')->check())
            <div class="row hide" data-step="6" data-title="This is the first step!" id="personal">
                        <p><b>Contact details<small>(so you can be notified when vendors reply with quotes )</small></b></p>
                        <label class="control-label" for="inputCity">First Name</label>
                        <div class="controls">
                            <input name="first_name" class="form-control" type="text" required/>
                        </div>

                        <label class="control-label" for="inputCity">Last Name</label>
                        <div class="controls">
                            <input name="last_name" class="form-control" type="text" required/>
                        </div>

                        <label class="control-label" for="inputCity">Email</label>
                        <div class="controls">
                            <input name="email" class="form-control" type="email" required/>
                        </div>

                        <label class="control-label" for="inputCity" id="step5password">Password</label>
                        <div class="controls">
                            <input name="password" class="form-control" type="password" id="step5password" required/>
                        </div>

                        <!--<label class="control-label" for="inputCity" id="step5password">Confirm Password</label>
                        <div class="controls">
                            <input name="confirm_password" class="form-control" type="password" id="step5confirm_password" required/>
                        </div>-->
               



                <!-- State and Locality-->
                <!--<input type="text" id="administrative_area_level_1" value="" name="state"/>
                <input type="text" id="locality" value="" name="vicinity"/>-->
                <!-- End of State and Locality-->
            </div><!--step-6-->
           @endif
        </form>
        <div class="modal-footer">
            <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
            <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
            <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>
        </div>
      </div><!-- Modal Body-->
   </div><!--Modal content-->
  </div><!--modal-dialog-->
</div><!--#myModal-->
