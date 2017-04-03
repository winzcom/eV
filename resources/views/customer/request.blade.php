@extends('vendor.layout.layout')

@section('content')
@include('vendor.header.header',['title'=>'Requests'])
<div class="content" id="content">

	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">
                <div id="">
                    @include('app_view.shared.showfewrequestforclient',['all_requests'=>$requests,'customer_id'=>Auth::guard('client')->id()])
					
					{{$requests->setPath('curequests')->render()}}
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
<script src="{{asset('vendor/js/jaccordion/jquery-ui.min.js')}}"></script>
<script>
$(document).ready(function(){
		$( "#accordion" ).accordion({
			collapsible: true,
			active:true
		});
})
	
</script>
@endsection