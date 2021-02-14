<?php

namespace App\Http\Requests\Api\Portfolio;

use App\Helpers\Constant;
use App\Http\Resources\Api\User\PortfolioResource;
use App\Models\Media;
use App\Models\Portfolio;
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
            'user_id' => 'required|exists:users,id',
            'title' => 'required',
            'media'=>'required',
            'media.*'=>'required'
        ];
    }

    public function run(){
        $logged = auth()->user();
        $portfolio =new  Portfolio();
        $portfolio->setUserId($this->user_id);
        $portfolio->setTitle((app()->getLocale() == 'ar')?$this->title_ar : $this->title);
        $portfolio->save();
        $portfolio->refresh();
        foreach ($this->file('media') as $media) {
            $Media = new Media();
            $Media->setRefId($portfolio->getId());
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
        return $this->successJsonResponse([__('messages.saved_successfully')],new PortfolioResource($portfolio),'Portfolio');
    }
}
