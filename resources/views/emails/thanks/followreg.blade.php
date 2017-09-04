@extends('emails.layout.email')

@section('content')

<div id="freg_div">
    <h4>Dear, {{ $company_name }}</h4><br>
    <p>
        Thank you for registering your business on eventpad.ng. By taking this initial step, 
        you are already well on your way to getting more customers to your business.
        For our registered vendors,
        Eventpad makes requests from individuals and event organizers accessible to you, You can then decide to respond to them provided you are interested in making them your customers.
        Please let us know how we can help you by emailing us at eventpadinfo@gmail.com
        <!-- This works by making requests from individuals and event organizers accessible to you. 
        You can then decide to respond to them provided you are interested in making them your customers.

        <p style="text-align:center;">
        <h4>Here is a sample request.</h4> <br>
        <a href="https://eventpad.ng/about_us"><img src="https://eventpad.ng/img/sample_request.JPG" alt=""></a>
    </p>
        <h4>What do you stand to gain</h4>
        <ol class="list-group">
            <li class="list-group-item">
                <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                Wider customer reach as you receive requests based on your service and location</li>
            <li class="list-group-item">
                <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                No need worrying about been on first page of listings</li>
            <li class="list-group-item">
                <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                Can reply to user reviews about your service</li>
            <li class="list-group-item">
                <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                With each request received, you can get pricing information that can help you make better 
                decisions when writing your quotes on and off the platform
            </li>
        </ol> -->
        <br><br>
        Best Regards,<br><br>

        Eventpad Team
    </p>
</div>



@endsection