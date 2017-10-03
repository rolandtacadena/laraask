@extends('layouts.main')

@section('page-content')

    @include('partials.page-header-links')

    <div class="row columns">
    	<div class="small-12 medium-8 large-8 columns">
    		<!--<div class="row ask-question-instructions">
		      <p>Wait! Some of your past questions have not been well-received, and you're in danger of being <a href="">blocked from asking any more</a>.</p>
		      <p>For help formulating a clear, useful question, see: <a href="">How do I ask a good question?</a></p>
		      <p>Also, edit your previous questions to improve formatting and clarity.</p>
		    </div> [RCT]-->
		    <div class="row columns">
                <div class="small-12">

                    @include('partials.forms.ask-question')

                </div>
            </div>
    	</div>
    	<div class="small-12 medium-4 large-4 columns">

			@include('partials.ask-question-how-to')

		</div>
    </div>

@endsection

  @section('page-scripts')
      <script>

          Vue.directive('select', {

              twoWay: true,
              priority: 1000,

              bind: function() {
                  var self = this;
                  $(this.el)
                      .select2({})
                      .on('change', function() {
                          self.set($(self.el).val());
                      })
              },

              update: function(value) {
                  $(this.el).val(value).trigger('change');
              },

              unbind: function() {
                  $(this.el).off().select2('destroy');
              }
          });

          new Vue({
              el: 'body',

              data: {
                  isLoggedIn: window.isLoggedIn,
                  title: '',
                  description: '',
                  selectedTags: [],
                  allTags: []
              },

              created() {
                  if(this.isLoggedIn) {
                      this.getAllTags();
                  }
              },

              methods: {
                  getAllTags() {
                      axios.get('/ajax/tags/all')
                          .then(response =>
                              this.allTags = response.data
                          ).catch(error =>
                          console.log(error)
                      );
                  }
              }
          });
      </script>
  @endsection

<!-- NOTES -->
{{--When user click the input button to create a question the info for question will pop,--}}
{{--also when user click the input button to create a tag the info for tag will pop--}}
{{--use VUE js--}}
{{--http://stackoverflow.com/questions/ask--}}
