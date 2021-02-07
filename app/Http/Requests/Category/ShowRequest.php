<?php

namespace App\Http\Requests\Category;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class ShowRequest extends FormRequest
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
            'category_id'=>'required|exists:category,id'
        ];
    }

    public function run():JsonResponse
    {
        $Object = (new Category())->find($this->category_id);
        $Object = new CategoryResource($Object);
        return $this->successJsonResponse([],$Object,'Category');
    }
}
