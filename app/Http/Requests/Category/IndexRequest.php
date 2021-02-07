<?php

namespace App\Http\Requests\Category;

use App\Models\Category;
use App\Http\Resources\Api\Category\CategoryResource;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

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

    public function run():JsonResponse
    {
        $Objects = new Category();
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = CategoryResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Categories',$Objects);
    }
}
