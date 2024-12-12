<?php

namespace App\Actions\Dashboard;


use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class SaveUserAction
{
    protected User $user;

    public function execute(User $user, array $data)
    {
        $this->user = $user;
        $this->user->name = $data['name'];
        $this->user->institution = $data['institution'];
        $this->user->email = $data['email'];
        $this->user->tel = $data['tel'];
        $this->user->role_id = $data['role_id'];
        if (isset($data['password']) && !empty($data['password'])) {
            $this->updateUserPassword($data['password']);
        }
        $this->user->save();
        $this->user = $this->user->fresh();
        return $this->user;
    }

    private function updateUserPassword($password)
    {
        $this->user->password = Hash::make($password);
    }


}
