 <ul class="list-group">
            @foreach($companies as $company )
                <div class="">
                    <li class="list-group-item w3-card-2 li">
                        <div class="row">
                            <div class="col-md-4 img">
                                    @if($company->galleries()->first() !== null)
                                        <img src="{{asset('storage/images/')}}/{{$company->galleries()->first()->image_name}}" alt="..." width="250px;" height=150 id="img">
                                    @else
                                        <img src="{{asset('storage/images/default.jfif')}}" alt="No image" width="250px;" height=auto id="img">
                                    @endif
                            </div><!-- img col-md-4-->
                            <div class="col-md-8">
                                <h3>{{$company->name}}(@foreach ($company->categories as $cat) 
                                    <small>{{$cat->name}} </small>  @endforeach) 
                                    <small>
                                         @if($company->reviews->count() !== 0)
                                            {{number_format($company->reviews->avg('rating'),1)}}/5 
                                            from {{$company->reviews->count()}} reviews
                                        @endif
                                    </small>
                                </h3>
                                <p>{{$company->summary}}</p>
                                <div id ="address">
                                    <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>
                                        {{$company->house_no}} {{$company->street_name}} 
                                           {{$company->state}} 
                                    </p>
                                </div>
                                <p><a href="{{url('detail/'.$company->name_slug)}}" class="w3-btn w3-blue" role="button">Details</a></p>
                            </div><!--  col-md-8-->

                        </div><!-- row-->
                    </li>
                <div><!-- card-->
            @endforeach
        </ul>