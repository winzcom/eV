@extends('customer.layout.layout')

@section('content')

<!-- page title style6 START -->
<section class="page-title style2 " data-path="{{asset('img/headers/header4.jpg')}}">
	<div class="middle-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
                
					<h1 class="strong text-uppercase">quotes For {{$quotes->pluck('cat_name')->first()}}</h1>
				</div>
			</div>
		</div>
	</div>
	<a href="#content" class="arrow bounce" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
</section>
<!-- page title style6 END -->
@include('app_view.requestForm.show_quote',['request'=>$quotes->pluck('qrequest')->first()])
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
                                              $formatter = new \NumberFormatter('en_GB',  NumberFormatter::CURRENCY);
                                              $formatter->setSymbol(NumberFormatter::CURRENCY_SYMBOL,'');
                                              $down_payment = null; 
                                              if($quote->down_payment != 0 && $quote->down_payment !== 100){
                                                  $down_payment = ((int)$quote->down_payment*(int)$quote->cost)/100;
                                              } 
                                              
                                            @endphp
                                            <h4>quote from {{$quote->name}}</h4>
                                        </div>
                                        <h3>&#8358 {{$formatter->formatCurrency($quote->cost,'EUR')}} </h3>
                                        <h5>@if($down_payment !== null) DownPayment: &#8358 {{$formatter->formatCurrency($down_payment,'EUR')}}@endif</h5>
                                        <p>{{$quote->message}}</p>
                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#show_details" title="Thumbnail link">Book</button>
                                        <a href="{{url('/detail')}}/{{$quote->name_slug}}" class="btn btn-primary btn-sm ">
                                            Details
                                        </a>
                                        <div class="rating" data-rating="{{$quote->avg}}"></div> <span class="reviews-link">({{number_format($quote->avg,1)}} From {{$quote->count}} reviews)</span>
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
$(document).ready(function(){

    $('.rating').each(function(i,e){

        var self = $(this);
        var rating = self.data('rating');

        if(rating !=''){
            self.rateYo({
                rating:rating,
                readOnly:false,
                starWidth:'20px'
            })
        }
    })
})
</script>
@endsection