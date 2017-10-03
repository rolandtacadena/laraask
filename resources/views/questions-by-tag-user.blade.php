@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">

            <div class="row header-title-tabs clearfix columns">
                <div class="header-title float-left">
                    <h2>
                        <a href="{{ route('user-show', $user) }}">{{ $user->name }}</a>'s
                        questions tagged as <a href="{{ route('tag-show', $tag) }}">{{ $tag->name }}</a>
                    </h2>
                </div>
                <div class="question-tab-links float-right">
                    @include('partials.tabs.question-list-tabs')
                </div>
            </div>

            <div id="QuestionList" class="row container">

                @each('partials.question-item', $questions, 'question')

            </div>
            <div class="row">
                <div class="questions-pagination">

                    {{ $questions->links() }}

                </div>
            </div>
        </div>

        <div id="Sidebar" class="small-12 medium-4 large-3 columns">

            <div class="row tag-extra-details container">
                <div class="small-12 columns">
                    <h4 class="tag-num-questions">{{ $tag->questionsCount() }}</h4>
                    <p class="tag-num-questions-label">questions tagged</p>
                    <div class="tags selected-tag">
					<span class="label">
						<a href="{{ route('tag-show', $tag) }}">{{ $tag->name }}</a>
					</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="small-12 header-title columns">
                    @include('partials.user-favorite-tags')
                </div>
            </div>

        </div>
    </div>

@endsection
