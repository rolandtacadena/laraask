@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">

            <div class="row header-title-tabs clearfix columns">
                <div class="header-title float-left">
                    <h5>All questions related to: </h5>
                    <h2><a href="{{ route('question-show', $question) }}">{{ $question->title }}</a></h2>
                </div>
            </div>

            <div id="QuestionList" class="row container">
                @each('partials.question-item', $relatedQuestions, 'question')
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
