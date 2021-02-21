<?php

namespace App\Http\Controllers\Admin\AppData;

use App\Http\Controllers\Admin\Controller;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Setting;
use App\Traits\AhmedPanelTrait;

class FaqController extends Controller
{
    use AhmedPanelTrait;

    public function setup()
    {
        $this->setRedirect('app_data/faqs');
        $this->setEntity(new Faq());
        $this->setTable('faqs');
        $this->setLang('Faq');
        $this->setColumns([
            'faq_category_id'=> [
                'name'=>'faq_category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> FaqCategory::all(),
                    'custom'=>function($Object){
                        return $Object? (app()->getLocale()=='en')?$Object->name:$Object->name_ar:' - ';
                    },
                    'entity'=>'faq_category'
                ],
                'is_searchable'=>true,
                'order'=>true
            ],
            'question'=> [
                'name'=>'question',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'question_ar'=> [
                'name'=>'question_ar',
                'type'=>'text',
                'is_searchable'=>true,
                'order'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_searchable'=>true,
                'order'=>true
            ],
        ]);
        $this->setFields([
            'faq_category_id'=> [
                'name'=>'faq_category_id',
                'type'=>'custom_relation',
                'relation'=>[
                    'data'=> FaqCategory::all(),
                    'custom'=>function($Object){
                        return $Object? (app()->getLocale()=='en')?$Object->name:$Object->name_ar:' - ';
                    },
                    'entity'=>'faq_category'
                ],
                'is_required'=>true
            ],
            'question'=> [
                'name'=>'question',
                'type'=>'text',
                'is_required'=>true
            ],
            'question_ar'=> [
                'name'=>'question_ar',
                'type'=>'text',
                'is_required'=>true
            ],
            'answer'=> [
                'name'=>'answer',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'answer_ar'=> [
                'name'=>'answer_ar',
                'type'=>'textarea',
                'is_required'=>true
            ],
            'is_active'=> [
                'name'=>'is_active',
                'type'=>'active',
                'is_required'=>true
            ],
        ]);
        $this->SetLinks([
            'edit',
            'delete',
        ]);
    }

}
