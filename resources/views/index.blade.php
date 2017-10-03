@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">
            <div class="row header-title-tabs clearfix columns">
                <div class="header-title float-left">
                    <h2>Top Questions</h2>
                </div>
                <div class="question-tab-links float-right">
                    @include('partials.tabs.question-list-tabs')
                </div>
            </div>
            <div id="QuestionList" class="row container">

                @each('partials.question-item', $questions, 'question')

            </div>
            <div class="row">
                <!-- pagination links -->
                <div class="questions-pagination">
                    {{ $questions->links() }}
                </div>
            </div>
        </div>

        <div id="Sidebar" class="small-12 medium-4 large-3 columns">
            <div class="row">
                <div class="small-12 header-title columns">
                    @include('partials.user-favorite-tags')
                </div>
            </div>
        </div>
    </div>

    @include('partials.user-ops')

@endsection
