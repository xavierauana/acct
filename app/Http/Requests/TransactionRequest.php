<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class TransactionRequest extends Request {

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
			'item' => 'required',
			'amount' => 'required|numeric',
			'vendor' => 'required',
			'payment' => 'required',
			'receipt' => 'image',
			'position' => 'regex:/^-?(\d{2,3}).(\d{6,}),-?(\d{2,3}).(\d{6,})$/',
		];
	}
}
