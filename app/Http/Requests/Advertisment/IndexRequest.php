<?php

namespace App\Http\Requests\Advertisment;

use App\Http\Resources\Api\Advertisment\AdvertismentResource;
use App\Models\Advertisment;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Traits\ResponseTrait;

class IndexRequest extends FormRequest
{
    use ResponseTrait;
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
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function run(){
        $Objects = new Advertisment();
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = AdvertismentResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Advertisments',$Objects);
    }
}
