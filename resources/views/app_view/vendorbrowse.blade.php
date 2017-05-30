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
        <p><b>Select a Category</b></p>
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

</section>


        

<div class="content" id="content">

	<!-- section thumbnail box style1 START -->
		<section class="section">
        @inject('service','App\Service\Service')
			<div class="container">
                @if(isset($companies))
                    @if(count($companies) > 0)
                        @php $comps = $companies->sortByDesc('bay_average');@endphp
                        <div class="row">
                        
                            @foreach($comps as $company)
                                <div class="col-sm-4">
                                    <div class="thumbnail style1">
                                        <div class="thumb-wrapper">
                                            
                                            
                                                @if(count($company->galleries) > 1)
                                                    <div class="thumbs-carousel">
                                                    @php
                                                        $file_name = $company->galleries->pluck('image_name')->take(2); 
                                                    @endphp
                                                    @foreach($file_name as $key=>$value)
                                                        <div class="item">
                                                            <img src="{{$path}}/{{$value}}" alt="Thumbnail">
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                @elseif(count($company->galleries) == 1)
                                                    <div class="item">

                                                    <img src="{{$path}}/{{$company->galleries->first()->image_name}}" alt="" width="300" height="3"/>
                                                    </div>
                                                @endif
                                            
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
                     @else 
                        <div class="row">
                            <div class="col-sm-12 alert alert-info">
                                <h3>No vendors Available</h3>
                            </div>
                        </div>
                @endif
			</div>
		</section>
	<!--
@endsection