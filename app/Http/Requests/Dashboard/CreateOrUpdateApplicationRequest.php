<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrUpdateApplicationRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', 'in:local,international'],
            'number_of_seminar_done' => ['required', 'integer', 'min:0'],
            'organized_by' => ['required', 'array', 'min:1'],
            'organized_by.*' => ['string', 'max:255'],
            'references' => ['required', 'array'],
            'references.*' => ['string', 'max:255'],
            'relate_majors' => ['required', 'array'],
            'relate_majors.*' => ['string', 'max:255'],
            'relate_curriculum' => ['required', 'array'],
            'relate_curriculum.*' => ['string', 'max:255'],
            'other_info' => ['nullable', 'string'],
            'proposer_signature' => ['required', 'string'],
            'dean_comment' => ['nullable', 'string'],
            'dean_signature' => ['nullable', 'string'],
            'chairman_comment' => ['nullable', 'string'],
            'chairman_signature' => ['nullable', 'string'],
            'president_comment' => ['nullable', 'string'],
            'president_signature' => ['nullable', 'string'],
            'secretary_comment' => ['nullable', 'string'],
            'secretary_signature' => ['nullable', 'string'],
            'current_status' => ['required', 'in:1,2,3,4,5,6'],
            'next_status' => ['required', 'in:2,3,4,5,6'],
            'documents' => ['required', 'array', 'min:1'],
            'documents.*' => ['required', 'mimes:pdf,ppt,pptx,doc,docx,xls,xlsx', 'max:102400'],
            'to_delete_documents.*' => ['nullable']
        ];
        if (request()->method == 'PATCH') {
            $rules['documents.*'] = ['nullable'];
        }
        if ($this->input('next_status') == 3) {
            $rules['dean_comment'] = ['required', 'string'];
        }
        if ($this->input('next_status') == 4) {
            $rules['chairman_comment'] = ['required', 'string'];
        }
        if ($this->input('next_status') == 5) {
            $rules['president_comment'] = ['required', 'string'];
        }
        if ($this->input('next_status') == 5) {
            $rules['secretary_comment'] = ['required', 'string'];
        }
        return $rules;
    }
}
