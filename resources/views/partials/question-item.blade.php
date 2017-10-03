<div class="small-12 columns question
    @if($isLoggedIn)
        {{ $authUser->hasFavoriteTagOnQuestion($question) ? 'has-favorite-tag' : '' }}
    @endif
">
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
                                    <span class="count-label">votes</span>
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
                              title="{{ $question->answersCount() }} answers"
                            >
                                <div class="small-12 columns counts">
                                    <h3>{{ $question->answersCount() }}</h3>
                                </div>
                                <div class="small-12 columns">
                                    <span class="count-label">answers</span>
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
                                    <h3>1</h3>
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

                        @each('partials.tag-label', $question->tags, 'tag')

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
