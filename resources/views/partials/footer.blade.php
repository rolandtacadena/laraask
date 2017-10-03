            <!-- close wrapper, no more content after this -->
            </div>
        </div>
    </div>

    <div id="SiteFooter">
        <div class="row property container">
            <div class="medium-5 columns">
                <div class="property-info">
                    <h3>{{ appName() }}</h3>
                    <p>Laraask lets you post, answer, comment and vote questions. Lets developers easilly collaborate ideas.</p>
                </div>
            </div>
            <div class="medium-7 columns">
                <div class="row collapse">
                    <div class="medium-4 columns">
                        <div class="learn-links">
                            {{--<h4 class="hide-for-small">Want more?</h4>--}}
                            <ul>
                                <li><a href="{{ route('all-questions') }}">All Questions</a></li>
                                <li><a href="{{ route('unanswered-questions') }}">Unanswered Questions</a></li>
                                <li><a href="{{ route('tags') }}">Tags</a></li>
                                <li><a href="{{ route('users') }}">Users</a></li>
                            </ul>
                        </div>
                    </div>
                    {{--<div class="medium-4 columns">--}}
                        {{--<div class="support-links">--}}
                            {{--<h4 class="hide-for-small">Talk to us</h4>--}}
                            {{--<p>Tweet us at <br> <a href="https://twitter.com/zurbfoundation">@ZURBfoundation</a></p>--}}
                            {{--<p><a href="get-involved/contribute.html">Get involved in<br>our amazing community.</a></p>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="medium-4 columns">--}}
                        {{--<div class="connect-links">--}}
                            {{--<h4 class="hide-for-small">Stay Updated</h4>--}}
                            {{--<p>Keep up with the latest questions. Find us on <a href="https://github.com/zurb/foundation">Github</a>.</p>--}}
                            {{--<a href="{{ route('ask-question') }}" class="small button">Ask Question</a>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/vendor/jquery.js') }}"></script>
    <script src="{{ asset('js/vendor/what-input.js') }}"></script>
    <script src="{{ asset('js/vendor/foundation.js') }}"></script>
    <script src="{{ asset('js/vendor/sweetalert.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/vendor/vue.js') }}"></script>
    <script src="{{ asset('js/vendor/select2.min.js') }}"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/vue-scripts/favorite-tags.js') }}"></script>

  <!--page specific javascripts-->
  @yield('page-scripts')

  <!-- swal flash -->
  @include('flash')

</body>
</html>
