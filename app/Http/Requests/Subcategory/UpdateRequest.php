<?php

namespace App\Http\Requests\subcategory;


use App\Http\Resources\Api\Subcategory\SubcategoryResource;
use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class UpdateRequest extends FormRequest
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
            'sub_category_id'=>'required|exists:category,id',
            'title'=>'required|string|max:255',
        ];
    }
    public function run():JsonResponse
    {
        $Object = (new SubCategory())->find($this->sub_category_id);
        if($this->filled('title')){
            $Object->setTitle($this->title);
        }
        $Object->save();
        $Object->refresh();
        return $this->successJsonResponse([__('messages.updated_successful')],new SubcategoryResource($Object),'Sub_Category');
    }
}
