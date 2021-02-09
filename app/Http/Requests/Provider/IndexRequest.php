<?php

namespace App\Http\Requests\Provider;

use App\Http\Resources\Api\Provider\ProviderResource;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class IndexRequest extends FormRequest
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
            'user_id'=>'sometimes|exists:users,id',
            'category_id'=>'sometimes|exists:categories,id',
            'sub_category_id'=>'sometimes|exists:sub_category,id',
            'per_page'=>'sometimes|numeric'
        ];
    }
    public function run(): JsonResponse
    {
        $Objects = new Provider();
        if($this->filled('user_id')){
            $Objects = $Objects->where('user_id',$this->user_id);
            $Objects = $Objects->where('is_active',true);
        }else{
            $Objects = $Objects->where('user_id',auth()->user()->getId());
        }
        if($this->filled('category_id')){
            $Objects = $Objects->where('category_id',$this->category_id);
        }
        if($this->filled('sub_category_id')){
            $Objects = $Objects->where('sub_category_id',$this->sub_category_id);
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = ProviderResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Providers',$Objects);
    }
}
