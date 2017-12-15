@extends('layouts.applayout')

@section('content')
<div id="vendor_vue">
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
						@include('app_view.requestForm.stateform',['current_state'=>$cur_state])
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
        <div class="row">
            <div class="col-sm-4">
                <div class="cbp-l-filters-dropdownWrap">
                    <p><b>Select State</b></p>
                    <div class="outPopUp">
                        <select class="form-control input-lg " name="state" id="state">
                            <option value="">...</option>
                            @foreach ($states as $state)
                            
                                <option 
                                    value = "{{$state->state}}" data-id = "{{$state->id}}"
                                    <?php echo $state->state == $cur_state ? 'selected' : ''?> 
                                >
                                    {{$state->state}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="cbp-l-filters-dropdownWrap">
                    <p><b>Select a Category</b></p>
                    <div class="outPopUp">
                        <select class="form-control input-lg " name="category" id="browsevendor" v-on:change="getVendors">
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
            <div class="col-sm-2">
               
                    <input type="button" value="Search" class="form-control btn btn-primary" id="search_button">
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
                                                        $file_name = $company->galleries->pluck('image_name')->take(3); 
                                                    @endphp
                                                    @foreach($file_name as $key=>$value)
                                                        <div class="item">
                                                            <img src="{{$path}}/{{$value}}" alt="Thumbnail" style="width:100%;max-height:250px;">
                                                        </div>
                                                    @endforeach
                                                    </div>
                                                @elseif(count($company->galleries) == 1)
                                                    <div class="item">

                                                    <img src="{{$path}}/{{$company->galleries->first()->image_name}}" alt="" style="width:100%;max-height:250px;"/>
                                                    </div>
                                                @elseif($company->company_image !== '')
                                                    <div class="item">

                                                    <img src="{{asset('company_images')}}/{{$company->company_image}}" alt="" style="width:100%; max-height:250px;"/>
                                                    </div>
                                                @else
                                                    <div class="item">

                                                    <img src="{{ asset('/img/_7.jfif') }}" alt="" style="width:100%; max-height:250px;"/>
                                                    </div>
                                                @endif
                                            
                                        </div>
                                        <div class="caption">
                                            <h3>{{$company->name}}</h3>
                                            <p>{{$service->limitWords($company->description,15)}}...</p>
                                            @if($company->name_slug != null)
                                            <a href="{{url('/detail/')}}/{{$company->name_slug}}/{{$category_id}}" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>
                                            @endif

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

        <!--- Vue Controlled -->
        <!-- <div v-if="showLoader" class="container">
            <img src="{{asset('img/loading.gif')}}" alt="">
        </div>
        <div class="row" v-if="dataAvailable" id="vendor">
            <div class="col-sm-4" v-for="vendor in items">
               <div class="thumbnail style1">
                <div class="thumb-wrapper">
                    <div class="thumbs-carousel">
                        <div class="item">
                            <img v-bind:src="img" width="200" alt="" srcset="" class="vendor-img">
                        </div>
                    </div>
                    <div class="caption">
                        <h3>@{{ vendor.name }}</h3>
                        
                       
                        <a v-bind:href="vendor.url" v-on:click.prevent="goToDetail(vendor.url)" v-if="vendor.name_slug" class="btn btn-primary btn-sm" title="Thumbnail link">Read More</a>

                    </div>
                </div>
               </div>
            </div>
        </div>
        <a href="" v-if="paginatedData.previous_page_url" class="pull-left"><button class="btn btn-default">Previous</button></a>
        <a href="" v-if="paginatedData.next_page_url" class="pull-right"><button class="btn btn-default">Next</button></a> -->
        <!-- End of Vue Controlled -->
        <div id="sentel"></div>
        
		</section>
</div>
@endsection

@section('script')
{{--<script src="{{ asset('jss/browse-vendor-component.js') }}"></script>
<script src="{{ asset('jss/applayoutvue.js') }}"></script>--}}
@endsection