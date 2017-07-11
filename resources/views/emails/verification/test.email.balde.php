@extends('emails.layout.email')

@section('content')
<br><br>
<div style="color:#4d4d4d">
     
    <p>
        Hello,<br>
        Get customers in minutes with Eventpad. Eventpad is not just a listing platform. We offer a request/reply form of communication 
        between you and those that need your services.
        i.e those in need of a particular service can make a request from our platform 
        and based on the specified location you receive this request notification via email,
        You can then decide to respond to them provided you are interested in making them your customers.
        The customer receives the quotes and if they are satisfied with it they contact you with more details.
        <!--To complement your effort in getting new customers, Eventpad makes it possible for Individuals and Event Organizers to reach out to you when in need of your service. 
        This works by making requests from individuals and event organizers accessible to you. 
        You can then decide to respond to them provided you are interested in making them your customers-->
    </p><br>
    <p>
        <h4>Some of the Benefits are:</h4>
        <ol>
            <li>Wider customer reach as you receive requests based on your service and location</li>
            <li>No need to worry about been on top listing or first page of listing</li>
            <li>Can reply to user reviews about your service</li>
            <li>
                With each request received you can get a better pricing data that can help you make better 
                pricing decisions on and off the platform
                </li>
        </ol>

        <p>
            With this service you receive specific customer requests based on location, specific needs, and their budgets. 
            Let us transform the way you get customers to your business in minutes by clicking the Join Now button that follows. 
            It takes only a few minutes.&nbsp;<small><i>See below for more information about the platform.</i></small>
        </p>
    </p>
    <br>
    <a href="https://eventpad.ng/verify/vendor/email"><button class="btn btn-primary" type="">Join Now</button></a>
    <br><hr>

    <h4>More information</h4>
    <h5>Each request received will contain the following</h5> 
    <ol>
        <li>	The category ( i.e the service needed like catering, drinks )</li>

        <li>	The type of event to be organized</li>

        <li>	The event date</li>

        <li>	The start time (i.e time the service will be required)</li>

        <li>	May contain number of hours your service is needed</li>

        <li>	The event venue</li>

        <li>	The estimated number of guest</li>

        <li>	Their budget</li>

        <li>	The stage of the request (i.e are they looking book immediately or just interested in quotes)</li>

        <li>	Additional message regarding the service they need</li>

        <li>	The customers first name and last name</li>
    </ol>

    <p>The request may also contain some additional information pertaining to the service the client selects.
        With this information you can then reply with your quotes that should contain the following
    </p>

    <ol>
        <li>	Your estimated cost </li>

        <li>	Your down payment in percentage (optional) e.g 2%</li>

        <li>	Your message that will contain a cost break-down and/or a recommendation to the customer</li>
    </ol>

    <p>
        <b>
            <i>Please note that the system pushes the request to all vendors that meet the customers search query, 
        which are category, the state and the locality. For example a request from a customer needing a caterer in Ikeja, 
        Lagos will be sent to catering  vendors within Ikeja.
            </i>
        </b>
    </p>

</div>



@endsection
