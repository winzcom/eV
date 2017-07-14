@extends('emails.layout.email')

@section('content')
<br><br>
<div style="color:#4d4d4d">
     
    <p>
        Hello {{ $name or ''}}, <br>
        Eventpad is a new platform that offers a different approach to vendor sourcing. We are not just a listing platform. We offer a request/reply form of communication 
        between you and those that need your services.
        i.e those in need of a particular service can make a request from our platform 
        and based on the specified location you receive this request notification via email or sms.
        You can then decide to respond to them provided you are interested in making them your customers.
        The customer receives the quotes and if they are satisfied with it they contact you with more details.
        <!--To complement your effort in getting new customers, Eventpad makes it possible for Individuals and Event Organizers to reach out to you when in need of your service. 
        This works by making requests from individuals and event organizers accessible to you. 
        You can then decide to respond to them provided you are interested in making them your customers-->
    </p><br>
    <h4>Each request received will contain the following</h4> 
    <ol class="list-group">
        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The category ( i.e the service needed like catering, drinks )</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The type of event to be organized</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The event date</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The start time (i.e time the service will be required)</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	May contain number of hours your service is needed</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The event venue</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The estimated number of guest</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	Their budget</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The stage of the request (i.e are they looking to book immediately or just interested in quotes)</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	May contain additional message regarding the service they need</li>

        <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	The customers first name and last name</li>
    </ol>

    <p>
        The request may also contain some additional information pertaining to the service the client selects.
    </p>
    <p style="text-align:center;">
        <h4>Here is a sample request.</h4> <br>
        <a href="https://eventpad.ng/about_us"><img src="https://eventpad.ng/img/sample_request.JPG" alt=""></a>
    </p>
    <br><hr>
        <p>With this information you can then reply with your quotes that should contain the following</p>
        <ol class="list-group">
        <li class="list-group-item"><img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	Your estimated cost </li>

        <li class="list-group-item"><img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	Your down payment in percentage (optional) e.g 2%</li>

        <li class="list-group-item"><img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;	Your message that will contain a cost break-down and/or a recommendation to the customer</li>
    </ol>


    <p>
        <h4>Some of the Benefits are:</h4>
        <ol class="list-group">
            <li class="list-group-item"> 
                <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                Wider customer reach as you receive requests based on your service and location</li>
            <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                Can reply to user reviews about your service</li>
            <li class="list-group-item">  <img src="https://png.icons8.com/ok/ultraviolet/20" title="Ok" width="20" height="20">&nbsp;
                With each request received, you can get pricing information that can help you make better 
                decisions when writing your quotes on and off the platform
            </li>
        </ol>

        
    </p>
    <br>
    <p>
        If you are interested in been part of us you can click the join now button below <br>
        <small><i>please note that you need to fill this email address in the email field when you click the button</i></small>
    </p>
    <a href="https://eventpad.ng/verify/vendor/email"><button class="btn btn-primary" type="">Join Now</button></a>
    <p>
        <b>
            <i>Also note that the system pushes the request to all vendors that meet the customers search query, 
        which are category, the state and the locality.
            </i>
        </b><br>
        <small>For more information see contact below:</small><br>
        Name: <b>Ebun</b> <br>
        Phone Number: <b>08180002816</b><br>
        Email: <b>ebudare@yahoo.com</b><br>
    </p>

</div>



@endsection
