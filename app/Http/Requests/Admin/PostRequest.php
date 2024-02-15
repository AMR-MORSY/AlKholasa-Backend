<?php

namespace App\Http\Requests\Admin;

use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = auth()->user();
        if($user)
        {
            if (Str::of($user->email)->endsWith("morsy.mamr@gmail.com")) {
                return true;
            }
            return false;

        }
      
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    private function slug($string, $separator = '-')
    {
        if (is_null($string)) {
            return "";
        }

        $string = trim($string);

        $string = mb_strtolower($string, "UTF-8");;

        $string = preg_replace("/[^a-z0-9_\sءاأإآؤئبتثجحخدذرزسشصضطظعغفقكلمنهويةى]#u/", "", $string);

        $string = preg_replace("/[\s-]+/", " ", $string);

        $string = preg_replace("/[\s_]/", $separator, $string);

        return $string;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'slug' => $this->slug($this->title),
        ]);
    }
    public function rules(): array
    {
        return [
            "user_id" => "required|exists:users,id",
            "category_id" => "required|exists:categories,id",
            "title" => "required|string|max:75",
            "metaTitle" => "required|string|max:100",
            "slug" => ["required", "string", "max:100", Rule::unique("posts")->ignore($this->post)],
            "summary" => "required|string|max:300",
            // "content" => "required|string",
            "published" => ["nullable", Rule::in([1, 0])],

            "image" => [Rule::requiredIf(function () {
                return $this->routeIs("posts.store");
            }), "nullable", File::image()->max(1024)]


        ];
    }
}
