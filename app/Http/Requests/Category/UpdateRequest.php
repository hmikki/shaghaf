<?php

namespace App\Http\Requests\Category;

use App\Http\Resources\Api\Category\CategoryResource;
use App\Models\Category;
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
            'category_id'=>'sometimes|exists:category,id',
            'title'=>'sometimes|string|max:255',
            'title_ar'=>'sometimes|string|max:255',
        ];
    }
    public function run():JsonResponse
    {
        $Object = (new Category())->find($this->category_id);
        if($this->filled('title')){
            $Object->setTitle($this->title);
        }
        if($this->filled('title_ar')){
            $Object->setTitleAr($this->title_ar);
        }
        $Object->save();
        $Object->refresh();
        return $this->successJsonResponse([__('messages.updated_successful')],new CategoryResource($Object),'Category');
    }
}
