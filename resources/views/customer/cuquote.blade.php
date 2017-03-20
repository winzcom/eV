@extends('customer.layout.layout')

@section('style')

<style>

.details{
    max-height:450px;
    overflow-y:scroll;
}

</style>
@endsection

@section('content')

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
@include('app_view.shared.showdetails')

<!-- page content START -->
<div class="content" id="content">
	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">
                @if(isset($quotes))
                
                    <button class='btn btn-success btn-xs request' id='reply' data-toggle='modal'
                         data-target='#show_quote'>
                        Show Request
                    </button><br><hr>

                    <div class="row">
            

                        @foreach($quotes as $quote)
                        
                            <div class="col-sm-6">
                                <div class="thumbnail style1">
                                    <div class="thumb-wrapper">
                                    </div><!-- thumb-wrapper-->
                                    <div class="caption">
                                        <div class="well">
                                            @php 

                                             $review = json_encode($quote->pluck('review')->all());
                                             $reply = json_encode($quote->pluck('reply')->all());
                                             $reviewers_name = json_encode($quote->pluck('reviewers_name')->all());
                                             $description = $quote->first()->description;
                                             $rating = json_encode($quote->pluck('rating')->all());
                                    
                                              $formatter = new \NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                                              $formatter->setSymbol(NumberFormatter::CURRENCY_SYMBOL,'');
                                              $down_payment = null; 
                                              if($quote->first()->down_payment != 0 && $quote->first()->down_payment !== 100){
                                                  $down_payment = ((int)$quote->first()->down_payment*(int)$quote->first()->cost)/100;
                                              } 
                                              
                                            @endphp
                                            <h4>quote from {{$quote->first()->name}}</h4>
                                        </div>
                                        <h3>&#8358 {{$formatter->formatCurrency($quote->first()->cost,'EUR')}} </h3>
                                        <h5>@if($down_payment !== null) DownPayment: &#8358 {{$formatter->formatCurrency($down_payment,'EUR')}}@endif</h5>
                                        <p>{{$quote->first()->message}}</p>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" 
                                             data-target="#show_details" title="Thumbnail link"
                                             data-review = "{{$review}}" data-reply="{{$reply}}",
                                             data-reviewer = "{{$reviewers_name}}"
                                             data-description = "{{$description}}",
                                             data-company-name = "{{$quote->first()->name}}"
                                             data-rating = "{{$rating}}"
                                        >
                                            Details
                                        </button>

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
<script>

</script>
@endsection