@extends('vendor.layout.layout')

@section('content')
@include('app_view.requestForm.replyrequest')
@include('vendor.header.header',['title'=>'Requests'])
<div class="content" id="content">
@include('vendor.profile_update_snippet')
	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">
                <div id="">
                    @include('app_view.shared.showfewrequests',['all_requests'=>$reqs,'vendor_id'=>Auth::id()])
					
					{{$reqs->setPath('requests')->render()}}
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