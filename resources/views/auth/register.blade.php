@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row header-title-tabs clearfix">
        <div class="question-tab-links float-left">
            <div class="question-list-tabs">
                <ul class="tabs">
                    <li class="tabs-title"><a href="login">login</a></li>
                    <li class="tabs-title is-active"><a href="register">register</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row columns">
        <div class="text-center login-register-header">
            <p>Stack Overflow is part of the Stack Exchange network of 159 Q&A communities.</p>
        </div>
        <div class="small-12 medium-7 large-6 medium-centered columns">
            <form class="register-form" role="form" method="POST" action="{{ url('/register') }}">

                {{ csrf_field() }}

                <div class="row{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name:</label>

                    <div class="small-12">
                        <input
                          id="name"
                          type="text"
                          class="form-control"
                          name="name"
                          value="{{ old('name') }}"
                          autofocus
                          required
                          v-model="name"
                        >

                        @if ($errors->has('name'))

                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>

                        @endif

                    </div>
                </div>

                <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address:</label>

                    <div class="small-12">
                        <input
                          id="email"
                          type="email"
                          class="form-control"
                          name="email"
                          value="{{ old('email') }}"
                          required
                          v-model="email"
                        >

                        @if ($errors->has('email'))

                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>

                        @endif
                    </div>
                </div>

                <div class="row{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label for="password">Password:</label>

                    <div class="small-12">
                        <input
                          id="password"
                          type="password"
                          class="form-control"
                          name="password"
                          required
                          v-model="password"
                        >

                        @if ($errors->has('password'))

                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>

                        @endif

                    </div>
                </div>

                <div class="row{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <label for="password-confirm">Confirm Password</label>

                    <div class="small-12">
                        <input
                          id="password-confirm"
                          type="password"
                          class="form-control"
                          name="password_confirmation"
                          required
                          v-model="password_confirmation"
                        >

                        @if ($errors->has('password_confirmation'))

                            <span class="help-block">
                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                            </span>

                        @endif

                    </div>
                </div>

                <!-- display the register button once the name, email, password and password_confirmation are not empty -->
                <div class="row" v-show="name && email && password && password_confirmation">
                    <div class="small-12 col-md-offset-4">
                        <button type="submit" class="button register-button">
                            Register
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="row auth-options">
            <div class="small-12 medium-7 large-6 medium-centered columns">
                <p>Already have an account? <a href="login">Log in</a></p>
            </div>
        </div>
    </div>

@endsection

@section('page-scripts')
    <script src="{{ asset('js/vendor/vue.js') }}"></script>
    <script>
        new Vue({
            el: 'body',
            data: {
              name: '',
              email: '',
              password: '',
              password_confirmation: ''
            }
        });
    </script>
@endsection
