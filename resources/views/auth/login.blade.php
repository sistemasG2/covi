@extends('layouts.main')

@section('content')

<section>
  <v-card>
    <v-card-title>Iniciar Sesión</v-card-title>
    <v-divider></v-divider>
    <v-card-text>
      <form method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <v-text-field
          id="username"
          name="username"
          label="Usuario"
          value="{{ old('username') }}"
          prepend-icon="face"
          @if($errors->has('username'))
            error-messages="{{ $errors->first('username') }}"
          @endif
        ></v-text-field>
        <v-text-field
          id="password"
          name="password"
          label="Contraseña"
          value="{{ old('password') }}"
          prepend-icon="fa-key"
          type="password"
          @if($errors->has('username'))
            error-messages="{{ $errors->first('password') }}"
          @endif
        ></v-text-field>
        <div class="checkbox">
          <label>
              <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recordarme
          </label>
        </div>
        <v-btn type="submit" success>
          Iniciar sesion
          <v-icon class="ml-2">send</v-icon>
        </v-btn>
      </form>
    </v-card-text>
  </v-card>
</section>
<!--
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('username'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>-->
@endsection
