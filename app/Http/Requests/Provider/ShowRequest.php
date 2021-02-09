<?php

namespace App\Http\Requests\Provider;

use App\Http\Resources\Api\Home\ProviderResource;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
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
            'provider_id' => 'required|exists:product,id'
        ];
    }
    public function run(){
        $Object = (new Provider())->find($this->provider_id);
        $Object = new ProviderResource($Object);
        return $this->successJsonResponse([],$Object,'provider');
    }
}
