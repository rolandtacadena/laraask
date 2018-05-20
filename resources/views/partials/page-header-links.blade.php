<div id="Header" class="row">
    {{--<div id="SiteLogo" class="float-left">--}}
        {{--<a href="{{ route('index') }}">--}}
            {{--<img src="/images/sitelogo.png" alt="LaraAsk Logo">--}}
        {{--</a>--}}
    {{--</div>--}}
    <div id="LinkGroups" class="float-right">
        <div class="small button-group">
            <a href="{{ route('all-questions') }}" class="button">Questions</a>
            <a href="{{ route('unanswered-questions') }}" class="button">Unanswered Questions</a>
            <a href="{{ route('tags') }}" class="button">Tags</a>
            <a href="{{ route('users') }}" class="button">Users</a>
            <a href="{{ route('ask-question') }}" class="button highlighted">Ask Question</a>
        </div>
    </div>
</div>