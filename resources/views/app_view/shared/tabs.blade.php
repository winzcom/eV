@if(Request::path() == 'home')

<ul class = "tabs nav nav-tabs" role="tablist">
        <li  role="presentation">
                <button class="tablinks"style="border:none;background-color:#fff;"  onclick="openCity(this,'reviews')">
                    Reviews({{$review_count}})
                </button>
        </li>
        
        <li role="presentation">
            <button class="tablinks" style="border:none;background-color:#fff;" onclick="openCity(this,'quotations')">Quotations</button>
        </li>

         <li role="presentation">
            <button class="tablinks" style="border:none;background-color:#fff;" onclick="openCity(this,'offdays')">Off Days</button>
        </li>
        
</ul>

@elseif(Request::path() == 'reviews')

    <ul class = "tabs nav nav-tabs" role="tablist">

        <li  role="presentation">
                <button class="tablinks"style="border:none;background-color:#fff;"  onclick="openCity(this,'positives')">
                    <span class="glyphicon glyphicon-chevron-right"></span> Median Rating({{$positives->count()}})
                </button>
        </li>
        
        <li role="presentation">
            <button class="tablinks" style="border:none;background-color:#fff;" onclick="openCity(this,'negatives')">
                <span class="glyphicon glyphicon-chevron-left"></span> Median Rating({{$negatives->count()}})
            </button>
        </li>
        <span class="glyphicon glyphicon-stats">  
            AverageRating {{number_format($average,1)}}/5 
            TotalReviews {{$total}} 
            MedianRating 3
        </span>
</ul>    

@else
    <ul class = "tabs nav nav-tabs" role="tablist">
        <li role="presentation">
            <button class="tablinks" style="border:none; padding:10px;" onclick="openCity(this,'Description')">Description</button>
        </li>
        <li>
            <button class="tablinks" style="border:none;padding:10px;" onclick="openCity(this,'Map')">Map</button>
        </li>
        <li>
            <button class="tablinks"style="border:none;padding:10px;"  onclick="openCity(this,'Review')">Reviews({{$review_count}})</button>
        </li>
</ul>

@endif
<!--<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#Description" aria-controls="Description" role="tab" data-toggle="tab">Description</a></li>
    <li role="presentation"><a href="#map" aria-controls="map" role="tab" data-toggle="tab">Map</a></li>
    <li role="presentation"><a href="#Review" aria-controls="Review" role="Review" data-toggle="tab">Reviews(1)</a></li>
  </ul>-->
