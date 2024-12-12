<?php

namespace App\Http\Transformers;


use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use App\Models\User;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user): array
    {
        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'prefix' => $user->prefix,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'full_name' => $user->prefix . ' ' . $user->first_name . ' ' . $user->last_name,
            'email' => $user->email,
            'tel' => $user->tel,
            'department_id' => $user->major ? $user->major->department->id : null,
            'major_id' => $user->major ? $user->major->id : null,
            'roles' => $user->roles,
        ];
        return $data;
    }


}
