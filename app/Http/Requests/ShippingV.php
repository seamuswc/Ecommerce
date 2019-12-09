<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShippingV extends FormRequest {
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
    // Calling code and country's default value is 0|Code and 0|Country which is why required rule will not work thus using regex to match 0|Code
    return [
      'name' => 'required',
      'country' => ['not_regex :/^0\|Country$/s'],
      'city' => 'required',
      'state' => 'required',
      'address1' => 'required',
      'postal' => 'required',
      'state' => 'required',
    ];
  }

  public function withValidator($validator) {
    $validator->after(function ($validator) {
      if ($this->country()) {
        $validator->errors()->add('country', __('validation.custom.country.not_regex'));
      }
      if ($this->countryCode()) {
        $validator->errors()->add('country', __('validation.custom.country.required_calling_code'));
      }
    });
  }

  public function country() {

    $result_explode = explode('|', $this->input('country'));
    $country = $result_explode[1];
    if ($country == 'Country') {
      return 1;
    }
    return 0;
  }

  public function countryCode() {
    
    $result_explode = explode('|', $this->input('callingCode'));
    $country = $result_explode[1];
    if ($country == 'Country') {
      return 1;
    }
    return 0;
  }

  public function messages() {
    return [
      'address1.required' => 'An address is required',
    ];
  }

}
