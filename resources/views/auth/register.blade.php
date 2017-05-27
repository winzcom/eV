@extends('layouts.applayout')

@section('content')
<!-- page title style2 START -->
<section class="page-title style1" data-path="img/headers/header7.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="strong">Register</h1>
			</div>
		</div>
	</div>
</section>
<!-- page title style2 END -->
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Company Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                <span id="status"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary" id= "register">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')

<script src="{{ asset('js/mailgun_validator.js') }}"></script>
<script>
    
    $(document).ready( function() {

        var reg = $('#register');
        reg.attr('disabled', true);

        $('#email').mailgun_validator({
          api_key: 'pubkey-ca5312e0946a6a724c269a03cee39de7', // replace this with your Mailgun public API key
          in_progress: validation_in_progress,
          success: validation_success,
          error: validation_error,
        });

        function validation_in_progress() {
            $('#status').html("Validating email....");
        }

        function validation_success(data) {
            $('#status').html(get_suggestion_str(data['is_valid'], data['did_you_mean']));
            if(data['is_valid']) {
                reg.attr('disabled', false);
            } 
        }

        function validation_error(error_message) {
            $('#status').html(error_message);
        }

        function get_suggestion_str(is_valid, alternate) {
            if (is_valid) {
                var result = '<span class="success">Address is valid.</span>';
                if (alternate) {
                    result += '<span class="warning"> (Though did you mean <em>' + alternate + '</em>?)</span>';
                }
                return result
            } else if (alternate) {
                return '<span class="warning">Did you mean <em>' +  alternate + '</em>?</span>';
            } else {
                return '<span class="error">Email address is invalid.</span>';
            }
      }

    })

</script>
@endsection

