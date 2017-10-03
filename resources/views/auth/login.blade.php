@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row header-title-tabs clearfix">
        <div class="question-tab-links float-left">
            <div class="question-list-tabs">
                <ul class="tabs">
                    <li class="tabs-title is-active"><a href="login">login</a></li>
                    <li class="tabs-title"><a href="register">register</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row columns">
        <div class="text-center login-register-header">
            <p>Stack Overflow is part of the Stack Exchange network of 159 Q&A communities.</p>
        </div>
        <div class="small-12 medium-7 large-6 medium-centered columns">
            <form class="login-form" role="form" method="POST" action="{{ url('/login') }}">

                {{ csrf_field() }}

                <div class="row{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="email">E-Mail Address: </label>

                    <div class="small-12">
                        <input
                          id="email"
                          type="email"
                          name="email"
                          value="{{ old('email') }}"
                          autofocus
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
                    <label for="password">Password: </label>

                    <div class="small-12">
                        <input
                          id="password"
                          type="password"
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

                <div class="row" v-show="email && password">
                    <div class="small-12">
                        <label>
                            <input type="checkbox" name="remember"> Remember Me
                        </label>
                    </div>
                </div>

                <div class="row" v-show="email && password">
                    <div class="medium-8">
                        <button type="submit" class="button login-button">
                            Login
                        </button>

                        <a href="{{ url('/password/reset') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <div class="row auth-options">
            <div class="small-12 medium-7 large-6 medium-centered columns">
                <p>Don't have an account? <a href="register">Register</a></p>
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
                email: '',
                password: ''
            }
        });
    </script>
@endsection
