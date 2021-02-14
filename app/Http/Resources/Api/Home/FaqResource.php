<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
{
    public function toArray($request): array
    {
        $Objects = array();
        $Objects['id'] = $this->getId();
        $Objects['question'] = (app()->getLocale() == 'ar')?$this->getQuestionAr():$this->getQuestion();
        $Objects['answer'] = (app()->getLocale() == 'ar')?$this->getAnswerAr():$this->getAnswer();
        return $Objects;
    }
}
