     @inject('service','App\Service\Service')
    
    <div class="section-header">
    <i class="" data-wow-delay="0.5s"></i>
    <h1>Some quotations in {{$some_quotes->first()->state}}</h1>
    </div>
    <div class="row">
    @foreach($some_quotes as $quote)
        @php $request  = json_decode($quote->qrequest);@endphp
        
        <div class="col-sm-4">
            <div class="thumbnail style1">
                <div class="thumb-wrapper">
                    <div class="caption">
                        <h3>Quotes For {{$quote->cat_name}} in {{$quote->vn}}</h3>
                            <p>Budget: {{$request->budget or 'N/A'}}</br>
                            Number of Guest:{{$request->numberofguests or 'N/A'}}
                                Max price:&#8358 {{$service->currencyFormatter()->formatCurrency($quote->ma,'EUR')}}
                            Minprice:&#8358 {{$service->currencyFormatter()->formatCurrency($quote->mi,'EUR')}}
                            Average price: &#8358 {{$service->currencyFormatter()->formatCurrency($quote->cost_avg,'EUR')}}</p>
                    </div>
                </div>      
            </div>
        </div>
    @endforeach
</div>