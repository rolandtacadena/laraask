<div class="question-list-tabs">
    <ul class="tabs">
        <li class="tabs-title {{ request('sort') == 'newest' ? 'is-active' : '' }}">
            <a href="?sort=newest">newest</a>
        </li>
        <li class="tabs-title {{ request('sort') == 'oldest' ? 'is-active' : '' }}">
            <a href="?sort=oldest">oldest</a>
        </li>
        <li class="tabs-title {{ request('sort') == 'active' ? 'is-active' : '' }}">
            <a href="?sort=active">active</a>
        </li>
        @if(request()->route()->getName() == 'unanswered-questions')
            <li class="tabs-title">
                <a href="{{ route('all-questions') }}">all questions</a>
            </li>
        @else
            <li class="tabs-title">
                <a href="{{ route('unanswered-questions') }}">unanswered</a>
            </li>
        @endif
    </ul>
</div>