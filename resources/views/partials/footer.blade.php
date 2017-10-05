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
                            <ul>
                                <li><a href="{{ route('all-questions') }}">All Questions</a></li>
                                <li><a href="{{ route('unanswered-questions') }}">Unanswered Questions</a></li>
                                <li><a href="{{ route('tags') }}">Tags</a></li>
                                <li><a href="{{ route('users') }}">Users</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/vendor/jquery.js"></script>
    <script src="/js/vendor/what-input.js"></script>
    <script src="/js/vendor/foundation.js"></script>
    <script src="/js/vendor/sweetalert.min.js"></script>
    <script src="/js/main.js"></script>

    <script src="/js/vendor/vue.js"></script>
    <script src="/js/vendor/select2.min.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="/js/vue-scripts/favorite-tags.js"></script>

  <!--page specific javascripts-->
  @yield('page-scripts')

  <!-- swal flash -->
  @include('flash')

</body>
</html>
