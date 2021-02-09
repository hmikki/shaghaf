<?php

namespace App\Http\Requests\Subcategory;

use App\Http\Resources\Api\Subcategory\SubcategoryResource;
use App\Models\SubCategory;
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
            'sub_category_id'=>'required|exists:category,id'
        ];
    }

    public function run():JsonResponse
    {
        $Object = (new SubCategory())->find($this->sub_category_id);
        $Object = new SubcategoryResource($Object);
        return $this->successJsonResponse([],$Object,'sub_category');
    }
}