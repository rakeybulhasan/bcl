@extends('loginlayout')
@section('content')

                {{Form::open(array('url' => 'users/checklogin/','class'=>'login-form1'))}}
                    <h3 class="form-title">Login to your account</h3>
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        <span>Enter any username and password.</span>
                    </div>
                    <div class="form-group">
                        {{Form::label('email','Email',array('class' => 'control-label visible-ie8 visible-ie9'))}}
                        <div class="input-icon">
                        <i class="fa fa-user"></i>
                        {{Form::text('email',null, array('placeholder' => 'Email','class'=>'form-control placeholder-no-fix','id'=>'email'))}}
                        </div>
                    </div>
                    <div class="form-group">
                        {{Form::label('password','Password',array('class' => 'control-label visible-ie8 visible-ie9'))}}
                        <div class="input-icon">
                            <i class="fa fa-lock"></i>
                            {{Form::password('password', array('placeholder' => 'password','class'=>'form-control placeholder-no-fix','id'=>'password'))}}
                        </div>
                    </div>

                    <div class="form-actions">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" value="1"/> Remember me
                        </label>
                        {{Form::submit('Login',array('class'=>'btn green pull-right'))}}
                    </div>

                {{Form::close()}}

@stop