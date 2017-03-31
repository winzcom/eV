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
							Get Quotes for {{$cat_name or ''}}
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
    <!--<h3 class="pull-left">Featured Items</h3>-->
    <div id="filters-container" class="cbp-l-filters-dropdown">
        <div class="cbp-l-filters-dropdownWrap">
            <div class="outPopUp">
                <select class="form-control input-lg " name="category" id="browsevendor">
                    <option>...</option>
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
        </div>
    </div>
</div>




        

<div class="content" id="content">

	<!-- section thumbnail box style1 START -->
		<section class="section">
        @inject('service','App\Service\Service')
			<div class="container">
                @if(isset($companies))
                    <div class="row">
                        @foreach($companies as $company)
                            <div class="col-sm-4">
                                <div class="thumbnail style1">
                                    <div class="thumb-wrapper">
                                        <div class="thumbs-carousel">
                                            @if(count($company->galleries) > 0)
                                                    <div class="item">
                                                        <img src="{{$path}}/{{$company->galleries->pluck('image_name')->take(3)}}" alt="Thumbnail">
                                                    </div>
                                            @else
                                                <div class="alert alert-info "></div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="caption">
                                        <h3>{{$company->name}}</h3>
                                        <p>{{$service->limitWords($company->description,15)}}...</p>
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