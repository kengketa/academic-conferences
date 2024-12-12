<?php

namespace App\Actions\Dashboard;


use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class SaveUserAction
{
    protected User $user;

    public function execute(User $user, array $data)
    {
        $this->user = $user;
        $this->user->major_id = $data['major_id'];
        $this->user->prefix = $data['prefix'];
        $this->user->first_name = $data['first_name'];
        $this->user->last_name = $data['last_name'];
        $this->user->email = $data['email'];
        $this->user->tel = $data['tel'];
        if (isset($data['password']) && !empty($data['password'])) {
            $this->updateUserPassword($data['password']);
        }
        $this->user->save();
        if (isset($data['roles'])) {
            $roleIds = Arr::flatten($data['roles']);
            $this->user->roles()->sync($roleIds);
        }
        $this->user = $this->user->fresh();
        return $this->user;
    }

    private function updateUserPassword($password)
    {
        $this->user->password = Hash::make($password);
    }


}
