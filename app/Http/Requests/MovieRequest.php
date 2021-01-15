<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class MovieRequest extends FormRequest
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
        'movieName' => ['string', 'max:255'],
        'release' => ['date', 'nullable'],
        'country' => ['string', 'max:255', 'nullable'],
        'synopsis' => ['string', 'max:255', 'nullable'],
        'duration' => ['string', 'nullable'],
        'imageRoute' => ['file', 'nullable'],
        'actors.*' => ['numeric', 'nullable'],
        'directors.*' => ['numeric', 'nullable']
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
        'movieName' => 'Nombre de la película',
        'release' => 'Fecha de lanzamiento',
        'country' => 'País',
        'synopsis' => 'Sinopsis de la película',
        'imageRoute' => 'Portada de la película',
      ];
    }

}
?>
