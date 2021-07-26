<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RouteRequest extends FormRequest
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
            'title' => 'required|unique:routes|max:255',
            'content' => 'required',
            'stations' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'image_map' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => __('messages.required'),
            'content.required' => __('messages.required'),
            'stations.required' => __('messages.required'),
            'image.required' => __('messages.required'),
            'image.image' => __('messages.image'),
            'image.image_map' => __('messages.image'),
            'image_map.required' => __('messages.required'),
        ];
    }
}
