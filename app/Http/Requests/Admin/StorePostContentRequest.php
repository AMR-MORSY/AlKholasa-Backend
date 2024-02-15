<?php

namespace App\Http\Requests\Admin;

use App\Models\Post;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StorePostContentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "post_id"=>['required','exists:posts,id',Rule::unique('post_content')->ignore(Post::find($this->post_id)->first()->id)],
            "content"=>'required'|'string'
        ];
    }
}
