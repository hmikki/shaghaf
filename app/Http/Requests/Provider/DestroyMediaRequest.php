<?php

namespace App\Http\Requests\Provider;

use App\Models\Media;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class DestroyMediaRequest extends FormRequest
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
            'media_id'=>'required|exists:media,id',
        ];
    }
    public function run(): JsonResponse
    {
        $Object = (new Media())->find($this->media_id);
        try {
            $Object->delete();
            return $this->successJsonResponse([__('messages.deleted_successful')]);
        } catch (\Exception $e) {
            return $this->failJsonResponse([$e->getMessage()]);
        }
    }
}
