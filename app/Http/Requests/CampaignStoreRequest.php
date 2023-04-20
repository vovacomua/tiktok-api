<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CampaignStoreRequest extends FormRequest
{
    public function rules()
    {
        return [
            'budget_mode' => 'required|string',
            'budget' => 'required|numeric|min:1',
            'objective_type' => 'required|string',
            'campaign_name' => 'required|string',
            'video' => 'required',
        ];
    }
}
