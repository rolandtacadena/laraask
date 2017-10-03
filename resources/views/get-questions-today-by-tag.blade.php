@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">
            <div class="row header-title-tabs clearfix columns">
                <div class="header-title float-left">
                    <h2>Questions asked today tagged as <a href="{{ route('tag-show', $tag) }}">{{ $tag->name }}</a></h2>
                </div>
                <div class="question-tab-links float-right">
                    @include('partials.tabs.question-list-tabs')
                </div>
            </div>
            <div id="QuestionList" class="row container">

                @if($tag->countQuestionsAskedToday() > 0)
                    @each('partials.question-item', $questions, 'question')
                @else
                    <p>No results. See all questions <a href="{{ route('all-questions') }}">here</a></p>
                @endif

            </div>
            <div class="row">
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
