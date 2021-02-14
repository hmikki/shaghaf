<?php

namespace App\Http\Requests\Api\Portfolio;

use App\Helpers\Constant;
use App\Http\Resources\Api\User\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Foundation\Http\FormRequest;

class updateRequest extends FormRequest
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
            'portfolio_id' => 'required|exists:portfolio,id',
            'user_id'=>'required|exists:user,id',
            'title'=>'string',
            'media'=>'array',
            'media.*'=>'mimes:jpeg,jpg,png'
        ];
    }

    public function run(){
        $logged = auth()->user();
        $Portfolio = (new  Portfolio())->find($this->portfolio_id);
        if ($this->filled('name')) {
            $Portfolio->setName($this->name);
        }
        if ($this->filled('title')) {
            $Portfolio->setTitle((app()->getLocale() == 'ar')? $this->title_ar : $this->title);
        }
        $Portfolio->save();
        $Portfolio->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($Portfolio->getId());

            if($this->media == Constant::MEDIA_TYPES['Portfolio_Image']){
                $Media->setMediaType(Constant::MEDIA_TYPES['Portfolio_Image']);
                $Media->setFile($media);
            }
            else if ($this->media == Constant::MEDIA_TYPES['Portfolio_video']){
                $Media->setMediaType(Constant::MEDIA_TYPES['Portfolio_video']);
                $Media->setFileVideo($media);
            }
            $Media->save();
        }
        return $this->successJsonResponse([__('messages.saved_successfully')],new PortfolioResource($Product),'Product');

    }
}
