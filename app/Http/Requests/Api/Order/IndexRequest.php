<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use App\Models\Order;
use App\Traits\ResponseTrait;
use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Order\OrderResource;

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
            'is_finished'=>'sometimes|in:0,1',
            'per_page'=>'sometimes|numeric'
        ];
    }

    public function run():JsonResponse
    {
        $logged = auth()->user();
        $Objects = new Order();
        if($logged->getType() == Constant::USER_TYPE['Customer']){
            $Objects = $Objects->where('user_id',$logged->getId());
        }else{
            $Objects = $Objects->where('provider_id',$logged->getId());
        }
        if($this->filled('is_finished')){
            $Objects = $Objects->where('is_finished',$this->is_finished);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = OrderResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Orders',$Objects);

    }
}
