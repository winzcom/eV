<div>

    Hello {{$user->first_name}} {{$user->last_name}}
    Please click the link to verify your account
    <a href = "{{url('register/verify/'.$user->confirm_token)}}">Verify</a>
</div>