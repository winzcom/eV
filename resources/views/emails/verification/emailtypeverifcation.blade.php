@extends('emails.layout.email')

@section('content')
<br><br>
<div style="color:#4d4d4d;">
     <small><i>This is a sample mail feedback will be appreciated</i></small>
    <p  style="text-align:center;">
        <b>Hello </b>
        <br>
        <img src="https://eventpad.ng/img/email-header.jpg" alt=""><br><br>
        Eventpad is not just a listing platform. We offer a request/reply form of communication 
        between you and those that need your services. They make a request on our platform and you get notified via email, and if you are interested you login and reply with your quote.
        <!--To complement your effort in getting new customers, Eventpad makes it possible for Individuals and Event Organizers to reach out to you when in need of your service. 
        This works by making requests from individuals and event organizers accessible to you. 
        You can then decide to respond to them provided you are interested in making them your customers-->
    </p><br>
    <p style="text-align:center;">
        <h4>Here is a sample request.</h4> <br>
        <a href="https://eventpad.ng/about_us"><img src="https://eventpad.ng/img/sample_request.JPG" alt=""></a>
    </p>
    <p>
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
        </ol>

        <p>
            
        </p>
    </p>
    <br>
    You can get started with us by clicking the button below <br><br><br>
    <a style="text-align:center; padding:16px 10px 16px 10px;" href="https://eventpad.ng/verify/vendor/email"><button type="button" class="btn btn-lg btn-primary">Join Now</button></a>
    <br><hr>
    <p>
        Eventpad sends request to vendors meeting these requirements: service and location,
        so make sure you update your profile when you are logged in to the platform
    </p>
    <p>You can read more <a href="https://eventpad.ng/about_us">here</a></p>


</div>



@endsection
