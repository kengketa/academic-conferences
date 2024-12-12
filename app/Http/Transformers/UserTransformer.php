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
            'institution' => $user->institution,
            'role_id' => $user->role_id,
            'role' => $user->role->toArray(),
            'email' => $user->email,
            'tel' => $user->tel
        ];
        return $data;
    }


}
