<?php

namespace App\Http\Requests\Api\Home;

use App\Helpers\Constant;
use App\Http\Requests\Api\ApiRequest;
use App\Http\Resources\Api\Home\FreelancerResource;
use App\Models\FreelancerCategory;
use App\Models\User;
use Illuminate\Http\JsonResponse;

/**
 * @property mixed per_page
 * @property mixed category_id
 * @property mixed sub_category_id
 * @property mixed q
 * @property mixed top_orders
 */
class FreelancerRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return $this->user()->getType() == Constant::USER_TYPE['Freelancer'];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
        'category_id' => 'required|exists:categories',
        'sub_category_id' => 'exists:categories'
        ];
    }
    public function run(): JsonResponse
    {
        $logged = auth()->user();
        $user_id = FreelancerCategory::where('category_id', $this->category_id)->pluck('user_id');
        $Objects = new User();
        $Objects = $Objects->whereIn('id', $user_id);
        if($this->filled('sub_category_id')){
            $user_id = FreelancerCategory::where('category_id', $this->category_id)->where('sub_category_id', $this->sub_category_id)->pluck('user_id');
            $Objects = $Objects->whereIn('id', $user_id);
        }
        if($this->filled('q')){
            $Objects = $Objects->where('name', '%'.$this->q.'%');
        }
        if($this->filled('top_orders') && $this->top_orders){
            $Objects = $Objects->orderBy('order_count', 'desc');
        }
        $Objects = $Objects->paginate($this->filled('per_page')?$this->per_page:10);
        $Objects = FreelancerResource::collection($Objects);
        return $this->successJsonResponse([__('messages.saved_successfully')],$Objects->items(),'Freelancers',$Objects);
    }
}
