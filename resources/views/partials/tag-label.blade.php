<span class="label">
    <span
        data-tooltip aria-haspopup="true"
        class="has-tip no-border bottom"
        data-click-open="false"
        data-disable-hover="false"
        tabindex="2"
        title="{{ $tag->questionsCount() }} questions for this tag."
    >
        <a href="{{ route('tag-show', $tag) }}">
            {{ $tag->name }}
        </a>
    </span>
</span>