<div>

    <img src="https://eventpad.ng/img/logos/logo.png" alt=""><br><br>
    Hello {{ $user->name }} thank you for signing up with EventPad 
    Please click the link to verify your account with us
    <a href = "{{url('register/verify/')}}/{{$token}}">Verify</a>
</div>