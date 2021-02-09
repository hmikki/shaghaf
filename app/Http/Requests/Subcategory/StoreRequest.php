<?php

namespace App\Http\Requests\subcategory;



use App\Http\Resources\Api\Subcategory\SubcategoryResource;
use App\Models\SubCategory;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ResponseTrait;
use Illuminate\Http\JsonResponse;

class StoreRequest extends FormRequest
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
            'title'=>'required|string|max:255'
        ];
    }
    public function run():JsonResponse
    {
        $Object = new SubCategory();
        $Object->setTitle($this->title);
        $Object->setTitleAr($this->title_ar);
        $Object->setImage($this->image);
        $Object->save();
        $Object->refresh();
        return $this->successJsonResponse([__('messages.created_successful')],new SubcategoryResource($Object),'Category');
    }
}
