<?php

namespace App\Http\Requests;

use App\Answer;
use Illuminate\Foundation\Http\FormRequest;

class CreateAnswerRequest extends FormRequest
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
            'answer' => 'required|min:150',
            'answer.required' => 'Please provide a valid answer'
        ];
    }

    /**
     * Persist answers.
     */
    public function persist()
    {
        Answer::create($this->all());
    }
}
