@extends('layouts.applayout')

@section('content')

    @include('app_view.requestForm.requestform',['category_id'=>$category_id])
    <div class="content" id="content">
	<section class="page-title style5" data-path="{{asset('img/headers/header13.jpg')}}">
	<div class="bottom-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="strong text-uppercase">Browse Vendors</h1>
                    @if(isset($cat_name))
						<h4 class="strong text-uppercase">
							Get Quotes from {{$cat_name}}
						</h4>
						@include('app_view.requestForm.stateform')
					@endif
				</div>
			</div>
		</div>
	</div>
	<a href="#content" class="arrow bounce" title="About Me"><i class="fa fa-angle-down"></i></a>
</section>
<!-- page title style6 END -->


	<!-- section START -->
		<section class="section">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="cbp-panel">
							<h3 class="pull-left">Featured Items</h3>
							<div id="filters-container" class="cbp-l-filters-dropdown">
								<div class="cbp-l-filters-dropdownWrap">
									<div class="">Sort Gallery</div>
									<select class="form-control input-lg " name="category" id="browsevendor">
                                    
                                        @if(isset($category_id))
                                            {{$categories->display($category_id)}}
                                            {{$category_id}}
                                        @else
                                            {{$categories->display()}}
                                        @endif
                                    </select>
								</div>
							</div>
                        
                            @if(isset($companies))
                              <div  class="cbp shop-4col">
                                @foreach($companies as $company)
                                    
                                    <div class="cbp-item motion print">
                                        <div class="thumbnail product">
                                            <div class="thumb-wrapper">
                                                <a href="{{url('/detail/')}}/{{$company->name_slug}}/{{$category_id}}" title="Single product">
                                                    <img src="{{asset('img/shop/p1.jpg')}}" class="img-one" alt="Thumbnail">
                                                    <img src="{{asset('img/shop/p1-alt.jpg')}}" class="img-two" alt="Thumbnail">
                                                    <!--<span class="sale">Sale!</span>-->
                                                </a>
                                                <div class="controls">
                                                    <a href="{{url('/detail/')}}/{{$company->name_slug}}/{{$category_id}}" class="view-details" title="View details" data-toggle="tooltip" data-placement="right"><i class="livicon" data-name="list" data-color="#fff" data-hovercolor="#fff" data-size="22"></i></a>
                                                    <a href="javascript:void(0);" class="like-this" title="Like this" data-toggle="tooltip" data-placement="right"><i class="livicon" data-name="heart" data-color="#fff" data-hovercolor="#fff" data-size="22"></i></a>
                                                </div>
                                            </div>
                                            <div class="caption">
                                                <h3>{{$company->name}}</h3>
            
                                                
                                            </div>
                                     </div>
                                    </div>
                                    
                                @endforeach
                                
                              </div>
								{{ $companies->links() }}
                            @endif
					
							<div id="loadMore-container" class="cbp-l-loadMore-button">
								<a href="cubeportfolio/ajax/shop1/loadMore.html" class="cbp-l-loadMore-link">
									<span class="cbp-l-loadMore-defaultText">LOAD MORE</span>
									<span class="cbp-l-loadMore-loadingText">LOADING...</span>
									<span class="cbp-l-loadMore-noMoreLoading">NO MORE ITEMS</span>
								</a>
							</div>
					
						</div>
					</div>
				</div>
			</div>
		</section>
	<!-- section END -->
	
	<!-- section START -->
		
	<!-- section END -->
	
	<!-- section START -->
	<!-- section END -->

</div>

@endsection