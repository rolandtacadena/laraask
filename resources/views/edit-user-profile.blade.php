@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row container">
        <div class="row header-title-tabs clearfix columns">
            <div class="question-tab-links float-left">
                <div class="question-list-tabs">
                    <ul class="tabs">
                        <li class="tabs-title">
                            <a href="{{ route('user-show', $user) }}">Profile</a>
                        </li>

                        @if($isLoggedIn)
                            @if($user->id == $authUser->id)
                                <li class="tabs-title is-active">
                                    <a href="{{ route('user-edit', $user) }}">Edit Profile</a>
                                </li>
                            @endif
                        @endif

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container row">
        <div class="small-2 columns">
            <div class="profile-pic-cont">
                <img
                    src="{{ asset('images/profile-pics/profile-pic.png') }}"
                    alt="{{ $user->name }}"
                >
            </div>
        </div>
        <div class="small-10 columns update-user">
            <h4>Edit user profile</h4>
            <form
              id="EditUserForm"
              method="POST"
              action="{{ route('user-update', $user->id) }}"
              class="{{ count($errors) > 0 ? 'hasError' : '' }}"
            >

                {!! method_field('patch') !!}
                {{ csrf_field() }}

                <div class="row">
                    <div class="small-12 columns">
                        <div class="input-holder">
                            <label>Name
                                <input name="name" value="{{ $user->name }}" type="text" placeholder="name">
                            </label>

                            @if ($errors->has('name'))
                                <span class="help-block">{{ $errors->first('name') }}</span><br>
                            @endif

                        </div>
                    </div>
                    <div class="small-12 columns">
                        <div class="input-holder">
                            <label>Title
                                <input
                                  name="title"
                                  value="{{ $user->title }}"
                                  type="text"
                                  placeholder="title"
                                >
                            </label>
                        </div>
                    </div>
                    <div class="small-12 columns">
                        <div class="input-holder">
                            <label>About Me
                                <textarea
                                  name="self_description"
                                  id=""
                                  cols="30"
                                  rows="10"
                                  placeholder="C++ programmer by trade. D & Ruby enthusiast."
                                >{{ $user->self_description }}</textarea>
                            </label>
                        </div>
                    </div>
                    <div class="small-12 columns">
                        <div class="input-holder">
                            <label>Address
                                <input
                                  name="address"
                                  value="{{ $user->address }}"
                                  type="text"
                                  placeholder="address"
                                >
                            </label>
                        </div>
                    </div>
                    <div class="small-12 columns">
                        <div class="input-holder">
                            <button class="button" type="submit">Update My Profile</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
