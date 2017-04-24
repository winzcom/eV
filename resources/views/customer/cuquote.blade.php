@extends('customer.layout.layout')

@section('style')

<style>

.details{
    max-height:450px;
    overflow-y:scroll;
}

.pop_over_img{
   width:100%;
    height:auto;
}

.slick{
    max-width:100%;
}

.popover{
   padding:0 0 0 0px;
   box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
   transition: 0.3s;
}

</style>
@endsection

@section('content')
@include('app_view.requestForm.showdetails')
@include('app_view.requestForm.contact_vendor')
<!-- page title style6 START -->
<section class="page-title style2 " data-path="{{asset('img/headers/header4.jpg')}}">
	<div class="middle-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="strong text-uppercase">quotes For {{$quotes->first()->pluck('cat_name')->first()}}</h1>
				</div>
			</div>
		</div>
	</div>
	<a href="#content" class="arrow bounce" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
</section>
<!-- page title style6 END -->
@include('app_view.requestForm.show_quote',['request'=>$quotes->first()->pluck('qrequest')->first()])


<!-- page content START -->
<div class="content" id="content">
	<!-- section START -->
         @inject('service','App\Service\Service')
		<section class="section half-section-right">
			
			<div class="container">
                @if(isset($quotes))
                
                    <button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                         data-target='#show_quote' data-ph = "{{$amazon_path}}">
                        Show Request
                    </button>
                        <span>Average Cost: 
                            <i>
                               &#8358 {{$service->currencyFormatter()->formatCurrency($cost_avg,'EUR')}}
                            </i>
                        </span>
                    <br/>
                    <hr> 

                    <div class="row">
            
                    
                       @foreach($quotes as $quote)
                        
                            <div class="col-sm-6">
                                <div class="thumbnail style1">
                                    <div class="thumb-wrapper">
                                    </div><!-- thumb-wrapper-->
                                    <div class="caption">
                                        <div class="well">
                                            @php 

                                             $review = ($quote->pluck('review')->unique()->all());
                                             $reply = ($quote->pluck('reply')->unique()->all());
                                             $reviewers_name = ($quote->pluck('reviewers_name')->unique()->all());

                                             $description = $quote->first()->description;
                                             $rating = $quote->pluck('rating')->all();
                                             $gallery_names = $quote->pluck('image_name')->unique()->all();
                                             
                                             
                                              $down_payment = null; 
                                              if($quote->first()->down_payment != 0 && $quote->first()->down_payment !== 100){
                                                  $down_payment = ((int)$quote->first()->down_payment*(int)$quote->first()->cost)/100;
                                              } 
                                              
                                            @endphp
                                            <h4>quote from {{$quote->first()->name}}</h4>
                                        </div>
                                        <h3>&#8358 {{$service->currencyFormatter()->formatCurrency($quote->first()->cost,'EUR')}} </h3>
                                        <h5>@if($down_payment !== null) DownPayment: &#8358 {{$service->currencyFormatter()->formatCurrency($down_payment,'EUR')}}@endif</h5>
                                        <p>{{$quote->first()->message}}</p>
                                        <!--<button class="btn btn-primary btn-sm" data-toggle="modal" 
                                             
                                        >
                                            Details
                                        </button>-->
                                      
                                        <button class="pop_over_details btn btn-primary btn-sm" data-description = "{{$description}}" 
                                            title="{{$service->showPopOverImages(array_slice($gallery_names,0,3),$amazon_path)}}" class="pop_over_img"
                                            data-content="<div><h4>Contact</h4>
                                                                {{$quote->first()->house_no}} {{$quote->first()->street_name}} {{$quote->first()->state}}
                                                                <h4>Summary</h4>
                                                               {{$service->limitWords($quote->first()->summary,50)}}
                                                               <a href='{{url('detail')}}/{{$quote->first()->name_slug}}'>View Profile</a>
                                                            </div>"

                                            data-toggle="popover" data-placement="right"
                                            
                                        >
                                            Details
                                        </button>
                                        @if($quote->first()->contact == 0)
                                            <button class="btn btn-default contact_vendor" data-target="#contact_vendor" data-toggle='modal' data-v-id="{{$quote->first()->id}}" data-r-id="{{$quote->first()->rid}}">
                                                Contact
                                            </button>
                                        @endif
                                        
                                        <div class="rating" data-rating="{{$quote->first()->avg}}"></div> <span class="reviews-link">({{number_format($quote->first()->avg,1)}} From {{$quote->first()->count}} reviews)</span>
                                    </div>
                                </div>
                            </div>
                            
                        @endforeach
                    </div>
                    
                @endif
                {{$quotes->links()}}
            </div>
        </section>
</div>



@endsection

@section('script')
<script src="{{asset('vendor/js/scroll/scroll.js')}}"></script>
@endsection