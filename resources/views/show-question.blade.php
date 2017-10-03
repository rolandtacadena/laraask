@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row container">
        <div id="QuestionsTab" class="small-12 medium-8 large-9 columns">
            <div class="row">
                <div class="small-12 question-header columns">
                    <h1>{{ $question->title }}</h1>
                </div>
                <div class="row container columns">
                    <div class="container small-1 medium-1 large-1 columns vote-action text-center">
                        <div class="row">
                            <a class="question-upvote">
                                <span
                                  data-tooltip
                                  aria-haspopup="true"
                                  class="has-tip no-border top"
                                  data-click-open="false"
                                  data-disable-hover="false"
                                  tabindex="2"
                                  title="This question is useful."
                                >
                                    <i v-on:click="vote('up', 'Question', {{ $question->id }})" class="fi-arrow-up size-36"></i>
                                </span>
                            </a>
                        </div>
                        <div class="row">
                            <span id="voteCountForQuestion{{ $question->id }}" class="question-vote-count">{{ $question->votesCount() }}</span>
                        </div>
                        <div class="row">
                            <a class="question-downvote">
                                <span
                                  data-tooltip
                                  aria-haspopup="true"
                                  class="has-tip no-border bottom"
                                  data-click-open="false"
                                  data-disable-hover="false"
                                  tabindex="2"
                                  title="This question is not useful."
                                >
                                    <i v-on:click="vote('down', 'Question', {{ $question->id }})" class="fi-arrow-down size-36"></i>
                                </span>
                            </a>
                        </div>
                        <div class="row">
                            <a class="question-star">

                                @if($authUser)

                                  <span
                                    data-tooltip
                                    aria-haspopup="true"
                                    class="has-tip no-border top"
                                    data-click-open="false"
                                    data-disable-hover="false"
                                    tabindex="2"
                                    title="Make this question as favorite. (Click toggle to undo)"
                                  >
                                      <i v-on:click="makeFavorite({{ $question->id }})" class="fi-star size-36 {{ $question->isFavoredByUser($authUser->id) ? 'is-favorite' : ''}}"></i>
                                  </span>

                                @else

                                  <i v-on:click="makeFavorite({{ $question->id }})" class="fi-star size-36"></i>

                                @endif

                                <span class="question-favor-count">{{ $question->countUserHasFavoriteOn() }}</span>
                            </a>
                        </div>
                    </div>
                    <div class="container small-11 medium-11 large-11 question-details-wrap columns">
                        <div class="row columns">
                            <div class="small-12 question-desc columns">
                                <p>{{ nl2br($question->description) }}</p>
                            </div>
                            <div class="small-12 tagged-as columns">
                                <div class="tags">

                                    @each('partials.tag-label', $question->tags, 'tag')

                                </div>
                            </div>

                            <div class="row columns">
                                {{--<div class="question-action small-9 columns">--}}
                                    {{--<a href="">share</a>--}}
                                    {{--<a href="">edit</a>--}}
                                    {{--<a href="">flag</a>--}}
                                {{--</div> --}}
                                <div class="small-3 columns asker float-right">
                                    <div class="question-date-asked">
                                        <span
                                          data-tooltip
                                          aria-haspopup="true"
                                          class="has-tip no-border top"
                                          data-click-open="false"
                                          data-disable-hover="false"
                                          tabindex="2"
                                          title="{{ $question->created_at }}"
                                        >
                                            {{ $question->created_at->toDayDateTimeString() }}
                                        </span>
                                    </div>
                                    <div class="row">
                                        <div class="small-3 columns">
                                            <img src="{{ asset('images/profile-pics/1.jpg') }}">
                                        </div>
                                        <div class="small-9 columns">
                                            <div class="row">
                                                <div class="small-12">
                                                    <a href="{{ route('user-show', $question->user) }}" class="asker-name">
                                                        {{ $question->user->name }}
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="small-1 columns comment-indentor"></div>
                                <div id="commentForQuestion{{ $question->id }}" class="small-11 columns comment-list">

                                    @foreach($question->comments as $comment)

                                        <div class="comment">
                                            <div class="row">
                                                <div class="small-1 columns comment-votes">
                                                    <div class="row">
                                                        <div class="float-left">{{ $comment->votesCount() }}</div>
                                                    </div>
                                                </div>
                                                <div class="small-11 columns">
                                                    <span class="comment-text">
                                                        <p> {{ $comment->body }} -
                                                            <a href="{{ route('user-show', $comment->user) }}" class="commenter-name">
                                                                {{ $comment->user->name }}
                                                            </a>
                                                            <span class="comment-time-elapsed">
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </span>
                                                        </p>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach

                                </div>
                            </div>
                            <div class="row">
                                <div class="comment-answer">
                                    <span
                                      data-tooltip
                                      aria-haspopup="true"
                                      class="has-tip no-border right"
                                      data-disable-hover="false"
                                      tabindex="3"
                                      title="Add comment. Make your comment useful."
                                    >
                                        <a v-on:click="showCommentForm">add a comment</a>
                                    </span>
                                    <form v-on:submit="onCommentSubmit" class="comment-form hidden">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="modelName" value="Question">
                                        <input type="hidden" name="modelId" value="{{ $question->id }}">
                                        <div class="row">
                                            <div class="large-9 columns">
                                                <textarea id="commentText" name="comment" cols="10" rows="5" autofocus></textarea>
                                            </div>
                                            <div class="large-3 columns padding-zeroed">
                                                <button class="button comment-button" type="submit">Add Comment</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row header-title-tabs clearfix columns">
                        <div class="header-title float-left">
                            <h2>{{ $question->answersCount() }} {{ $question->answersCount() > 1 ? 'Answers' : 'Answer' }}</h2>
                        </div>
                    </div>

                    <div class="container">

                        @foreach($question->answers as $answer)

                            <div class="row answer-wrapper">
                                <div class="small-1 medium-1 large-1 columns vote-action text-center">
                                    <div class="row">
                                        <a class="answer-upvote">
                                            <span
                                              data-tooltip
                                              aria-haspopup="true"
                                              class="has-tip no-border top"
                                              data-click-open="false"
                                              data-disable-hover="false"
                                              tabindex="2"
                                              title="This answer is useful."
                                            >
                                                <i v-on:click="vote('up', 'Answer', {{ $answer->id }})" class="fi-arrow-up size-36"></i>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="row">
                                        <span id="voteCountForAnswer{{ $answer->id }}" class="answer-vote-count">{{ $answer->votesCount() }}</span>
                                    </div>
                                    <div class="row">
                                        <a class="answer-downvote">
                                            <span
                                              data-tooltip
                                              aria-haspopup="true"
                                              class="has-tip no-border bottom"
                                              data-click-open="false"
                                              data-disable-hover="false"
                                              tabindex="2"
                                              title="This answer is not useful."
                                            >
                                                <i v-on:click="vote('down', 'Answer', {{ $answer->id }})" class="fi-arrow-down size-36"></i>
                                            </span>
                                        </a>
                                    </div>

                                    @if($authUser && $authUser->ownsQuestion($question->id))

                                        <div class="row">
                                            <a class="answer-accept">
                                                <span
                                                  data-tooltip
                                                  aria-haspopup="true"
                                                  class="has-tip no-border top"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="Click to toggle acceptance of the answer."
                                                >
                                                    <i v-on:click="acceptAnswer({{ $answer->id }}, $event)" class="fi-check accept-answer size-36 {{ $question->acceptedAnswerIs($answer->id) ? 'accepted-answer' : '' }}"></i>
                                                </span>
                                            </a>
                                        </div>

                                    @endif

                                </div>
                                <div class="small-11 medium-11 large-11 answer-details-wrap columns">
                                    <div class="row">
                                        <div class="small-12 answer-desc columns">
                                            <p>{{ $answer->answer }}</p>
                                        </div>
                                    </div>
                                    <div class="row columns">
                                        <!--<div class="small-9 columns question-action">
                                            <a href="">share</a>
                                            <a href="">edit</a>
                                            <a href="">flag</a>
                                        </div> [RCT]-->
                                        <div class="small-3 columns asker float-right">
                                            <div class="question-date-answered">
                                                <span
                                                  data-tooltip
                                                  aria-haspopup="true"
                                                  class="has-tip no-border top"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="{{ $answer->created_at }}"
                                                >
                                                    {{ $answer->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            <div class="row">
                                                <div class="small-3 columns">
                                                    <img src="{{ asset('images/profile-pics/1.jpg') }}">
                                                </div>
                                                <div class="small-9 columns">
                                                    <div class="row">
                                                        <div class="small-12">
                                                            <a href="{{ route('user-show', $answer->user) }}" class="asker-name">
                                                                {{ $answer->user->name }}
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div id="commentForAnswer{{ $answer->id }}" class="small-12 comment-list">

                                            @foreach($answer->comments as $comment)

                                                <div class="comment">
                                                    <div class="row">
                                                        <div class="small-1 columns comment-votes">
                                                            <div class="row">
                                                                <div class="float-left">{{ $comment->votesCount() }}</div>
                                                            </div>
                                                        </div>
                                                        <div class="small-11 columns">
                                                    <span class="comment-text">
                                                        <p> {{ $comment->body }} -
                                                            <a
                                                                href="{{ route('user-show', $comment->user) }}"
                                                                class="commenter-name"
                                                            >
                                                                {{ $comment->user->name }}
                                                            </a>
                                                            <span class="comment-time-elapsed">
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </span>
                                                        </p>
                                                    </span>
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="comment-answer">
                                            <span
                                              data-tooltip
                                              aria-haspopup="true"
                                              class="has-tip no-border right"
                                              data-disable-hover="false"
                                              tabindex="3" title="Add comment. Make your comment useful."
                                            >
                                                <a v-on:click="showCommentForm">add a comment</a>
                                            </span>
                                            <form v-on:submit.prevent="onCommentSubmit" class="comment-form hidden">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="modelName" value="Answer">
                                                <input type="hidden" name="modelId" value="{{ $answer->id }}">
                                                <div class="row">
                                                    <div class="large-9 columns">
                                                        <textarea id="commentText" name="comment" cols="10" rows="5" autofocus></textarea>
                                                    </div>
                                                    <div class="large-3 columns padding-zeroed">
                                                        <button class="button comment-button" type="submit">Add Comment</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </div>

                    <!--<div class="row">
                        <div class="comment-share">
                            <p>
                                Know someone who can answer? Share a link to this <a href="{{ route('question-show', $question) }}">question</a>
                                via <a href="">email</a>, <a href="">Google</a>+,
                                <a href="">Twitter</a>, or <a href="">Facebook</a>.
                            </p>
                        </div>
                    </div> [RCT]-->

                    @if(!$authUser)

                        <div class="row">
                            <div class="must-logged-in-before-post">
                                <p>
                                    In order to post your answer,
                                    you must be <a href="/login">logged in</a>
                                    or if no account yet please <a href="/register">sign up</a>.
                                </p>
                            </div>
                        </div>

                    @else

                        @include('partials.forms.answer-question')

                    @endif

                    <div class="row">
                        <div class="suggestions">
                            <p>Browse other questions tagged as
                                <div class="tags">

                                    @foreach($question->tags as $tag)

                                        <span class="label">
                                                <span
                                                  data-tooltip aria-haspopup="true"
                                                  class="has-tip no-border bottom"
                                                  data-click-open="false"
                                                  data-disable-hover="false"
                                                  tabindex="2"
                                                  title="{{ $tag->questionsCount() }} questions for this tag."
                                                >
                                                      <a href="{{ route('tag-show', $tag->id) }}">{{ $tag->name }}</a>
                                                </span>
                                            </span>

                                    @endforeach

                                </div> or
                                <a href="{{ route('ask-question') }}">ask your own question</a>.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="Sidebar" class="small-12 medium-4 large-3 columns">
            <div class="row question-extra-details container">
                <div class="small-12 columns">
                    <div class="row">
                        <div class="small-3 columns question-extra-details-label">asked</div>
                        <div class="small-9 columns">{{ $question->created_at->diffForHumans() }}</div>
                    </div>
                </div>
                <!--<div class="small-12 columns">
                    <div class="row">
                        <div class="small-3 columns question-extra-details-label">viewed</div>
                        <div class="small-9 columns">2000 times</div>
                    </div>
                </div> [RCT]-->
                <div class="small-12 columns">
                    <div class="row">
                        <div class="small-3 columns question-extra-details-label">active</div>
                        <div class="small-9 columns">{{ $question->lastActiveDate() }}</div>
                    </div>
                </div>
            </div>
            
            @if( $question->relatedQuestions()->count() > 0 )
                <div class="row related-questions columns">
                    <div class="small-12 header-title columns">
                        <h2>Related Questions</h2>
                        <ul>
                            @foreach( $question->relatedQuestions()->take(10) as $relatedQuestion )
                                <li><a href="{{ route('question-show', $relatedQuestion->id) }}">
                                    <span
                                        data-tooltip
                                        aria-haspopup="true"
                                        class="mini-count has-tip no-border top {{ $relatedQuestion->hasAcceptedAnswerAlready() ? 'answered' : '' }}"
                                        data-click-open="false"
                                        data-disable-hover="false"
                                        tabindex="2"
                                        title="votes count"
                                    >
                                        {{ $relatedQuestion->votesCount() }}
                                    </span>
                                        {{ str_limit($relatedQuestion->title, 120) }}
                                    </a></li>
                            @endforeach
                        </ul>
                        <a class="show-all-related" href="{{ route('related-questions', $question) }}">
                            Show all related questions ({{ $question->relatedQuestions()->count() }})
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    @include('modals.mustLoggedInModal')

@endsection

@section('page-scripts')
    <script src="{{ asset('js/vendor/vue.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        new Vue({

            el: 'body',

            data: {
                isLoggedIn: false,
                answer: ''
            },

            created() {
                this.checkIfLoogedIn();
            },

            methods: {

                checkIfLoogedIn() {
                    axios.get('/ajax/check-if-authenticated')
                    .then(response => this.isLoggedIn = response.data)
                    .catch(error => console.log(error));
                },

                vote: function (action, model, modelValue) {
                    if(this.isLoggedIn) {
                        axios.get('/ajax/vote/' + action + '/' + model + '/' + modelValue)
                        .then(function(response) {
                            var voteCountEl = $('#voteCountFor' + model + modelValue);
                            voteCountEl.html(response.data.voteCount);
                            console.log(response.data)
                        })
                        .catch(function(error) {
                            console.log(error)
                        });

                    } else {
                        this.showLoginModal();
                    }

                },

                showCommentForm: function (event) {

                    if(this.isLoggedIn) {
                        $(event.target).closest('.comment-answer').find('.comment-form').slideToggle('slow');
                    } else {
                        this.showLoginModal();
                    }
                },

                onCommentSubmit: function (event) {

                    event.preventDefault();

                    var form = $(event.target.closest('form'));
                    var data = {
                        'commentText': form.find('#commentText').val(),
                        '_token': form.find('input[name="_token"]').val(),
                        'modelName': form.find('input[name="modelName"]').val(),
                        'modelId': form.find('input[name="modelId"]').val(),
                    };

                    this.postComment(data);

                    // clear and hide the form after comment submit
                    form.find('textarea').val('');
                    form.slideUp();
                },

                postComment: function (data) {
                    axios.post('/ajax/comment', { data })
                    .then(response =>
                        this.postSuccess(response.data)
                    ).catch(error =>
                        this.postError(error)
                    );
                },

                postSuccess: function (data) {
                    this.displayCommentData(data)

                },

                postError: function (error) {
                    console.log(error);
                },

                displayCommentData: function (data) {

                    var commentableType = data.commentableType;
                    var commentId = data.commentIdFor;
                    var commentHtml = this.createComment(data);
                    var commentEl = $(commentHtml);

                    commentEl.hide();

                    var commentList = $('#commentFor' + commentableType + commentId);

                    commentList.addClass('hasComments');
                    commentList.append(commentEl);
                    commentEl.slideDown();

                },

                createComment: function(data) {

                    var url = window.location.protocol+"//"+window.location.host + "/users/";
                    var html = '' +
                        '<div class="comment">' +
                            '<div class="row">' +
                                '<div class="small-1 columns comment-votes">' +
                                    '<div class="row">' +
                                        '<div class="float-left">' + data.commentVotesCount + '</div>' +
                                    '</div>' +
                                '</div>' +
                                '<div class="small-11 columns">' +
                                    '<span class="comment-text">' +
                                        '<p>' + data.commentText + ' - ' +
                                            '<a href="' + url + data.commenterId + '"class="commenter-name">' +
                                                data.commenter +
                                            '</a>' +
                                            ' <span class="comment-time-elapsed">' +
                                                data.commentDate +
                                            '</span>' +
                                        '</p>' +
                                    '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>';

                    return html;

                },

                showLoginModal: function () {

                    var $modal = $('#mustLoggedInModal');

                    $modal.foundation('open');

                },

                makeFavorite: function (questionId) {

                    if(this.isLoggedIn) {

                        axios.get('/ajax/favorite/question/' + questionId)
                        .then(function(response) {
                            var starCountEl = $('.question-favor-count');
                            $('.question-star .fi-star').toggleClass('is-favorite');
                            starCountEl.html(response.data.starCount);
                        }).catch(function(error) {
                            console.log(error)
                        });


                    } else {
                        this.showLoginModal();
                    }
                },
                acceptAnswer: function (answerId, event) {

                    if(this.isLoggedIn) {

                        axios.get('/ajax/accept/answer/' + answerId)
                        .then(function(response) {
                            var action = response.data.action;
                            var acceptedEl = $(event.target);
                            var prevAccepted = $('.accept-answer.accepted-answer');

                            if(action == 'accept') {
                                prevAccepted.removeClass('accepted-answer');
                                acceptedEl.addClass('accepted-answer');
                            } else if(action == 'unaccept') {
                                acceptedEl.removeClass('accepted-answer');
                            }

                        }).catch(function(error) {
                            console.log(error)
                        });


                    } else {
                        this.showLoginModal();
                    }
                }
            }
        });

    </script>

@endsection
