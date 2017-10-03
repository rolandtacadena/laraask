<div id="AnswerForm" class="row columns">
    <h2>You Answer</h2>
    <div class="small-12">
        <form method="POST"
              action="{{ route('answer-question') }}"
              class="{{ count($errors) > 0 ? 'hasError' : '' }}">
            {{ csrf_field() }}
            <input type="hidden" name="question_id" value="{{ $question->id }}">
            <input type="hidden" name="answerer_id" value="{{ $authUser->id }}">

            <div class="row columns">
                <div class="input-holder">
                    <textarea
                            v-model="answer"
                            name="answer"
                            cols="30"
                            rows="10"
                            class="{{ $errors->has('answer') ? 'error-input' : '' }}"
                            required
                    >{{ old('answer') }}</textarea>

                    @if ($errors->has('answer'))

                        <span class="help-block">{{ $errors->first('answer') }}</span>

                    @endif

                </div>
            </div>
            <div  class="row columns" v-show="answer">
                <button id="answer-submit" class="button" type="submit">Post Answer</button>
            </div>
        </form>
    </div>
</div>