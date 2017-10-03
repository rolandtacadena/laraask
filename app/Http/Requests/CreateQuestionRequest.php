<?php

namespace App\Http\Requests;

use App\Question;
use Illuminate\Foundation\Http\FormRequest;

class CreateQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:50|max:255',
            'description' => 'required|min:150',
            'tags' => 'required'
        ];
    }

    /**
     * Validation custom messages.
     *
     * @return array
     */
    public function messages() {
        return [
            'title.required' => 'The question title is required.',
            'description.required'  => 'Please add the question description.',
            'tags.required'  => 'Please add at least one tag.'
        ];
    }

    /**
     * Persist questions.
     *
     * @return mixed
     */
    public function persist()
    {
        $question = Question::create($this->all());
        $question->tags()->attach($this->input('tags'));
        return $question;
    }
}
