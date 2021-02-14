<?php

namespace App\Http\Requests\Api\Portfolio;

use App\Http\Resources\Api\User\PortfolioResource;
use App\Models\Portfolio;
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
            'user_id' => 'required|exists:users',
            'per_page'=> 'somtimes|numeric'
        ];
    }
    public function run(){
        $logged = auth()->user();
        $Objects = new  Portfolio();
        if($this->filled('user_id')){
            $Objects = $Objects->where('user_id',$this->user_id);
        }else{
            $Objects = $Objects->where('user_id',$logged->getId());
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        return $this->successJsonResponse([],PortfolioResource::collection($Objects->items()),'Portfolio',$Objects);
    }
}
