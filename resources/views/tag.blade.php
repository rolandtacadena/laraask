@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">

            <div class="row header-title-tabs clearfix columns">
                <div class="header-title float-left">
                    <h2>Questions tagged as <a href="{{ route('tag-show', $tag) }}">{{ $tag->name }}</a></h2>
                </div>
                <!--<div class="question-tab-links float-right">

                    {{--@include('partials.tabs.question-list-tabs')--}}

                </div> [RCT]-->
            </div>

            <div id="QuestionList" class="row container">

                @foreach($taggedQuestions as $question)

                    <div class="small-12 columns question">
                        <div class="row">
                            <div class="small-12 medium-6 large-3 columns">
                                <div class="row">
                                    <a href="{{ route('question-show', $question) }}">
                                        <div class="large-4 columns text-center count-container vote-count">
                                            <div class="row">
                                                <span
                                                  data-tooltip
                                                  aria-haspopup="true"
                                                  class="has-tip no-border top"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="{{ $question->votesCount() }} votes"
                                                >
                                                    <div class="small-12 columns counts">
                                                        <h3>{{ $question->votesCount() }}</h3>
                                                    </div>
                                                    <div class="small-12 columns">
                                                        <span class="count-label">{{ $question->votesCount() > 1 ? 'votes' : 'vote' }}</span>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="large-4 columns text-center count-container answer-count">
                                            <div class="row">
                                                <span
                                                  data-tooltip
                                                  aria-haspopup="true"
                                                  class="has-tip no-border top"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="{{ $question->answersCount() }} questions"
                                                >
                                                    <div class="small-12 columns counts">
                                                        <h3>{{ $question->answersCount() }}</h3>
                                                    </div>
                                                    <div class="small-12 columns">
                                                        <span class="count-label">{{ $question->answersCount() > 1 ? 'answers' : 'answer' }}</span>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="large-4 columns text-center count-container view-count">
                                            <div class="row">
                                                <span
                                                  data-tooltip
                                                  aria-haspopup="true"
                                                  class="has-tip no-border top"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="3M views"
                                                >
                                                    <div class="small-12 columns counts">
                                                        <h3>3</h3>
                                                    </div>
                                                    <div class="small-12 columns">
                                                        <span class="count-label">views</span>
                                                    </div>
                                                </span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="small-12 medium-6 large-9 columns">
                                <div class="row">
                                    <div class="large-12 columns">
                                        <a class="question-title" href="{{ route('question-show', $question) }}">
                                            {{ $question->title }}
                                        </a>
                                    </div>
                                    <div class="large-12 columns">
                                        <div class="tags">

                                            @foreach($question->tags as $questionTag)

                                                <span class="label {{ $tag->id == $questionTag->id ? 'same-with-selected-tag' : ''}}">
                                                   <span data-tooltip aria-haspopup="true" class="has-tip no-border bottom" data-click-open="false" data-disable-hover="false" tabindex="2" title="{{ $tag->questionsCount() }} questions for this tag.">
                                                          <a href="{{ route('tag-show', $questionTag->id) }}">{{ $questionTag->name }}</a>
                                                    </span>
                                                </span>

                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @endforeach

            </div>
            <div class="row">
                <div class="questions-pagination">
                    {{ $taggedQuestions->links() }}
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

            <!--<div class="row">
                <div class="small-12 header-title columns">
                    <h2>Related Tags</h2>
                </div>
                <div class="large-12 columns">
	                <div class="tags">
	                	<div class="tag-holder">
	                    	<span class="label"><a href="">PHP</a></span><span class="multiplier-count"> x 123</span>
	                	</div>
	                    <div class="tag-holder">
	                    	<span class="label"><a href="">laravel</a></span><span class="multiplier-count"> x 123</span>
	                	</div>
	                	<div class="tag-holder">
	                    	<span class="label"><a href="">angularjs</a></span><span class="multiplier-count"> x 123</span>
	                	</div>
	                	<div class="tag-holder">
	                    	<span class="label"><a href="">mongodb</a></span><span class="multiplier-count"> x 123</span>
	                	</div>
	                	<div class="tag-holder">
	                    	<span class="label"><a href="">PHP</a></span><span class="multiplier-count"> x 123</span>
	                	</div>
	                </div>
            	</div>
            </div> [RCT]-->
        </div>
    </div>

@endsection
