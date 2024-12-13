<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Major;
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

        $major = Major::inRandomOrder()->first();
        $proposer = User::factory()->create([
            'email' => 'proposer@mail.com',
            'major_id' => $major->id,
            'first_name' => 'proposer',
            'last_name' => 'proposer',
        ]);
        $proposer->roles()->attach([
            2 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);


        $randomMajorInTheSameDepartment = Major::whereHas('department', function ($query) use ($major) {
            $query->where('id', $major->department->id);
        })->inRandomOrder()->first();
        $dean = User::factory()->create([
            'email' => 'dean@mail.com',
            'major_id' => $randomMajorInTheSameDepartment,
            'first_name' => 'dean',
            'last_name' => 'dean',
        ]);
        $dean->roles()->attach([
            2 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            3 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()], // dean
        ]);


        $chairman = User::factory()->create([
            'email' => 'kamonwan@mail.com',
            'major_id' => $randomMajorInTheSameDepartment,
            'first_name' => 'kamonwan',
            'last_name' => 'kamonwan',
        ]);
        $chairman->roles()->attach([
            2 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            4 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            6 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);


        $president = User::factory()->create([
            'email' => 'president@mail.com',
            'major_id' => $randomMajorInTheSameDepartment,
            'first_name' => 'president',
            'last_name' => 'president',
        ]);
        $president->roles()->attach([
            2 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            5 => ['created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
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
