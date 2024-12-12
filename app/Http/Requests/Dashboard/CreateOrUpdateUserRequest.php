<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateOrUpdateUserRequest extends FormRequest
{
    public function rules()
    {
        $userId = request()->get('user_id');
        $rules = [
            'prefix' => ['nullable', 'string', 'max:20'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email,' . $userId],
            'tel' => ['required', 'string', 'min:10', 'max:15'],
            'roles.*.id' => ['exists:roles,id'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'major_id' => ['nullable', 'exists:majors,id'],
            'password' => ['nullable', 'string'],
        ];
        return $rules;
    }
}
