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
            'first_name' => $user->first_name,
            'last_name' => $user->first_name,
            'email' => $user->email,
            'tel' => $user->tel
        ];
        return $data;
    }


}
