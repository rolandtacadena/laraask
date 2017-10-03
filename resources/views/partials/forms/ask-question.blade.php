<form
    method="POST"
    action="{{ route('ask-question') }}"
    id="AskForm"
    class="{{ count($errors) > 0 ? 'hasError' : '' }}"
>
    {{ csrf_field() }}
    <input name="asker_id" type="hidden" value="{{ $authUser->id }}">
    <div class="row">
        <div class="input-holder">
            <label>
                Title
                <input
                    name="title"
                    type="text"
                    value="{{ old('title') }}"
                    placeholder="What's your programming question? Be specific."
                    class="{{ $errors->has('title') ? 'error-input' : '' }}"
                    v-model="title"
                    required
                    autofocus
                >
            </label>

            @if ($errors->has('title'))
                <span class="help-block">{{ $errors->first('title') }}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="input-holder">
            <label>
                Description
                <textarea
                    name="description"
                    cols="30"
                    rows="10"
                    class="{{ $errors->has('description') ? 'error-input' : '' }}"
                    v-model="description"
                    required
                >
                    {{ old('description') }}
                </textarea>
            </label>

            @if ($errors->has('description'))
                <span class="help-block">{{ $errors->first('description') }}</span>
            @endif

        </div>
    </div>
    <div class="row">
        <div class="input-holder">
            <label>
                Tags
                <select
                  id="tags"
                  name="tags[]"
                  class="{{ $errors->has('tags') ? 'error-input' : '' }}"
                  v-select="selectedTags"
                  multiple="multiple"
                >
                    <option v-for="tag in allTags" value="@{{ tag.id }}">
                        @{{ tag.name }}
                    </option>
                </select>
            </label>

            @if ($errors->has('tags'))
                <span class="help-block">
                    {{ $errors->first('tags') }} ;
                    <span class="error-helper-suggest">see list of popular <a href="{{ route('tags') }}">tags</a></span>
                </span>
            @endif

        </div>
    </div>
    <div class="row" v-show="title && description && selectedTags">
        <div class="input-holder">
            <button id="question-submit" class="button" type="submit">Post Question</button>
        </div>
    </div>
</form>
