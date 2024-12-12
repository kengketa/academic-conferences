<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'admin admin',
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@admin.com',
            'prefix' => null,
            'major_id' => null,
        ]);
        $admin->roles()->attach([
            1 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
        $users = User::factory()->count(20)->create();
        $roles = Role::pluck('id')->toArray();
        foreach ($users as $user) {
            $randomRoles = array_rand(array_flip($roles), rand(1, 3));
            if (!is_array($randomRoles)) {
                $randomRoles = [$randomRoles];
            }
            foreach ($randomRoles as $roleId) {
                $user->roles()->attach([
                    $roleId => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
                ]);
            }
        }
    }
}
