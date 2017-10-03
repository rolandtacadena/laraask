<div class="small-12 medium-4 large-3 columns">
    <div class="row">
        <div class="small-12 columns">
            <div class="tag-holder tags">
                <span
                    data-tooltip aria-haspopup="true"
                    class="has-tip no-border bottom"
                    data-click-open="false"
                    data-disable-hover="false"
                    tabindex="2"
                    title="{{ $tag->questionsCount() }} questions for this tag."
                >
                    <span class="label">
                        <a href="{{ route('tag-show', $tag) }}">
                            {{ $tag->name }}
                        </a>
                    </span>
                    <span class="multiplier-count">
                        x <a href="{{ route('tag-show', $tag) }}">
                            {{ $tag->questionsCount() }} {{ $tag->questionsCount() > 1 ? 'questions' : 'question' }}
                        </a>
                    </span>
                </span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="tag-description">
                <p>{{ str_limit($tag->description, 100) }}</p>
            </div>
        </div>
        <div class="small-12 columns">
            <div class="tag-asked-count">
                <p>
                    <span
                        data-tooltip aria-haspopup="true"
                        class="has-tip no-border bottom"
                        data-click-open="false"
                        data-disable-hover="false"
                        tabindex="2"
                        title="{{  $tag->countQuestionsAskedToday() }} questions asked today"
                    >
                        <a href="{{ route('question-today-by-tag', $tag) }}">
                            {{ $tag->countQuestionsAskedToday() }} asked today
                        </a>
                    </span>
                    <span
                        data-tooltip aria-haspopup="true"
                        class="has-tip no-border bottom"
                        data-click-open="false"
                        data-disable-hover="false"
                        tabindex="2"
                        title="{{ $tag->countQuestionsAskedThisMonth() }} asked this month"
                    >
                        <a href="{{ route('question-this-month-by-tag', $tag) }}">
                            {{ $tag->countQuestionsAskedThisMonth() }} this month
                        </a>
                    </span>
                </p>
            </div>
        </div>
    </div>
</div>