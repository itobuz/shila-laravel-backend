<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePostRequest extends Request {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'posttype_id' => 'required',
            'post_title' => 'required',
            'post_content' => 'required',
            'post_status' => 'required',
            'menu_order' => 'required',
        ];
    }

}
