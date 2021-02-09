<?php

namespace App\Http\Requests\Provider;

use App\Helpers\Constant;
use App\Http\Resources\Api\Home\ProviderResource;
use App\Models\Media;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'provider_id'=>'required|exists:product,id',
            'category_id'=>'required|exists:category,id',
            'sub_category_id'=>'required|exists:sub_category,id',
            'name'=>'required|string|max:255',
            'description'=>'required|max:255',
            'price'=>'required|numeric',
            'type'=>'required| in: 1, 2',
            'media'=>'sometimes|array',
            'media.*'=>'mimes:jpeg,jpg,png'
        ];
    }

    public function run(){
        $Object = (new Provider())->find($this->provider_id);
        if($this->filled('category_id')){
            $Object->setCategoryId($this->category_id);
        }
        if($this->filled('sub_category_id')){
            $Object->setSubcategoryId($this->sub_category_id);
        }
        if($this->filled('name')){
            $Object->setName($this->name);
        }
        if($this->filled('description')){
            $Object->setDescription($this->description);
        }
        if($this->filled('price')){
            $Object->setPrice($this->price);
        }
        if($this->filled('type')){
            $Object->setType($this->type);
        }
        $Object->save();
        $Object->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Object->getId());
            $Media->setMediaType(Constant::MEDIA_TYPES['Food']);
            $Media->setFile($media);
            $Media->save();
        }
        return $this->successJsonResponse([__('messages.updated_successful')],new ProviderResource($Object),'Food');

    }
}
