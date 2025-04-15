<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Role::create([
            'name' => 'setda',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'puskes',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'rsud',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'kecamatan',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'skpd',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);

    }
}
