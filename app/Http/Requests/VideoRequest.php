<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class VideoRequest extends Request {

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
        dd($this->all());
		return [
			'name' => "required",
            'file' => "required|size:100|mimes:mp4, webm, ogg"
		];
	}

}
