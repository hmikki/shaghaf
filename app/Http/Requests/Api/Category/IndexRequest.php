<?php

namespace App\Http\Requests\Api\Category;

use App\Http\Resources\Api\Home\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

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
        'per_page' => 'sometims|numeric',
        ];
    }
    public function run(){
        $Objects = new Category();
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = CategoryResource::collection($Objects);
        return $this->successJsonResponse([],$Objects->items(),'Categories',$Objects);
    }
}
