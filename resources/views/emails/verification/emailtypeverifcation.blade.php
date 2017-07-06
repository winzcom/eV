@extends('emails.layout.email')

@section('content')
<br>
<p>Hello, eventpad is a new vendor sourcing platform that offers a different approach to vendor sourcing. We are not just a listing platform we offer a request- reply form of communication between you and those that need your services i.e those in need of a particular category can make a request from our platform and based on the specified location you receive this request notification via email, you then login to the platform and reply to the request.</p> 
<h4>Benefits</h4> 
<ul>
    <li>	More user outreach as you receive request based on your service and location</li>
    <li>	No need to worry about been on top listing or first page of listing</li>
    <li>	Can reply to user reviews about your service</li>
    <li>	Over time you can get a better understanding of pricing in your field as you get to see max and min pricing  for a requests and that help you make better pricing decisions</li>
</ul>

<h4>More Info</h4>
Each request received will contain the following,
<ul>
    <li>	The category ( ie the service needed like catering, drinks )</li>
    <li>	The type of event to be organized</li>
    <li>	The event date</li>
    <li>	The start time (ie time the service will be required)</li>
    <li>	The duration for the service</li>
    <li>	May contain the event venue</li>
    <li>	The estimated number of guest</li>
    <li>	Their budget</li>
    <li>	The stage of the request (ie are just looking for quote or need to book asap)</li>
    <li>	Additional message regarding the service they need</li>
    <li>	The customers first name and last name</li>
</ul> 
<br>
The request may also contain some additional information pertaining the category selected ie your service.
With this information you can then reply with your quotes that should contain the following
<ul>
    <li>	Your estimated cost</li>
    <li>	Your down payment in percentage (optional) eg 2%.</li>
    <li>	Your message that will contain a cost break-down and/or may be a recommendation to the customer.</li>
</ul> 
<br>
The customer receives the quotes and if they are satisfied with it they contact you with more details.<br>
<h4><i>Please note that the system pushes the request to all vendors that meet the customers search query, which is the category, the state and the locality. For example a request from a customer needing a caterer in Ikeja, Lagos will be sent to vendors within Ikeja.</i></h4>

If You will like to be a part of this service, you can click the link below to create a password. please note you will need to supply this email address. 
We would love to have you.
<br><hr>
<a href="https://eventpad.ng/verify/vendor/email"><button class="btn btn-primary" type="">Create Password</button></a>

@endsection
