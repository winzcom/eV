     @inject('service','App\Service\Service')
    @if(count($companies) > 0)
        <div class="section-header">
        <i class="" data-wow-delay="0.5s"></i>
        <h1 style="text-align:center">Featured Vendors in {{$companies->first()->state}}</h1>
        </div>
        <div class="row">
            @foreach($companies as $company)
                
                
                <div class="col-sm-3">
                    <div class="thumbnail style1" style="max-width:300px;max-height:auto;margin-left:10px;">
                        <div class="thumb-wrapper">
                            <div class="item">
                                @if($company->company_image !== null)
                                    @if($company->company_image !== '')
                                        <img src="{{asset('storage/images')}}/{{$company->company_image}}" alt="Thumbnail">
                                    @else
                                        <img src"{{asset('img/defaultRequest.jpg')}}"/>
                                    @endif
                                @endif
                            </div>
                            <div class="caption">
                                <h3>{{$company->name}}</h3>
                                <p>[{{implode(",",$company->categories->pluck('name')->all())}}]</p>
                            </div>
                        </div>      
                    </div>
                </div>
            @endforeach
        </div>
      @endif
