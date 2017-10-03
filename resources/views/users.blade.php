@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row header-title-tabs clearfix columns">
        <div class="header-title float-left">
            <h2>Users</h2>
        </div>
        <!--<div class="question-tab-links float-right">
            <div class="question-list-tabs">
                <ul class="tabs">
                    <li class="tabs-title is-active"><a href="#">interesting</a></li>
                    <li class="tabs-title"><a href="#">featured</a></li>
                    <li class="tabs-title"><a href="#">hot</a></li>
                    <li class="tabs-title"><a href="#">week</a></li>
                    <li class="tabs-title"><a href="#">month</a></li>
                </ul>
            </div>
        </div> [RCT]-->
    </div>

    <!--<div class="row container columns">
        <form>
            <div class="small-12">
                <label>Type to find tags:
                    <input class="tag-locator" type="text" name="">
                </label>
            </div>
        </form>
    </div> [RCT]-->

    <div class="users-list row columns">

        @foreach($allUsers->chunk(4) as $set)

            <div class="clearfix">

                @each('partials.user-item', $set, 'user')

            </div>

        @endforeach

    </div>
    <div class="row">
        <!-- pagination links -->
        <div class="users-pagination">
            {{ $allUsers->links() }}
        </div>
    </div>

@endsection