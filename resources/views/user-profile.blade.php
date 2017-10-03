@extends('layouts.main')

@section('page-content')

    <!--page header links-->
    @include('partials.page-header-links')

    <div class="row container">
        <div class="row header-title-tabs clearfix columns">
            <div class="question-tab-links float-left">
                <div class="question-list-tabs">
                    <ul class="tabs">
                        <li class="tabs-title is-active"><a href="{{ route('user-show', $user) }}">Profile</a></li>

                        @if($isLoggedIn)
                            @if($user->id == $authUser->id)
                                <li class="tabs-title"><a href="{{ route('user-edit', $user) }}">Edit Profile</a></li>
                            @endif
                        @endif

                    </ul>
                </div>
            </div>
            <div class="header-title float-right">
                <h2>{{ $user->name }}</h2>
            </div>
        </div>
        <div class="container row">
            <div class="small-2 columns">
                <div class="profile-pic-cont">
                    <img
                    src="{{ asset('images/profile-pics/profile-pic.png') }}"
                    alt="{{ $user->name }}">
                </div>
            </div>
            <div class="small-7 columns">
                <div class="profile-detail">
                    <h3 class="name">{{ $user->name }}</h3>
                    <h4>{{ $user->title }}</h4>
                    <p class="self-description">{{ $user->self_description }}</p>

                    @if($isLoggedIn)
                        @if($user->id == $authUser->id)
                            <a href="{{ route('user-edit', $user) }}">Click here to edit your profile</a>
                        @endif
                    @endif

                </div>
            </div>
            <div class="small-3 columns">
                <div class="user-stats">
                    <div class="row">
                        <div class="small-6 columns">
                            <p class="answers-count">{{ $user->answersCount() }}</p>
                            <p class="label">answers</p>
                        </div>
                        <div class="small-6 columns">
                            <p class="questions-count">{{ $user->questionsCount() }}</p>
                            <p class="label">questions</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="other-details">
                            <ul>
                                <li>{{ $user->address }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="summary">
            <div class="row">
                <div class="user-questions small-6 columns">
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>Questions
                                <span class="count">({{ $user->questionsCount() }})</span>
                            </h2>
                        </div>
                    </div>
                    <div class="container">

                        @if($user->hasQuestions())

                            <div class="user-questions-list row">
                                <ul>

                                    @foreach($user->questions as $question)
                                        <li class="question-item">
                                            <p>
                                                <span class="mini-count {{ $question->hasAcceptedAnswerAlready() ? 'answered' : '' }}">
                                                    {{ $question->votesCount() }}
                                                </span>
                                                <a href="{{ route('question-show', $question) }}">
                                                    {{ str_limit($question->title, 60) }}
                                                </a>
                                            </p>
                                        </li>

                                    @endforeach

                                </ul>
                            </div>

                        @else
                            @if($isLoggedIn)
                                @if($user->id == $authUser->id)
                                    <p>You have no questions yet.
                                    <a href="{{ route('ask-question') }}">Ask question</a> now.</p>
                                @else
                                    <p>No questions.</p>
                                @endif
                            @else
                                <p>No questions.</p>
                            @endif
                        @endif

                    </div>
                </div>
                <div class="user-answers small-6 columns">
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>Answers
                                <span class="count">({{ $user->answersCount() }})</span>
                            </h2>
                        </div>
                    </div>
                    <div class="container">

                        @if($user->hasAnswers())

                            <div class="user-answers-list row">
                                <ul>

                                    @foreach($user->answers as $answer)

                                        <li class="answer-item">
                                            <p>
                                                <span class="mini-count {{ $answer->question->hasAcceptedAnswerAlready() ? 'answered' : '' }}">
                                                    {{ $answer->votesCount() }}
                                                </span>
                                                <a href="{{ route('question-show', $answer->question->id) }}">
                                                    {{ str_limit($answer->question->title, 60) }}
                                                </a>
                                            </p>
                                        </li>

                                    @endforeach

                                </ul>
                            </div>

                        @else
                            @if($isLoggedIn)
                                @if($user->id == $authUser->id)
                                    <p>You have no answers yet. Start <a href="{{ route('all-questions') }}">answering questions</a>.</p>
                                @else
                                    <p>No answers.</p>
                                @endif
                            @else
                                <p>No answers.</p>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="user-tags small-6 columns">
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>Tags <span class="count">({{ $user->usedTagsCount() }})</span></h2>
                        </div>
                    </div>
                    <div class="container">

                        @if($user->hasUsedTags())

                            <div class="user-tags-list row">

                                @foreach($user->usedTags() as $tag)

                                    <div class="small-6 columns">
                                        <div class="tag-holder tags">
                                            <span
                                            data-tooltip aria-haspopup="true"
                                            class="has-tip no-border bottom"
                                            data-click-open="false"
                                            data-disable-hover="false"
                                            tabindex="2"
                                            title="{{ $tag->questionsCountByUser($user->id) }} questions for this tag"
                                        >
                                                <span class="label"><a href="{{ route('question-tag-user', [$tag, $user]) }}">{{ $tag->name }}</a></span>
                                                <span class="multiplier-count">x <a href="{{ route('tag-show', $tag) }}">{{ $tag->questionsCountByUser($user->id) }}</a></span>
                                            </span>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

                        @else
                            @if($isLoggedIn)
                                @if($user->id == $authUser->id)
                                    <p>You have no used tags.</p>
                                @else
                                    <p>Start visiting these <a href="{{ route('tags') }}">tags</a>.</p>
                                @endif
                            @else
                                <p>Start visiting these <a href="{{ route('tags') }}">tags</a>.</p>
                            @endif

                        @endif


                    </div>
                </div>
                <div class="user-favs small-6 columns">
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>Favorites
                                <span class="count">({{ $user->favoriteQuestionsCount() }})</span>
                            </h2>
                        </div>
                    </div>
                    <div class="container">

                        @if($user->hasFavorites())

                            <div class="user-favs-list row">
                                <ul>

                                    @foreach($user->favoriteQuestions as $question)

                                        <li class="fav-item">
                                            <p>
                                                <i class="fi-star mini-count">{{ $question->countUserHasFavoriteOn() }}</i>
                                                <a href="{{ route('question-show', $question) }}">
                                                    {{ str_limit($question->title, 50) }}
                                                </a>
                                            </p>
                                        </li>

                                    @endforeach

                                </ul>
                            </div>

                        @else

                            @if($isLoggedIn)
                                @if($user->id == $authUser->id)
                                    <p>No favorites yet. See all <a href="{{ route('all-questions') }}">questions</a>.</p>
                                @else
                                    <p>No favorites.</p>
                                @endif
                            @else
                                <p>No favorites.</p>
                            @endif

                        @endif

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="user-votes small-6 columns">
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>Votes <span class="count">({{ $user->votesCount() }})</span></h2>
                        </div>
                    </div>
                    <div class="container">

                        @if($user->hasVotes())

                                <div class="user-votes-list row columns">
                                    <p>Questions and Answers votes Total (upvotes and downvotes)</p>
                                    <p><span class="vote-count">{{ $user->upVotedPostsCount() }}</span>up</p>
                                    <p><span class="vote-count">{{ $user->downVotedPostsCount() }}</span>down</p>
                                    <hr>
                                    <p>Upvotes Total</p>
                                    <p><span class="vote-count">{{ $user->upVotedPostFor('Question')->count() }}</span>questions</p>
                                    <p><span class="vote-count">{{ $user->upVotedPostFor('Answer')->count() }}</span>answers</p>
                                    <hr>
                                    <p>Downvotes Total</p>
                                    <p><span class="vote-count">{{ $user->downVotedPostFor('Question')->count() }}</span>questions</p>
                                    <p><span class="vote-count">{{ $user->downVotedPostFor('Answer')->count() }}</span>answers</p>
                                    <hr>
                                </div>

                        @else
                            @if($isLoggedIn)
                                @if($user->id == $authUser->id)
                                    <p>No casted votes yet. See all <a href="{{ route('all-questions') }}">questions</a>
                                        and start voting.</p>
                                @else
                                    <p>No casted votes.</p>
                                @endif
                            @else
                                <p>No casted votes.</p>
                            @endif
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection