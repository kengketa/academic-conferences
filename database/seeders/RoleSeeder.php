<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::factory()->create([
            'name' => 'proposer',
            'name_th' => 'ผู้เสนอ'
        ]);
        Role::factory()->create([
            'name' => 'dean',
            'name_th' => 'คณะบดี'
        ]);
        Role::factory()->create([
            'name' => 'chairman',
            'name_th' => 'ประธานคณะกรรมการติดตามภาระงานวิจัยและงานวิชาการอื่นของคณาจารย์'
        ]);
        Role::factory()->create([
            'name' => 'president',
            'name_th' => 'อธิการบดี'
        ]);
        Role::factory()->create([
            'name' => 'secretary',
            'name_th' => 'เลขานุการคณะกรรมการพิจารณาตำแหน่งทางวิชาการ',
        ]);
    }
}
