@extends('user.layout.layout')

@section('content')
    <!-- page title style6 START -->
<section class="page-title style2 " data-path="{{asset('img/headers/header4.jpg')}}">
	<div class="middle-align">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="strong text-uppercase">Profile</h1>
				</div>
			</div>
		</div>
	</div>
	<a href="#content" class="arrow bounce" title="Scroll Down"><i class="fa fa-angle-down"></i></a>
</section>
<!-- page title style6 END -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="header">
                                
                            </div>
                            <div class="content">
                                {{Form::model($user,['url'=>"profile/edit"])}}
                        {{ csrf_field() }}
                        <div id="accordion">
                            @foreach($formInputs as $key=>$val)
                               <h3 style="background-color:#333;padding:5px 5px 5px 5px; color:white;" class="container-fluid">{{$key}}</h3>
                                    <div>
                                        @foreach($val as $input)
                                        <div class="form-group{{ $errors->has($input) ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ucwords(str_replace('_',' ',$input))}}</label>
                                        @if($input == 'password' || $input == 'password_confirm')
                                        
                                            <div class="form-group form-group-md">

                                                {{Form::password($input,['class'=>'form-control','required'])}}
                                            </div>
                                        @elseif($input == 'category')
                                        
                                            <select  multiple ="true" class="form-control chzn-select" id="combobox" name="category[]"  required>
                                                    <option></option>
                                                    {{$categories->display()}}
                                            </select>

                                        @elseif($input == 'state')
                                            <select   class="form-control chzn-select" id="state" name="state" 
                                                onchange = "changeVicinitySelect(this)"
                                                
                                                required>
                                                <option></option>
                                                @foreach ($states as $state)
                                                <option value = "{{$state->state}}"
                                                    data-id = "{{$state->id}}"
                                                    <?php if($user->state == $state->state) echo 'selected';?>
                                                >{{$state->state}}</option>
                                                @endforeach
                                            </select>

                                    @elseif($input == 'vicinity_id')
                                        <select   class="form-control" id="vicinity" name="vicinity_id">
                                                <option></option>
                                                @foreach ($vicinities as $vicinity)
                                                <option value = "{{$vicinity->id}}"
                                                    data-state-id = "{{$vicinity->state_id}}"
                                                     class="vicinities"
                                                    <?php if($user->vicinity_id == $vicinity->id) echo 'selected';?>
                                                >{{$vicinity->name}}</option>
                                                @endforeach
                                            </select>

                                    @elseif ($input == 'description')
                                        {{Form::textarea($input,$user->$input,['class'=>'form-control'])}}

                                    @elseif($input == 'email')
                                        <div class="form-group form-group-md">
                                            {{Form::email($input,$user->email,['class'=>'form-control','required'])}}
                                        </div>
                                    @else
                                        <div class="form-group form-group-md">
                                            {{Form::text($input,$user->$input,['class'=>'form-control'])}}
                                        </div>
                                    @endif
                                    @if ($errors->has($input))
                                        <span class="help-block">
                                            <strong>{{ $errors->first($input) }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @endforeach
                            </div>
                            @endforeach
                        </div><!-- Accordion-->
                     <div class="form-group form-group-md">
                        {{Form::submit('Update Profile',['class'=>'btn btn-primary'])}}
                    </div>
                {{Form::close()}}

                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="margin-top:10px;">
                        <div class="card card-user">
                            <div class="image">
                                <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="..."/>
                            </div>
                            <div class="content">
                                <div class="author">
                                     <a href="#">
                                    <img class="avatar border-gray" src="{{asset('assets/img/faces/face-3.jpg')}}" alt="..."/>

                                      <h4 class="title">{{Auth::user()->first_name}}<br />
                                         <small>{{Auth::user()->name}}</small>
                                      </h4>
                                    </a>
                                </div>
                                <p class="description text-center"> "{{ implode(',',$user->categories->pluck('name')->all())}}"
                                </p>
                            </div>
                            <hr>
                            <div class="text-center">
                                <!--<button href="#" class="btn btn-simple"><i class="fa fa-facebook-square"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-twitter"></i></button>
                                <button href="#" class="btn btn-simple"><i class="fa fa-google-plus-square"></i></button>-->

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
@stop
