@extends('user.layout.layout')

@section('content')
@include('app_view.requestForm.replyrequest')
@include('user.header.header',['title'=>'Requests'])
<div class="content" id="content">

	<!-- section START -->
		<section class="section half-section-right">
			
			<div class="container">
                <div id="">
                    @include('app_view.shared.showfewrequests',['all_requests'=>$reqs])
					
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