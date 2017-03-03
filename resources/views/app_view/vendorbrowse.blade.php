@extends('layouts.applayout')

@section('content')

@include('app_view.requestForm.requestform',['category_id'=>$category_id])
<section class="page-title style2" data-path="{{asset('img/headers/header4.jpg')}}">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="strong">Browse Vendors</h1>
                @if(isset($cat_name))
						<h4 class="strong text-uppercase" style="color:white;">
							Get Quotes from {{$cat_name}}
						</h4>
						@include('app_view.requestForm.stateform')
                @endif
			</div>
		</div>
	</div>
</section>
<!-- page title style6 END -->


<section class="section">
<div class="container">
    
<div class="">
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
    </div>
</div>




        

<div class="content" id="content">

	<!-- section thumbnail box style1 START -->
		<section class="section">
			<div class="container">
                @if(isset($companies))
                    <div class="row">
                        @foreach($companies as $company)
                            <div class="col-sm-4">
                                <div class="thumbnail style1">
                                    <div class="thumb-wrapper">
                                        <div class="thumbs-carousel">
                                            <div class="item">
                                                <img src="{{asset('img/thumbnails/thumb3.jpg')}}" alt="Thumbnail">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('img/thumbnails/thumb4.jpg')}}" alt="Thumbnail">
                                            </div>
                                            <div class="item">
                                                <img src="{{asset('img/thumbnails/thumb5.jpg')}}" alt="Thumbnail">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3>{{$company->name}}</h3>
                                        <p>{{$company->description}}</p>
                                        <a href="{{url('/detail/')}}/{{$company->name_slug}}/{{$category_id}}" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    {{$companies->links()}}
                @endif
			</div>
		</section>
	<!--
@endsection