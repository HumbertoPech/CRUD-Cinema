<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class ActorRequest extends FormRequest
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
      $rules = [
        'actorName' => ['string', 'max:255'],
        'biography' => ['string', 'nullable'],
        'birthdate' => ['date', 'nullable'],
        'country' => ['string','nullable', 'max:50'],
        'imageRoute' => ['file', 'nullable'],
      ];
      return $rules;

    }

    /**
    * Get custom attributes for validator errors.
    *
    * @return array
    */
    public function attributes()
    {
      return [
        'actorName' => 'Nombre del actor',
        'biography' => 'Biografía del actor',
        'birthdate' => 'Fecha de nacimiento',
        'country' => 'País de origen',
        'imageRoute' => 'Foto del actor',
      ];
    }

}
?>
