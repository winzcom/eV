@extends('layouts.applayout')

@section('content')
<!-- page title style2 START -->
<section class="page-title style1" data-path="img/headers/header7.jpg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
                <h1 class="strong">Register</h1>
                <h5 style="color:#fff;">And connect with others</h5>
			</div>
		</div>
	</div>
</section>
<!-- page title style2 END -->
<div class="container" style="padding-top:10px;">
    <div class="row">
        <!-- <div class="col-md-4 col-sm-12">
            <div class="e-book_section">
                <h4>E-book Make Your EventPlanning Great</h4>
                <p>Register to get a copy</p>
            </div>
        </div> -->
        <div class="col-md-8 col-sm-12">
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
                                <input id="email" type="email" class="form-control email" name="email" value="{{ old('email') }}" required>
                                <span id="status"></span>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Phone Number</label>

                            <div class="col-md-6">
                                <input id="email" type="number" min="0" class="form-control phone_no" name="phone_no" value="{{ old('phone_no') }}" required>
                                <span id="status"></span>
                                @if ($errors->has('phone_no'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_no') }}</strong>
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
<!-- <script type="text/javascript">
    _NBSettings = {
        apiKey: 'public_63edb90c888448ff14ccfd1cca42f13d'
    };
</script>
<script type="text/javascript" src="https://cdn.neverbounce.com/widget/dist/NeverBounce.js"></script> -->
@endsection

