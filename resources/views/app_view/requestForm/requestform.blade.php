<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <div class="modal-content">
    <div class="modal-body">
        <form id="myWizard" type="get" action="{{url('/quotes_request')}}" class="form-horizontal" method="post">
             {{ csrf_field() }}
            <section class="step" data-step-title="The third">
                <div class="control-group" >
                    <label class="control-label" for="inputCity">What are you looking for?</label>
                        <div class="controls">
                            <select class="form-control input-lg " name="category" id="category">
                                
                                {{$categories->display()}}
                            </select>
                        </div>
                </div>

                <div class="control-group" id="event">
                    <label class="control-label" for="inputCity">What type of Event?</label>
                        <div class="controls">
                            <select class="form-control input-lg" name="event" id="eventtype">
                                
                                @foreach($events as $event)
                                    <option>{{$event->name}}</option>
                                @endforeach
                            </select>
                        </div>
                </div>

                <div class="control-group" id="date">
                    <label class="control-label" for="inputCity">Event Date</label>
                        <div class="controls">
                            <input type="date" name="date" class="form-control input-lg"/>
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

                <div class="control-group" id="venue">
                    <label class="control-label" for="inputCity">Venue (leave blank if you don't have a confirmed venue yet')</label>
                        <div class="controls">
                            <input type="text" name="venue" class="form-control input-lg" value=""/>
                        </div>
                </div>

                <div class="control-group" id="numberofguests">
                    <label class="control-label" for="inputCity">Number of Guests</label>
                        <div class="controls">
                            <input type="number" name="numberofguests" class="form-control input-lg"/>
                        </div>
                </div>

                <div class="control-group" id="numberofguests">
                    <label class="control-label" for="inputCity">Personal Message</label>
                        <div class="controls">
                            <textarea name="personalmessage" class="form-control" row=4></textarea>
                        </div>
                </div>

                <div class="control-group">
                    <label class="control-label" for="inputCity"></label>
                        <div class="controls">
                            <input type="submit" id="inputCity" class="btn btn-default" value="submit">
                        </div>
                </div>
            </section>
        </form>
      </div><!-- Modal Body-->
   </div><!--Modal content-->
  </div><!--modal-dialog-->
</div><!--#myModal-->