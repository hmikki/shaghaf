<?php

namespace App\Http\Requests\Provider;

use App\Helpers\Constant;
use App\Http\Resources\Api\Provider\ProviderResource;
use App\Models\Media;
use App\Models\Provider;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $Object = new Provider();
        $Object->setUserId(auth()->user()->getId());
        $Object->setCategoryId($this->category_id);
        $Object->setSubcategoryId($this->sub_category_id);
        $Object->setName($this->name);
        $Object->setDescription($this->description);
        $Object->setPrice($this->price);
        $Object->setType($this->type);
        $Object->save();
        $Object->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Object->getId());
            $Media->setMediaType(Constant::MEDIA_TYPES['Provider']);
            $Media->setFile($media);
            $Media->save();
        }
        return $this->successJsonResponse([__('messages.created_successful')],new ProviderResource($Object),'Food');
    }
}
