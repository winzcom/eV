@extends('user.layout.layout')

@section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                        <div class="">
                            <div class="header">
                                <h4 class="title">Edit Profile</h4>
                            </div>
                            <div class="content">
                                {{Form::model($user,['url'=>"profile/edit"])}}
                        {{ csrf_field() }}
                        <div id="accordion">
                            @foreach($formInputs as $key=>$val)
                               <h3  class="container-fluid">{{$key}}</h3>
                                    <div>
                                        @foreach($val as $input)
                                        <div class="form-group{{ $errors->has($input) ? ' has-error' : '' }}">
                                        <label for="name" class="col-md-4 control-label">{{ucwords(str_replace('_',' ',$input))}}</label>
                                        @if($input == 'password' || $input == 'password_confirm')
                                        
                                            <div class="form-group form-group-md">

                                                {{Form::password($input,['class'=>'form-control','required'])}}
                                            </div>
                                        @elseif($input == 'category')
                                        
                                            <select  multiple ="true" class="form-control" id="combobox" name="category[]"  required>
                                                    <option></option>
                                                    @foreach ($categories as $cate)
                                                        <option value = "{{$cate->id}}" <?php 
                                                            if($user->categories->contains($cate->id))
                                                            echo 'selected'
                                                        ?>>
                                                            {{$cate->name}}
                                                        </option>
                                                    @endforeach
                                            </select>

                                        @elseif($input == 'state')
                                            <select   class="form-control " id="state" name="state" 
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

                </div>
            </div>
        </div>
@stop


